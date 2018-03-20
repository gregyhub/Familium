<?php

namespace App\Controller;

use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use function dump;

class UserController extends Controller
{
    /**
     * @Route("/user")
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
    public function edit(UserPasswordEncoderInterface $encode, Request $request, AuthenticationUtils $authenticationUtils){
        
        $user = $this->getUser();
        $originalAvatar=null;

        if(!is_null($user->getAvatar())){
            $originalAvatar = $user->getAvatar();
            $user->setAvatar(
                new File($this->getParameter('avatar_directory').'/'.$user->getAvatar())
            );
        }
        $form = $this->createForm(UserType::class, $user, ['controller' => 'user']);
        $form->handleRequest($request); //le formulaire traite la requete HTTP
       //le formulaire a été envoyé ou NON ? si oui, il fait le mapping avec notre objet category et effectue les Setter à notre place
       //si le formulaire a été envoyé
       if($form->isSubmitted()){
           //si il n'y a pas d'erreur de validation du formulaire > dans la class category
           if($form->isValid()){
               
               $avatar = $user->getAvatar();
               dump($user);
               if(!is_null($avatar)){
                    $avatarname= uniqid().'.'.$avatar->guessExtension();
                    $user->setAvatar($avatarname);
                    $avatar->move($this->getParameter('avatar_directory'), $avatarname);
                    if(!is_null($originalAvatar)){
                        //je rentre dans cette condition si le champ file est rempli, et uniquement si original image n'est pas null
                        //sioriginalImage est null c'est que c'est l'ajout un nouvel articl ou la modification d'un article qui n'avait pas d'image
                        unlink($this->getParameter('avatar_directory').'/'. $originalAvatar);
                    }
                }else{
                    $user->setAvatar($originalAvatar);
                }
                    
                $em = $this->getDoctrine()->getManager();
<<<<<<< HEAD
               //prépare l'enregistement en bdd
               $em->persist($user); //on peut faire plusieurs persist puis 1 seul flush a la fin
               //fait l'enregistement en bdd
               $em->flush(); //execute des transaction SQL. si tout passe va envoie en bdd, sinon fait un rollback
               $this->addFlash('success', 'Bravo '.$user->getFullName().', votre compte a été modifié avec succès !'); //ajout du message flash
               // return $this->redirectToRoute('app_index_index'); //redirection
=======
                   //prépare l'enregistement en bdd
                $em->persist($user); //on peut faire plusieurs persist puis 1 seul flush a la fin
                   //fait l'enregistement en bdd
                $em->flush(); //execute des transaction SQL. si tout passe va envoie en bdd, sinon fait un rollback
                   
                $this->addFlash('success', 'Bravo '.$user->getFullName().', votre compte a été modifié avec succès !'); //ajout du message flash
               
               return $this->redirectToRoute('app_user_view'); //redirection
>>>>>>> ba0d313f80b1d0c1e1d64f84c5cb97283f4ba7c0
           }
           else{
               $this->addFlash('error', 'erreur'); //ajout du message flash
           }
       }
       if ($user->getAvatar() instanceof File) {
                   $user->setAvatar($user->getAvatar()->getFilename());
        }

       
        return $this->render('user/edit.html.twig', [
            
            'form' => $form->createView()
        ]);
        
    }
    /**
     * @Route("/login", name="login")
     */
    public function loginAction() {
        $helper = $this->get('security.authentication_utils');
      
        return $this->render('default/login.html.twig', array(
            'last_username' => $helper->getLastUsername(),
            'error' => $helper->getLastAuthenticationError()
        ));
    }
    
}
