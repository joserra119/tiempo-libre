<?php

namespace AppBundle\Services;

use BackendBundle\Entity\Notificacion;

class NotificacionesService {
	
	public $manager;
	
	public function __construct($manager){
		$this->manager = $manager;
		
			
	}
	public function set($user, $tipo, $tipoId, $extra=null){
		$em= $this-> manager;
		
		$notificacion =new Notificacion();
		
		$notificacion->setUser($user);
		
		$notificacion->setTipo($tipo);
		
		$notificacion->setTipo_id($tipoId);
		
		$notificacion->setLeido(0);
		
		$notificacion ->setCreatetAt(new \DateTime("now"));
		
		$notificacion ->setExtra($extra);
		
		$em ->persist($notificacion);
		
		$flush=$em-> flush();
		
		if($flush==null)
			$status= true;
		
		else
			$status =false;
	
		return $status;
		
	}
	
}
