<?php

namespace App\Controller;

use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function edit(UserPasswordEncoderInterface $encode, Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user, ['controller' => 'user']);
        $form->handleRequest($request); //le formulaire traite la requete HTTP
       //le formulaire a été envoyé ou NON ? si oui, il fait le mapping avec notre objet category et effectue les Setter à notre place
       //si le formulaire a été envoyé
       if($form->isSubmitted()){
           //si il n'y a pas d'erreur de validation du formulaire > dans la class category
           if($form->isValid()){
                $encoded = $encode->encodePassword($user, $user->getMdpclair());
                $user->setMdp($encoded);
                
                $em = $this->getDoctrine()->getManager();
               //prépare l'enregistement en bdd
               $em->persist($user); //on peut faire plusieurs persist puis 1 seul flush a la fin
               //fait l'enregistement en bdd
               $em->flush(); //execute des transaction SQL. si tout passe va envoie en bdd, sinon fait un rollback
               $this->addFlash('success', 'Bravo '.$user->getFullName().', votre compte a été modifié avec succès !'); //ajout du message flash
               // return $this->redirectToRoute('app_index_index'); //redirection
           }
           else{
               $this->addFlash('error', 'erreur'); //ajout du message flash
           }
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
