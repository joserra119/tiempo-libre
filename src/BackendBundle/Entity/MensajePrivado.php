<?php

namespace BackendBundle\Entity;

/**
 * MensajePrivado
 */
class MensajePrivado
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $mensaje;

    /**
     * @var \DateTime
     */
    private $createtAt;

    /**
     * @var string
     */
    private $archivo;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $leido;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \BackendBundle\Entity\Usuario
     */
    private $emisor;

    /**
     * @var \BackendBundle\Entity\Usuario
     */
    private $receptor;

	/**
     * @var integer
     */
    private $publicacion;
	
	
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
     * Set mensaje
     *
     * @param string $mensaje
     *
     * @return MensajePrivado
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;

        return $this;
    }

    /**
     * Get mensaje
     *
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set createtAt
     *
     * @param \DateTime $createtAt
     *
     * @return MensajePrivado
     */
    public function setCreatetAt($createtAt)
    {
        $this->createtAt = $createtAt;

        return $this;
    }

    /**
     * Get createtAt
     *
     * @return \DateTime
     */
    public function getCreatetAt()
    {
        return $this->createtAt;
    }

    /**
     * Set archivo
     *
     * @param string $archivo
     *
     * @return MensajePrivado
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return string
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return MensajePrivado
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set leido
     *
     * @param string $leido
     *
     * @return MensajePrivado
     */
    public function setLeido($leido)
    {
        $this->leido = $leido;

        return $this;
    }

    /**
     * Get leido
     *
     * @return string
     */
    public function getLeido()
    {
        return $this->leido;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return MensajePrivado
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set emisor
     *
     * @param \BackendBundle\Entity\Usuario $emisor
     *
     * @return MensajePrivado
     */
    public function setEmisor(\BackendBundle\Entity\Usuario $emisor = null)
    {
        $this->emisor = $emisor;

        return $this;
    }

    /**
     * Get emisor
     *
     * @return \BackendBundle\Entity\Usuario
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
     * @return MensajePrivado
     */
    public function setReceptor(\BackendBundle\Entity\Usuario $receptor = null)
    {
        $this->receptor = $receptor;

        return $this;
    }

    /**
     * Get receptor
     *
     * @return \BackendBundle\Entity\Usuario
     */
    public function getReceptor()
    {
        return $this->receptor;
    }
	
	/**
     * Set publicacion
     *
     * @param integer $publicacion
     *
     * @return MensajePrivado
     */
    public function setPublicacion($publicacion)
    {
        $this->publicacion = $publicacion;

        return $this;
    }

    /**
     * Get publicacion
     *
     * @return integer
     */
    public function getpublicacion()
    {
        return $this->publicacion;
    }
}
