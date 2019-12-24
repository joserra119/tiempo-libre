<?php

namespace BackendBundle\Repositorios;


class getUsuarios extends \Doctrine\ORM\EntityRepository{
	
	public function getUsuariosPublicacion($publication, $user){
		$em = $this->getEntityManager();
		$mensajes_repo=$em->getRepository('BackendBundle:MensajePrivado');
		$mensajes=$mensajes_repo->findBy(array('publicacion' =>$publication));
		
		$mensajes_array=array();
		
		foreach($mensajes as $mensa){
			$mensajes_array[]=$mensa->getEmisor();
			
		}
		$users_repo=$em->getRepository('BackendBundle:Usuario');
		$query = $users_repo->createQueryBuilder('u')
				->where('u.id != :user AND u.id IN (:publicacion)')
				->setParameter('publicacion',$mensajes_array)
				->setParameter('user',$user)
				->orderBy('u.id','DESC');
				
				
		return $query;
		
		
	}
	
}
