<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Event;
use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends Controller
{
    /**
     * @Route("/ajax/category")
     */
    public function category(Request $request)
    {
        if($request->request->get('category')){
            $id = $request->request->get('category');
            $repository = $this->getDoctrine()->getRepository(Category::class);
            $category = $repository->find($id);
            $response=[];
            if($category->getName() == 'Evenement'){
                
               /* $test = $this->get('event_form');
                $user=$this->getUser();
                dump($test->formEvent($user));
                return new JsonResponse(array('success' => $test));*/
                return new JsonResponse(array('success' => 'event'));
            
            }elseif($category->getName() == 'Naissance'){
                $response=array('success' => 'Naissance');
            }
            
            return new JsonResponse($response);
        }
         
           
    }
}
