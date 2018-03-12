<?php

namespace App\Controller;

use App\Entity\Birth;
use App\Form\BirthType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\File;
 /**
* @Route("/birth")
*/
class BirthController extends Controller
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('birth/index.html.twig', [
            'controller_name' => 'BirthController',
        ]);
    }
    
     /**
     * @Route("/edit/{id}", defaults={"id":null})
     */
    public function edit(Request $request, $id)
    {
       $em = $this->getDoctrine()->getManager();
       $originalImage = null;
       if(is_null($id)){
           $birth = new Birth(); //on instancie notre entité category
           //l'auteur de l'article est l'utilisateur connecté
           $birth->setAuthor($this->getUser());
       }else{
           //$birth = $em->getRepository(Article::class)->find($id);
           $birth = $em->find(Birth::class, $id);
           if(!is_null($birth->getPicture())){
               $originalImage = $birth->getPicture();
               $birth->setPicture(
                new File($this->getParameter('img_directory').'/'.$birth->getPicture())
            );
           }
           
       }
       $form = $this->createForm(BirthType::class, $birth); 
        //le createForm est un méthode de controller 
        /// le categoryType est une méthode de formulaire. 
        //on envoie aussi en paramtre notre objet category
       
       $form->handleRequest($request); //le formulaire traite la requete HTTP
       //le formulaire a été envoyé ou NON ? si oui, il fait le mapping avec notre objet category et effectue les Setter à notre place
       //si le formulaire a été envoyé
       if($form->isSubmitted()){
           if($form->isValid()){
           //si il n'y a pas d'erreur de validation du formulaire > dans la class category
            $file =  $birth->getPicture(); //équivalent à puisqu le formulaire est mappé sur article : $form['picture']->getData(); 
            
            if(!is_null($file)){
                $filename= uniqid().'.'.$file->guessExtension();
                $birth->setPicture($filename);
                $file->move($this->getParameter('img_directory'), $filename);
                
                if(!is_null($originalImage)){
                    //je rentre dans cette condition si le champ file est rempli, et uniquement si original image n'est pas null
                    //sioriginalImage est null c'est que c'est l'ajout un nouvel articl ou la modification d'un article qui n'avait pas d'image
                    unlink($this->getParameter('img_directory').'/'. $originalImage);
                }
            }else{
                if($form->has('remove_image') && $form->get('remove_image')->getData()){
                    //getdata envoie un booléan pour un check box, ou un chaine de caractère pour un input
                    unlink($this->getParameter('img_directory').'/'. $originalImage);
                    $birth->setPicture(null);
                }else{
                    $birth->setPicture($originalImage);
                }
            }
            //prépare l'enregistement en bdd
            $em->persist($birth); //on peut faire plusieurs persist puis 1 seul flush a la fin
            //fait l'enregistement en bdd
            $em->flush(); //execute des transaction SQL. si tout passe va envoie en bdd, sinon fait un rollback
            $this->addFlash('success', 'l\'article '.$birth->getTitle().' a été enregistrée'); //ajout du message flash
            return $this->redirectToRoute('app_birth_index'); //redirection
           } else{
              $this->addFlash('error', 'erreur'); //ajout du message flash
            }
       }
       
          return $this->render('birth/edit.html.twig', [
                'form' => $form->createView(),
                'original_image' => $originalImage
       ]);
    }
}
