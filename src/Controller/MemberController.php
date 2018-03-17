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
        $allmember = $repo->findAllActive();
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
        return $this->render('member/buttonuser.html.twig',
                [
                    'member' => $user
                ]
                );
    }
    
    /**
     * @Route("/member/send")
     * @param \Swift_Mailer $mailer
     * @return type
     */
    public function sendEmail(\Swift_Mailer $mailer){
        
        $message = (new \Swift_Message('Hello Email'))
        ->setFrom('send@example.com')
        ->setTo('gregmalaud@hotmail.com')
        ->setBody('You should see me from the profiler!')
    ;

        $mailer->send($message);
        return $this->render('member/member.html.twig',
        [
            
        ]
        );
       // return $this->redirectToRoute('app_index_index');
    }

}
