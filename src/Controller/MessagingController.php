<?php

namespace App\Controller;

use App\Entity\Messaging;
use App\Entity\User;
use App\Form\MessagingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function dump;

class MessagingController extends Controller
{
    /**
     * @Route("/messaging/send/{id}")
     */
    public function send(Request $request, User $recipient)
    {
        
        $messaging = new Messaging();
        $messaging->setAuthor($this->getUser());
        $messaging->setRecipient($recipient);
        //creation du formulaire
        
        $form = $this->createForm(MessagingType::class, $messaging);
        
        $form->handleRequest($request);
        
       if($form->isSubmitted()){
           if($form->isValid()){
               
            $em = $this->getDoctrine()->getManager();
            $em->persist($messaging); 
            $em->flush(); 
            $this->addFlash('success', 'Le message à bien été transmit à '.$recipient->getFullName().'.'); //ajout du message flash
            return $this->redirectToRoute('app_index_index'); //redirection
            } else{
              $this->addFlash('error', 'erreur'); //ajout du message flash
            }
       }
        return $this->render('messaging/send.html.twig', [
            'form' => $form->createView(),
            'recipient' => $recipient
        ]);
    }
    
    /**
     * 
     * @Route("messagine/receive")
     */
    public function received()
    {                    
       $repository = $this->getDoctrine()->getRepository(Messaging::class);
       $messages = $repository->findBy(['recipient'=>$this->getUser()]);
       
       $em = $this->getDoctrine()->getManager();
       foreach ($messages as $message){
           if($message->getNewmessage()=="new"){
               $message->setNewmessage('old');
               $em->persist($message);
           }
       }
       $em->flush();
        return $this->render('messaging/messages.html.twig', [
            'messages' => $messages
        ]);
    }
    
    /**
     * 
     * @Route("messagine/sended")
     */
    public function sended()
    {                    
       $repository = $this->getDoctrine()->getRepository(Messaging::class);
       $messages = $repository->findBy(['author'=>$this->getUser()]);
       
        return $this->render('messaging/messages.html.twig', [
            'messages' => $messages
        ]);
    }
    
    
    public function countNews()
    {                    
       $repository = $this->getDoctrine()->getRepository(Messaging::class);
       $nb = $repository->countNews($this->getUser());
       Return new Response($nb[0][1]);
    }
    
}
