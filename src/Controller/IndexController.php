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
        $repo = $this->getDoctrine()->getRepository(SuperArticle::class);
        $lastArticles = $repo->findAllArticles();
        return $this->render('index/index.html.twig',
                [
                    'last_articles' => $lastArticles
                ]
                );
    }
}
