<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\Usuario;
use BackendBundle\Entity\MensajePrivado;
use Symfony\Component\HttpFoundation\Session\Session;
use AppBundle\Form\MensajePrivadoType;

class MensajePrivadoController extends Controller {

	public function indexAction(Request $request) {

		$usuario_id = $request->query->get('usuario');
		$publicacion = $request->query->get('publicacion');

		$em = $this->getDoctrine()->getManager();

			$dql = "SELECT p FROM BackendBundle:Usuario p WHERE p.id = '$usuario_id' ";

			$query = $em->createQuery($dql);
	
			$usuario_id = $query->getResult();
			
			$user = $this->getUser();
		

		$user_repo = $em->getRepository('BackendBundle:Usuario');

		$mensajes_privados = $this->getMensajesPrivados($request,$publicacion);
		
		$this->marcarLeidos($em, $user);
		return $this->render('AppBundle:MensajePrivado:index.html.twig', array(
					
					'pagination' => $mensajes_privados
					
					
		));
	}

	public function envia_mensajeAction(Request $request) {
		$usuario_id = $request->query->get('usuario');
		$publicacion = $request->query->get('publicacion');



		$em = $this->getDoctrine()->getManager();

		
			$dql = "SELECT p FROM BackendBundle:Usuario p WHERE p.id = '$usuario_id'";

			$dql_publi = "SELECT p FROM BackendBundle:Publicacion p WHERE p.id = '$publicacion'";

			
			$query = $em->createQuery($dql);

			$query_publi = $em->createQuery($dql_publi);

			$usuario_id = $query->getResult();
			$publicacion = $query_publi->getResult();
			$publi_id = $publicacion[0]->getId();
			$publicacion_asunto = $publicacion[0]->getAsunto();

			$usuario = $usuario_id[0]->getNombre();
			$user = $this->getUser();
		
			
			
			
			
		$mensaje_privado = new MensajePrivado();

		$form = $this->createForm(MensajePrivadoType::class, $mensaje_privado, array(
			'empty_data' => $user,
		));
		$form->handleRequest($request);

		$user_repo = $em->getRepository('BackendBundle:Usuario');

		if ($form->isSubmitted()) {
			if ($form->isValid()) {
				$file = $form['imagen']->getData();

				if (!empty($file) && $file != null) {
					$ext = $file->guessExtension();

					if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'bmp' || $ext == 'png' || $ext == 'gif') {
						$file_name = $user->getId() . time() . "." . $ext;
						$file->move("uploads/mensajes/imagenes", $file_name);
						$mensaje_privado->setImagen($file_name);
					} else {
						$mensaje_privado->setImagen(null);
					}
				} else {
					$mensaje_privado->setImagen(null);
				}

				//upload document

				$document = $form['archivo']->getData();

				if (!empty($document) && $document != null) {
					$ext = $document->guessExtension();

					if ($ext == 'pdf') {
						$document_name = $user->getId() . time() . "." . $ext;
						$document->move("uploads/mensajes/documentos", $document_name);
						$mensaje_privado->setArchivo($document_name);
					} else {
						$mensaje_privado->setArchivo(null);
					}
				} else {
					$mensaje_privado->setArchivo(null);
				}

				$mensaje_privado->setEmisor($user);
				$mensaje_privado->setReceptor($usuario_id[0]);
				$mensaje_privado->setLeido(0);
				$mensaje_privado->setPublicacion($publicacion[0]);


				$mensaje_privado->setCreatetAt(new \DateTime("now"));
				$em->persist($mensaje_privado);

				$flush = $em->flush();
				$publicaciones_repo = $em->getRepository('BackendBundle:Publicacion');
				$publicaciones = $publicaciones_repo->findBy(array(
				'id' => $publicacion[0]
					));

			
				
		 if($user != $usuario_id[0]){
			$publicaciones[0]->setMensajes(($publicacion[0]->getMensajes())+1);
				
		 $em->persist($publicaciones[0]);
		 
		$em->flush();
		 }
//				
				if ($flush == null) {
					$status = "Mensaje enviado correctamente";
					$this->addFlash('success', $status);
					return $this->redirect("home");
				} else {
					$status = "No se ha podido enviar el mensaje";
					$this->addFlash('error', $status);
				}
			} else {
				$status = "El mensaje privado no se ha podido enviar";
			}

			return $this->redirectToRoute("mensaje_privado_index");
		}

//		$publicaciones_repo = $em->getRepository('BackendBundle:Publicacion');
//		$publicaciones = $publicaciones_repo->findBy(array(
//			'id' => $publicacion[0]
//		));
//
//	
//		$mensajes_privados = $this->getMensajesPrivados($request);
//		$form->handleRequest($request);
////
//		$this->marcarLeidos($em, $user);
		return $this->render('AppBundle:MensajePrivado:enviar_mensaje.html.twig', array(
					'form' => $form->createView(),
					
					'usuario' => $usuario,
					'publicacion' => $publicacion_asunto
		));
		
		
//		$usuario_id = $request->query->get('usuario');
//		$em = $this->getDoctrine()->getManager();
//
//		echo $usuario_id;
//
//		$user = $this->getUser();
//
//		$mensaje_privado = new MensajePrivado();
//
//		$form = $this->createForm(MensajePrivadoType::class, $mensaje_privado, array(
//			'empty_data' => $user
//		));
		
//		return $this->render('AppBundle:MensajePrivado:enviar_mensaje.html.twig', array(
//					'form' => $form->createView()
//		));
	}

	public function enviadoAction(Request $request) {
		$mensajes_privados = $this->getMensajesPrivados($request, "enviado");

		return $this->render('AppBundle:MensajePrivado:enviado.html.twig', array(
					'pagination' => $mensajes_privados
		));
	}

	public function getMensajesPrivados($request,$publicacion,$tipo = null) {
		$em = $this->getDoctrine()->getManager();
		
		$user = $this->getUser();
		$user_id = $user->getId();

		if ($tipo == "enviado") {
			$dql = "SELECT p FROM BackendBundle:MensajePrivado p WHERE p.emisor = $user_id  ORDER BY p.id DESC";
		} else {
			$dql = "SELECT p FROM BackendBundle:MensajePrivado p WHERE p.receptor = $user_id AND p.publicacion"
					. "= $publicacion";
		}


		$query = $em->createQuery($dql);

		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5
		);
		return $pagination;
	}

	public function noLeidosAction() {
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();

		$mensajes_privados_repo = $em->getRepository('BackendBundle:MensajePrivado');

		$contador = count($mensajes_privados_repo->findBy(array(
					'receptor' => $user,
					'leido' => 0
		)));
		return new Response($contador);
	}

	private function marcarLeidos($em, $user) {
		$mensajes_privados_repo = $em->getRepository('BackendBundle:MensajePrivado');
		$mensajes = $mensajes_privados_repo->findBy(array(
			'receptor' => $user,
			'leido' => 0
		));

		foreach ($mensajes as $msg) {
			$msg->setLeido(1);
			$em->persist($msg);
		}
		$em->flush();
	}

	
	public function getTodosMensajesPrivadosAction(Request $request) {

		$usuario_id = $request->query->get('usuario');
		$publicacion = $request->query->get('publicacion');

		$em = $this->getDoctrine()->getManager();

			$dql = "SELECT p FROM BackendBundle:Usuario p WHERE p.id = '$usuario_id' ";

			$query = $em->createQuery($dql);
	
			$usuario_id = $query->getResult();
			
			$user = $this->getUser();
		

		$user_repo = $em->getRepository('BackendBundle:Usuario');

		$mensajes_privados = $this->getTodosMensajesPrivados($request,"recibido");
		
		$this->marcarLeidos($em, $user);
		return $this->render('AppBundle:MensajePrivado:index.html.twig', array(
					
					'pagination' => $mensajes_privados
					
					
		));
	}
	
	public function getTodosMensajesPrivados($request,$tipo = null) {
		$em = $this->getDoctrine()->getManager();
		
		$user = $this->getUser();
		$user_id = $user->getId();

		if ($tipo == "enviado") {
			$dql = "SELECT p FROM BackendBundle:MensajePrivado p WHERE p.emisor = $user_id  ORDER BY p.id DESC";
		} else {
			$dql = "SELECT p FROM BackendBundle:MensajePrivado p WHERE p.receptor = $user_id";
		}


		$query = $em->createQuery($dql);

		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5
		);
		return $pagination;
	}
	
}
