<?php

namespace App\Controller;

use App\Entity\SuperArticle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @Route("/")
     * La page d'accueil de notre site pour les membres connecté.
     * Cette page affichera les dernier articles/event/Birth publié sur le site. 
     */
    public function index()
    {
       /* $repo = $this->getDoctrine()->getRepository(Article::class);
        $lastArticles = $repo->findLatest(3);*/
        $repoArticles = $this->getDoctrine()->getRepository(SuperArticle::class);
        $allArticles = $repoArticles->findAllArticles();
        $repoComments = $this->getDoctrine()->getRepository(\App\Entity\Comment::class);
        
        foreach ($allArticles as $article){
            $article->setNbComment($repoComments->countComments($article->getId()));
        }
        return $this->render('index/index.html.twig',
                [
                    'last_articles' => $allArticles
                ]
                );
    }
}
