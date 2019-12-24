<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\PublicationType;
use AppBundle\Form\ComentariosType;
use BackendBundle\Entity\Publicacion;
use AppBundle\Form\CierraPublicacionType;
use BackendBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\Comentarios;

class PublicationController extends Controller {

	public function indexAction(Request $request) {
		
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();
		$publication = new Publicacion();
		$form = $this->createForm(PublicationType::class, $publication);

		$form->handleRequest($request);

		if ($form->isSubmitted()) {
			if ($form->isValid()) {

				//upload image
				$file = $form['imagen']->getData();

				if (!empty($file) && $file != null) {
					$ext = $file->guessExtension();

					if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'bmp' || $ext == 'png' || $ext == 'gif') {
						$file_name = $user->getId() . time() . "." . $ext;
						$file->move("uploads/publications/imagenes", $file_name);
						$publication->setImagen($file_name);
					} else {
						$publication->setImagen(null);
					}
				} else {
					$publication->setImagen(null);
				}

				//upload document

				$document = $form['documento']->getData();
				$dia = $form['dia_libre']->getData();
				if (!empty($document) && $document != null) {
					$ext = $document->guessExtension();

					if ($ext == 'pdf') {
						$document_name = $user->getId() . time() . "." . $ext;
						$document->move("uploads/publications/documentos", $document_name);
						$publication->setDocumento($document_name);
					} else {
						$publication->setDocumento(null);
					}
				} else {
					$publication->setDocumento(null);
				}
				$publication->setUsuario($user);
				$publication->setDiaLibre($dia);
				$publication->setCerrada(0);
				$publication->setCreatetAt(new \DateTime("now"));
				$em->persist($publication);
				$flush = $em->flush();

				if ($flush == null) {
					$status = "Publicación guardada correctamente";
					$this->addFlash('success', $status);
				} else {

					$status = "Error al añadir publicación";
					$this->addFlash('error', $status);
				}
			} else {
				$status = 'La publicación no se ha creado, datos no válidos';
			}
		
			return $this->redirectToRoute('home_publication');
			
			}
		
		

		$publications = $this->getPublication($request);
		$mensajes=$this->getContadorAction($request);
		
		return $this->render('AppBundle:Publication:home.html.twig', array(
					'form' => $form->createView(),
					'pagination' => $publications,
					'contador'=>$mensajes
		));
	}

	public function getPublication($request) {
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();

		$publications_repo = $em->getRepository('BackendBundle:Publicacion');
		$publication = $publications_repo->findBy(array('usuario' => $user));

		
		$publications_array = array();
		
		
//		foreach ($publications_array as $publi) {
//				
//			$publications_array[] = $publi->getText();
////			$publications_array1[]=$publi->getUsuario_id();
//		}
		$query = $publications_repo->createQueryBuilder('p')
				->where('p.usuario = :usuario_id AND p.cerrada != :cerrada')
				->setParameter('usuario_id', $user->getId())
				
				->orderBy('p.id', 'DESC')
				->getQuery();
		
		
		
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
				$publication, $request->query->getInt('page', 1), 5
		);
		return $pagination;
	}

	public function borraPublicacionAction(Request $request, $id = null) {
		
//		Para borrar una publicación hay que borrar primero todos sus mensajes ya que estos tienen como clave ajena
//		la id de la publicación
		
		$em = $this->getDoctrine()->getManager();

		
		$mensajes_privados_repo = $em->getRepository('BackendBundle:MensajePrivado');
		$mensajes = $mensajes_privados_repo->findBy(array(
			'publicacion' => $id
			
		));

		foreach ($mensajes as $msg) {
		
			$em->remove($msg);
		}
		$em->flush();
		
		$publicaciones_repo = $em->getRepository("BackendBundle:Publicacion");
		
		$publicacion = $publicaciones_repo->find($id);
		$user = $this->getUser();
		if ($user->getId() == $publicacion->getUsuario()->getId()) {
			$em->remove($publicacion);

			$flush = $em->flush();

			if ($flush == null){
				$status = 'La publicación se ha borrado correctamente';
				$this->addFlash('success', $status);
			}
			else{
				$status = 'La publicación no se ha borrado correctamente';
				$this->addFlash('error', $status);
			}
		}
		return new Response($status);
	}
	
	 public function cierraPublicacionAction(Request $request){
		 $publicacion = $request->query->get('publicacion');
		 $em = $this->getDoctrine()->getManager();
		 $publications_repo = $em->getRepository('BackendBundle:Publicacion');
		 $publication = $publications_repo->find(array('id' => $publicacion));
		 $user=$this->getUser();
		 
//		 $user=$this->getUser();
		$comentario=new Comentarios();
		
	
//				
//				$em->persist($comentario);
//				$flush = $em->flush();

		
		$form = $this->createForm(ComentariosType::class,$comentario,array(
			'empty_data'=> $publication,
			'allow_extra_fields'=>$user
			
		));

		$form->handleRequest($request);
		
		if ($form->isSubmitted()) {
			$publication->setCerrada(1);
			$comentario->setEmisor($user);
			$comentario->setPublicacion($publication);
			$comentario->setFecha(new \DateTime("now"));
			$em->persist($comentario);
			
			$em->flush();

            $mensajes_privados_repo = $em->getRepository('BackendBundle:MensajePrivado');
            $mensajes = $mensajes_privados_repo->findBy(array(
                'publicacion' => $publicacion

            ));

            foreach ($mensajes as $msg) {

                $em->remove($msg);
            }
            $em->flush();
			$status = 'La publicación se ha cerrado correctamente';
			$this->addFlash('success', $status);
			return $this->redirectToRoute("home_publication");
		}
		return $this->render('AppBundle:Publication:cierra_publicacion.html.twig', array(
					'form' => $form->createView()
					
					
			
		));
		
			
	 }
	
	 public function getContadorAction(Request $request=null) {
		
		$em = $this->getDoctrine()->getManager();
		$user = $this->getUser();

		$publications_repo = $em->getRepository('BackendBundle:Publicacion');
		$publication = $publications_repo->findBy(array('usuario' => $user));
		$publicacion_array=array();
		
		foreach($publication as $publi){
			$publicacion_array[]=$publi->getId();
			
			
		}
		
		$mensajes_repo=$em->getRepository('BackendBundle:MensajePrivado');
		$mensaje = $mensajes_repo->findBy(array('receptor' => $user));
		
		$mensajes_array=array();
		
		foreach($mensaje as $mensa){
			$mensajes_array[]=$mensa->getReceptor();
			
			
		}
//		select count(id) from mensaje_privado where publicacion IN (select id from publicaciones where id=48 )
		$query = $mensajes_repo->createQueryBuilder('p')
				->where('p.publicacion IN (:publicacion) AND p.receptor IN (:mensajes)')
				->setParameter('mensajes',$mensajes_array)
				->setParameter('publicacion',$publicacion_array)
				->getQuery();
		
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
				$query, $request->query->getInt('page', 1), 5
		);
		
		return $pagination;
	}
	 
	
}
