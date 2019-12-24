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


class UserController extends Controller{
	
	
	public function loginAction(Request $request){
		if(is_object($this->getUser())){
			return	$this->redirect ('home');
			
			
		}
		
		
		$authenticationUtils =$this ->get('security.authentication_utils');
		$error = $authenticationUtils -> getLastAuthenticationError();
		$lastUserName = $authenticationUtils->getLastUserName();
		
		
	
		return $this->render('AppBundle:User:login.html.twig', array(
				'last_username' => $lastUserName,
			    'error' => $error
			
			));
	
	}
	
	public function registerAction(Request $request){
		
		if(is_object($this->getUser())){
			return	$this->redirect ('home');
			
			
		}
		$user = new Usuario();
		$form = $this->createForm(RegisterType::class, $user) ;
	
		$form -> handleRequest($request);
		 
		if($form->isSubmitted()){
			if($form->isValid()){
				$em = $this->getDoctrine()->getManager();
				//$user_repo = $em->getRepository("BackendBundle:User"); 
				
				$query = $em -> createQuery('SELECT u FROM BackendBundle:Usuario u WHERE u.email= :email OR u.nick =  :nick')
						     -> setParameter('email',$form->get("email")->getData())
						->setParameter('nick',$form->get("nick")->getData()) ;
				
				$user_isset = $query->getResult();
				
				if(count($user_isset)== 0){
					$factory = $this->get("security.encoder_factory");
					$encoder = $factory->getEncoder($user);
					
					$password = $encoder->encodePassword($form->get("password")->getData(), $user->getSalt());
					
					$user->setPassword($password);
					$user-> setRole("ROLE_USER");
					$user ->setImagen(null);
					
					$em -> persist($user);
					$flush =$em->flush();
					
					if($flush == null){
						$status="Usuario registrado correctamente";
						
						$this ->addFlash('success', $status);
						
						return $this->redirect("login");
						
					}else{
						$status="El usuario no se ha podido registrar";
					}
					
					
				}else{
					$status = " El usuario ya existe";
				  }
				
					
					
			}else{
				$status =" No te has registrado correctamente";
			}
			$this ->addFlash('error', $status);
		}
		
		return $this->render('AppBundle:User:register.html.twig', array(
				"form" => $form->createView() 
			
			));
	
	}
	
	public function nickTestAction(Request $request){
		$nick = $request->get("nick");
		
		$em = $this->getDoctrine()->getManager();
		$user_repo = $em->getRepository("BackendBundle:Usuario");
		$user_isset= $user_repo->findOneBy(array("nick" => $nick));
		
		$result ="used";
		
		if(empty($user_isset) ){
			$result ="unused";
			
		}else{
			$result="used";
		}
		return new Response($result);
	}
	
	public function editUserAction(request $request){
		$user = $this ->getUser();
		$user_imagen=$user->getImagen();
		
		$form  =$this ->createForm(UserType::class, $user);
				
		
		$form -> handleRequest($request);
		 
		if($form->isSubmitted()){
			if($form->isValid()){
				$em = $this->getDoctrine()->getManager();
				
				
				$query = $em -> createQuery('SELECT u FROM BackendBundle:Usuario u WHERE u.email= :email OR u.nick =  :nick')
						     -> setParameter('email',$form->get("email")->getData())
						->setParameter('nick',$form->get("nick")->getData()) ;
				
				$user_isset = $query->getResult();
				
				if((count($user_isset)== 0 || $user -> getEmail()== $user_isset[0]->getEmail() && $user->getNick()== $user_isset[0]->getNick()) ){
					
					// upload file
					
					$file= $form["imagen"]->getData();
					
					if(!empty($file) && $file !=null){
						$ext= $file->guessExtension();
						if($ext == 'jpg' || $ext == 'jpeg' || $ext == 'bmp' || $ext == 'png' || $ext == 'gif'){
							$file_name=$user->getId() . time() . '.' .$ext;
							$file->move("uploads/usuarios", $file_name);
							$user -> setImagen($file_name);
							
						}
						
					}else{
						$user -> setImagen($user_imagen);
						
					}
					
					$em -> persist($user);
					$flush =$em->flush();
					
					if($flush == null){
						$status="Datos modificados correctamente";
						$this ->addFlash('success', $status);
						
					}else{
						$status="No se han podido modificar los datos correctamente";
						$this ->addFlash('error', $status);
					}
					
					
				}else{
					$status = " El usuario ya existe";
					$this ->addFlash('error', $status);
				  }
				
					
					
			}else{
				$status ="No se han podido modificar los datos correctamente";
			}
			
			return $this->redirect("my-data");
		}
		return $this->render('AppBundle:User:edit_user.html.twig', array(
			"form" => $form->createView()
				
			
			));
	}
	public function usuariosAction(request $request){
		$em= $this ->getDoctrine() ->getManager();
		$user = $this ->getUser();
		$nombre= $user->getNombre();
		$dql = "SELECT u FROM BackendBundle:Publicacion u WHERE u.usuario_id <>". $user->getId();
//		$dql_usuarios="SELECT n FROM BackendBundle:Usuario n WHERE n.id =" . $user->getId();
//		select nombre from usuarios where id IN SELECT usuario_id FROM publicaciones
		$query= $em -> createQuery($dql);
//		$query_usuarios= $em -> createQuery($dql_usuarios);
		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator -> paginate(
				$query, 
				$request->query->getInt('page', 1),
				5 
				); //5 usuarios por página
		return $this -> render('AppBundle:User:users.html.twig',
				array(
					'pagination' => $pagination ,
					'nombre' => $nombre
					
				));
		
	}
	
	public function searchAction(request $request){
		$em= $this ->getDoctrine() ->getManager();
		$user=$this->getUser();
		
		$search=$request->query->get("fecha",null);
//		$time = strtotime($search);
//
//		$newformat = date('Y-m-d',$time);
//		
//		echo $newformat;
//		if($search == null)
//			return $this->redirect($this->generateURL('home_publication'));
		
		$dql = "SELECT u FROM BackendBundle:Publicacion u WHERE (u.provincia = :provincia AND u.tipo = :tipo) OR (u.provincia = :provincia AND u.tipo= :tipo AND u.diaLibre = :fecha "
				. " AND  u.horaInicio <= :hora_inicio AND u.horaFin >= :hora_fin AND u.usuario_id <>". $user->getId() .")  ORDER BY u.id ASC ";
		
//		$query= $em -> createQuery($dql)-> setParameter('fecha',"%newformat%");
//		$query= $em -> createQuery($dql);
		$query= $em -> createQuery($dql)->setParameters(array(
			':fecha' => $request->query->get("fecha",null),
			':hora_inicio' => $request->query->get("hora_inicio",null),
				':hora_fin' => $request->query->get("hora_fin",null),
			':tipo' => $request->query->get("tipo",null),
			':provincia' => $request->query->get("provincia",null)
		));
//		echo $request;
		$paginator = $this -> get('knp_paginator');
		$pagination = $paginator -> paginate(
				$query, 
				$request->query->getInt('page', 1),
				5 
				); //5 usuarios por página
		return $this -> render('AppBundle:User:users.html.twig',
				array(
					'pagination' => $pagination 
					
				));
		
	}
	
	
	public function perfilAction(Request $request, $nick=null){
		
		$em=$this->getDoctrine()->getManager();
		if($nick !=null){
			$user_repo=$em->getRepository("BackendBundle:Usuario");
			$user=$user_repo->findOneBy(array('nick'=>$nick));
			
			
		}else{
			$user=$this->getUser();
			
		}
		if(empty($user) || !is_object($user)){
			return $this->redirect($this->generateURL('home_publication'));
			
		}
		$user_id=$user->getId();
		$dql="SELECT c FROM BackendBundle:Comentarios c WHERE c.receptor= $user_id ORDER BY c.fecha DESC";
		$query=$em->createQuery($dql);
		
		$paginator=$this->get('knp_paginator');
		$comentarios=$paginator->paginate(
				$query,
				$request->query->getInt('page',1),
				5);
		
		return $this->render('AppBundle:User:perfil.html.twig',array(
			'user'=>$user,
			'pagination'=>$comentarios
			
		));
		
	}

    public function adminAction(request $request){
        $em= $this ->getDoctrine() ->getManager();
        $user = $this ->getUser();
        $nombre= $user->getNombre();
        $dql = "SELECT u FROM BackendBundle:Usuario u";
//		$dql_usuarios="SELECT n FROM BackendBundle:Usuario n WHERE n.id =" . $user->getId();
//		select nombre from usuarios where id IN SELECT usuario_id FROM publicaciones
        $query= $em -> createQuery($dql);
//		$query_usuarios= $em -> createQuery($dql_usuarios);
        $paginator = $this -> get('knp_paginator');
        $pagination = $paginator -> paginate(
            $query,
            $request->query->getInt('page', 1),
            5
        ); //5 usuarios por página
        return $this -> render('AppBundle:User:admin.html.twig',
            array(
                'pagination' => $pagination


            ));

    }


    public function borraUsuarioAction(Request $request, $id = null) {
		

		
		$em = $this->getDoctrine()->getManager();

		
		$usuarios_repo = $em->getRepository("BackendBundle:Usuario");
		
		$usuario = $usuarios_repo->find($id);
		
		if ($id == $usuario->getId()) {
			$em->remove($usuario);

			$flush = $em->flush();

			if ($flush == null){
				$status = 'El usuario se ha borrado correctamente';
				$this->addFlash('success', $status);
			}
			else{
				$status = 'El usuario no se ha borrado correctamente';
				$this->addFlash('error', $status);
			}
		}
		return $this->redirectToRoute('user_admin');


	}
}