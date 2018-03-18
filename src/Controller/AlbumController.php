<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Photo;
use App\Form\AlbumType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/album")
 */
class AlbumController extends Controller
{
    /**
     * @Route("/add")
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
    
    
    public function listeAside()
    {
        $albums = $this->getAlbums();
        return $this->render('album/list.html.twig', [
             'albums' => $albums,
        ]);
    }
    
    /**
     * 
     * @Route("/show/{id}")
     */
    public function show(Album $album=null)
    {        
        $em = $this->getDoctrine()->getRepository(Photo::class);
        $photos = $em->getPhotosByAlbum($album->getId());
        $album->setPhotos($photos);
        
        return $this->render('album/show.html.twig', [
            'album' => $album,
            'photos' => $photos
        ]);
    }
    
    /**
     * @Route("/myalbums")
     */
    public function myAlbums(){
        $em = $this->getDoctrine()->getRepository(Album::class);
        $user = $this->getUser();
        $albums = $em->findBy(['author' => $user->getId()]);
        
        $em = $this->getDoctrine()->getRepository(Photo::class);
        foreach($albums as $album){
             $photos = $em->getPhotosByAlbum($album->getId());
             $album->setPhotos($photos);
        }
        
        return $this->render('album/albums.html.twig', [
            'albums' => $albums
        ]);
    }
    
    /**
     * @Route("/liste")
     */
    public function liste(){
        $albums = $this->getAlbums();
        $em = $this->getDoctrine()->getRepository(Photo::class);
        foreach($albums as $album){
             $photos = $em->getPhotosByAlbum($album->getId());
             $album->setPhotos($photos);
        }
        return $this->render('album/albums.html.twig', [
            'albums' => $albums
        ]);
    }

    private function getAlbums(){
        $em = $this->getDoctrine()->getRepository(Album::class);
        $albums = $em->findBy(['visibility' => 'public']);
        return $albums;
    }
}
