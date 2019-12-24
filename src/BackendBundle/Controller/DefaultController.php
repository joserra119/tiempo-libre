<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
		$em=$this->getDoctrine()->getManager();
		$usuario_repo=$em->getRepository("BackendBundle:Usuario");
		$usuario=$usuario_repo->find(1);
		echo "Bienvenido " .$usuario->getNombre();
//		var_dump($usuario);
		die();
		
        return $this->render('BackendBundle:Default:index.html.twig');
    }
}
