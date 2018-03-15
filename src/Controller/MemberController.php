<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends Controller
{
    /**
     * @Route("/member")
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
    /**
     * @Route("/member/view/{id}")
     */
    public function view(User $user)
    {
       /* $repo = $this->getDoctrine()->getRepository(Article::class);
        $lastArticles = $repo->findLatest(3);*/
        $repo = $this->getDoctrine()->getRepository(User::class);
        $allmember = $repo->findAll();
        return $this->render('member/user.html.twig',
                [
                    'user' => $user
                ]
                );
    }
    
    public function getButton(User $user){
        dump($user);
        return $this->render('member/buttonuser.html.twig',
                [
                    'member' => $user
                ]
                );
    }

}
