<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Photo;
use App\Form\PhotoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PhotoController extends Controller
{
    /**
     * @Route("/photo/{id}")
     */
    public function add(Album $album, Request $request)
    {
        if($album->getAuthor() == $this->getUser()){
            $em = $this->getDoctrine()->getManager();
            $photo = new Photo();
            $photo->setAlbum(array($album));
            $form = $this->createForm(PhotoType::class, $photo);

            $form->handleRequest($request); 
            if($form->isSubmitted()){
                if($form->isValid()){
                    $photoUpload = $photo->getPhoto();
                    if(!is_null($photoUpload)){
                         $photoname= uniqid().'.'.$photoUpload->guessExtension();
                         $photo->setPhoto($photoname);
                         $photoUpload->move($this->getParameter('album_directory'), $photoname);
                     }
                   /* $user = $this->get('security.token_storage');
                     dump($user);*/
                     $em->persist($photo);      
                     $em->flush(); 
                     $this->addFlash('success', 'vous avez ajouté une photo à votre album'); 
                     //return $this->redirectToRoute('app_index_index'); //redirection
                } else{
                     $this->addFlash('error', 'erreur'); 
                 }
            }

            return $this->render('photo/add.html.twig', [
                 'form' => $form->createView(),
            ]);
       }
       else{
           return $this->redirectToRoute('app_index_index');
       }
    }
}
