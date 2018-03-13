<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Waitingroom;
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
        if(!is_null($id) && !is_null($role)){
            
            $em=$this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->find($id);
            //dump($this->getId());
            if($role=="enable"){
                $user->setIsActive(true);
            }
            elseif($role=='disable'){
                $user->setIsActive(false);
                $user->setRole('ROLE_USER');
            }
            else{
                $user->setRole($role);
            }
            $em->persist($user);
            $em->flush();
        }
        
        $repostory = $this->getDoctrine()->getRepository(User::class);
        $users = $repostory->findAllActive(); // par défaut ceux qui sont acti
        $usersInactive = $repostory->findAllActive(0); // les users inactive
        
        return $this->render('admin/user/liste.html.twig', [
          'users' => $users,
          'users_inacttive' => $usersInactive
        ]);
    }
}
