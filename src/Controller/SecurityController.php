<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/inscription")
     */
    public function register(UserPasswordEncoderInterface $encoder, Request $request)
    {
        if($this->isLogged()===true){ return $this->redirectToRoute('app_index_index'); }//redirection 
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request); //le formulaire traite la requete HTTP
       //le formulaire a été envoyé ou NON ? si oui, il fait le mapping avec notre objet category et effectue les Setter à notre place
       //si le formulaire a été envoyé
       if($form->isSubmitted()){
           //si il n'y a pas d'erreur de validation du formulaire > dans la class category
           if($form->isValid()){
               $encoded = $encoder->encodePassword($user, $user->getMdpclair());
               $user->setMdp($encoded);
                
               $em = $this->getDoctrine()->getManager();
               $em->persist($user); 
               $em->flush();
               $this->addFlash('success', 'Bravo '.$user->getFullName().', votre compte a été crée mais vous devez attendre la validation d\'un administrateur !'); //ajout du message flash
               return $this->redirectToRoute('app_index_index'); //redirection
           }
           else{
               $this->addFlash('error', 'erreur'); //ajout du message flash
           }
       }
        return $this->render('security/register.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/login")
     */
    public function login(AuthenticationUtils $authenticationUtils) {
        if($this->isLogged()===true){ return $this->redirectToRoute('app_index_index'); }//redirection 
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/login.html.twig',
                                [
                                    'error' => $error,
                                    'last_username' => $lastUsername
                                ]
                            );
    }
    /**
     * @Route("/logout")
     */
    public function logout() {
        
       //cette méthode n'est jamais executée car la route est défini dans le fichier security.yaml.
        //symfony intercepte cette route pour nous déconnecter et nous rediriger sur la page défini aussi sur la conf.
    }
    
    private function isLogged(){
        if($this->getUser()){
            return true;
        }
        return false;
    }
}

