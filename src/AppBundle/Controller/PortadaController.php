<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\Usuario;
use AppBundle\Form\RegisterType;
use AppBundle\Form\UserType;


use Symfony\Component\HttpFoundation\Session\Session;


class PortadaController extends Controller{
	
	
	public function inicioAction(Request $request){
		
		return $this->render('AppBundle:Portada:portada.html.twig');
		
	}
	
	
}