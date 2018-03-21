<?php

namespace App\Controller;

use App\Form\UserPasswordType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller
{
    /**
     * @Route("/user")
     */
    public function indexUser()
    {
        return $this->render('user/index.html.twig', [
            
        ]);
    }

    /**
     * @Route("/user/view")
     */
    public function view()
    {
        $user = $this->getUser();
        return $this->render('user/user.html.twig', [
            'user' => $user
        ]);
    }
    /**
     * @Route("user/edit")
     */
    public function edit( Request $request){
        
        $user = $this->getUser();
        $originalAvatar=null;

        if(!is_null($user->getAvatar())){
            $originalAvatar = $user->getAvatar();
            $user->setAvatar(
                new File($this->getParameter('avatar_directory').'/'.$user->getAvatar())
            );
        }
        $form = $this->createForm(UserType::class, $user, ['controller' => 'user', 'validation_groups' => ['edit']]);
        dump($user);
         dump($form);
        $form->handleRequest($request); //le formulaire traite la requete HTTP
       //le formulaire a été envoyé ou NON ? si oui, il fait le mapping avec notre objet category et effectue les Setter à notre place
       //si le formulaire a été envoyé
       if($form->isSubmitted()){
           if($form->isValid()){
               
               $avatar = $user->getAvatar();
               if(!is_null($avatar)){
                    $avatarname= uniqid().'.'.$avatar->guessExtension();
                    $user->setAvatar($avatarname);
                    $avatar->move($this->getParameter('avatar_directory'), $avatarname);
                    if(!is_null($originalAvatar)){
                        //je rentre dans cette condition si le champ file est rempli, et uniquement si original image n'est pas null
                        //sioriginalImage est null c'est que c'est l'ajout un nouvel articl ou la modification d'un article qui n'avait pas d'image
                        if(strpos($originalAvatar, 'default') === false){
                            unlink($this->getParameter('avatar_directory').'/'. $originalAvatar);
                        } 
                    }
                }else{
                    $user->setAvatar($originalAvatar);
                }
                    
                $em = $this->getDoctrine()->getManager();
                   //prépare l'enregistement en bdd
                $em->persist($user); //on peut faire plusieurs persist puis 1 seul flush a la fin
                   //fait l'enregistement en bdd
                $em->flush(); //execute des transaction SQL. si tout passe va envoie en bdd, sinon fait un rollback
                   
                $this->addFlash('success', 'Bravo '.$user->getFullName().', votre compte a été modifié avec succès !'); //ajout du message flash
               
               return $this->redirectToRoute('app_user_view'); //redirection
           }
           else{
               $this->addFlash('error', 'erreur'); //ajout du message flash
           }
           dump($user); 
           dump($form);
       }
       if ($user->getAvatar() instanceof File) {
                   $user->setAvatar($user->getAvatar()->getFilename());
        }

       
        return $this->render('user/edit.html.twig', [
            
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/editpassword")
     */
    public function editpassword(UserPasswordEncoderInterface $encoder, Request $request){        
        $user = $this->getUser();
        /*
        dump($user->getAvatar()->getFilename());
        $user->setAvatar(
                new File($this->getParameter('avatar_directory').'/'.$user->getAvatar())
            );
dump($user->getAvatar());
         * */

        $form = $this->createForm(UserPasswordType::class, $user);
        $form->handleRequest($request); 

       if($form->isSubmitted()){

           if($form->isValid()){              
               
            $encoded = $encoder->encodePassword($user, $user->getPlainpassword());
            $user->setPassword($encoded);
            $em = $this->getDoctrine()->getManager();

            $em->persist($user);                
            $em->flush();                
            $this->addFlash('success', 'Bravo '.$user->getFullName().', votre mot de passe a été modifié avec succès !'); 
            //return $this->redirectToRoute('app_security_login'); //redirection
           }
           else{
               $this->addFlash('error', 'erreur'); //ajout du message flash
           }
        } 
        
        if ($user->getAvatar() instanceof File) {
                   $user->setAvatar($user->getAvatar()->getBasename());
        }
        
        return $this->render('user/editpassword.html.twig', [
         'form' => $form->createView()
        ]);
  
    }
}
