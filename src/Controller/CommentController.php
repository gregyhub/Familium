<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\SuperArticle;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use function dump;

class CommentController extends Controller
{
    
    
    public function newComment()
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        
        return $this->render('comment/newcomment.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    public function listComments($id){
        $em = $this->getDoctrine()->getRepository(Comment::class);
        $comments = $em->findBy(['article'=>$id]);
        
        return $this->render('comment/list.html.twig', [
            'comments' => $comments,
             'id_article' => $id
        ]);
    }
    
    /**
     * @Route("/comment/insert/{id}") //app_comment_insert
     */
    public function insert(Request $request, SuperArticle $article) {
        $comment = new Comment();
        $user=$this->getUser();
        $comment->setAuthor($user);
        $comment->setArticle($article);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment); 
        $em->flush();
        
        return $this->redirectToRoute('app_index_index'); //redirection
    }
}
