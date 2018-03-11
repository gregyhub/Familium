<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

  
/**
 * @Route("/user")
 */
class UserController extends Controller
{
    
    /**
     * @Route("/{id}/{role}", defaults={"id"=null,"role"=null})
     */
    public function liste(Request $request, $id, $role)
    {
        $repostory = $this->getDoctrine()->getRepository(User::class);
        $users = $repostory->findAll();
        
        if(!is_null($id) && !is_null($role)){
            
            $em=$this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            $user->setRole($role);
            $em->persist($user);
            $em->flush();
        }
        
        return $this->render('admin/user/liste.html.twig', [
          'users' => $users
        ]);
    }
}
