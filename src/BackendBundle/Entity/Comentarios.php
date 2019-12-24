<?php

namespace BackendBundle\Entity;

/**
 * Comentarios
 */
class Comentarios
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var \BackendBundle\Entity\Usuario
     */
    private $emisor;

	
	/**
     * @var \BackendBundle\Entity\Publicacion
     */
    private $publicacion;
	
	/**
     * @var \BackendBundle\Entity\Usuario
     */
    private $receptor;
	
	
	/**
     * @var integer
     */
    private $nota;
	
	/**
     * @var \DateTime
     */
    private $fecha;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Comentarios
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set emisor
     *
     * @param \BackendBundle\Entity\Usuario $emisor
     *
     * @return Comentarios
     */
    public function setEmisor(\BackendBundle\Entity\Usuario $emisor = null)
    {
        $this->emisor = $emisor;

        return $this;
    }

    /**
     * Get emisor
     *
     * @return \BackendBundle\Entity\Usuarios
     */
    public function getEmisor()
    {
        return $this->emisor;
    }
	
	
	
	 /**
     * Set receptor
     *
     * @param \BackendBundle\Entity\Usuario $receptor
     *
     * @return Comentarios
     */
    public function setReceptor(\BackendBundle\Entity\Usuario $receptor = null)
    {
        $this->receptor = $receptor;

        return $this;
    }

    /**
     * Get receptor
     *
     * @return \BackendBundle\Entity\Usuarios
     */
    public function getReceptor()
    {
        return $this->receptor;
    }
	
	
	
	/**
     * Set publicacion
     *
     * @param \BackendBundle\Entity\Usuario $publicacion
     *
     * @return Comentarios
     */
    public function setPublicacion(\BackendBundle\Entity\Publicacion $publicacion = null)
    {
        $this->publicacion = $publicacion;

        return $this;
    }

    /**
     * Get publicacion
     *
     * @return \BackendBundle\Entity\Publicacion
     */
    public function getPublicacion()
    {
        return $this->publicacion;
    }
	
	
	
	/**
     * Set nota
     *
     * @param integer $nota
     *
     * @return Comentarios
     */
    public function setNota($nota)
    {
        $this->nota = $nota;

        return $this;
    }

    /**
     * Get nota
     *
     * @return integer
     */
    public function getNota()
    {
        return $this->nota;
    }
	
	    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Comentarios
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getfecha()
    {
        return $this->fecha;
    }
}

