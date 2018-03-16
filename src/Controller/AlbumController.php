<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class AlbumController extends Controller
{
    /**
     * @Route("/album")
     */
    public function add(Request $request)
    {
       $em = $this->getDoctrine()->getManager();
       $album = new Album();
       $form = $this->createForm(AlbumType::class, $album);
      
       $form->handleRequest($request); 
       if($form->isSubmitted()){
           if($form->isValid()){
                $album->setAuthor($this->getUser());
                $em->persist($album);
                $em->flush(); 
                $this->addFlash('success', 'l\'album '.$album->getTitle().' a été crée'); 
                return $this->redirectToRoute('app_photo_add', ['id'=>$album->getId()]); //redirection
           } else{
                $this->addFlash('error', 'erreur'); 
            }
       }
       
        return $this->render('album/add.html.twig', [
             'form' => $form->createView(),
        ]);
    }
}
