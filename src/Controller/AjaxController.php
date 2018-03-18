<?php

namespace App\Controller;

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
        dump($request->request->get('category'));
       if($request->request->get('category')){
            //make something curious, get some unbelieveable data
            $arrData = ['output' => 'here the result which will appear in div'];
            return new JsonResponse($arrData);
        }
         
            $response = new JsonResponse();
            $response->setStatusCode(200);
	    //ajout de données éventuelles
            $response->setData(array(
                'successMessage' => "Votre message a bien été envoyé"));
            return $response;
    }
}
