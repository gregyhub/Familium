<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends Controller
{
    /**
     * @Route("/member")
     * La page d'accueil de notre site pour tout les membres.
     */
    public function member()
    {
       /* $repo = $this->getDoctrine()->getRepository(Article::class);
        $lastArticles = $repo->findLatest(3);*/
        $repo = $this->getDoctrine()->getRepository(User::class);
        $allmember = $repo->findAll();
        return $this->render('member/member.html.twig',
                [
                    'allmember' => $allmember
                ]
                );
    }

}
