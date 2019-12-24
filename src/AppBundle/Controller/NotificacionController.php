<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NotificacionController extends Controller
{
 
    public function indexAction(Request $request)
    {
      $em= $this->getDoctrine()->getManager();
	  
	  $user= $this->getUser();
	  
	  $user_id= $user->getId();
	  
	  $dql ="SELECT n FROM BackendBundle:Notificacion n WHERE n.usuario = ". $user_id ." ORDER BY n.id DESC";
	  
	  $query= $em->createQuery($dql);
	  
	  $paginator = $this->get('knp_paginator');
	  $notificaciones = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5
		);
		return $this->render ('AppBundle:Notificaciones:notificacion_page.html.twig', array(
			'usuario' => $user,
			'pagination' =>$notificaciones
			
		));
	  
	  
    }
}
