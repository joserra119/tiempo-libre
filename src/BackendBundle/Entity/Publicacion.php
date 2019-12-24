<?php

namespace BackendBundle\Entity;

/**
 * Publicacion
 */
class Publicacion
{
	
	/**
     * @var string
     */
    private $tipo;
	
	
    /**
     * @var integer
     */
    private $id;
	
	/**
     * @var integer
     */
    private $usuario_id;

    /**
     * @var string
     */
    private $text;

    /**
     * @var string
     */
    private $documento;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var \DateTime
     */
    private $createtAt;

    /**
     * @var \DateTime
     */
    private $diaLibre;

    /**
     * @var \DateTime
     */
    private $horaInicio;

    /**
     * @var \DateTime
     */
    private $horaFin;

    /**
     * @var \BackendBundle\Entity\Usuario
     */
    private $usuario;
	
	/**
     * @var string
     */
    private $asunto;

    
	/**
     * @var integer
     */
    private $mensajes;
	
	/**
     * @var integer
     */
    private $cerrada;
	
	/**
     * @var string
     */
    private $provincia;
	
	
	/**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }
	
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
     * Set text
     *
     * @param string $text
     *
     * @return Publicacion
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set documento
     *
     * @param string $documento
     *
     * @return Publicacion
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Publicacion
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
     * Set estado
     *
     * @param string $estado
     *
     * @return Publicacion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set createtAt
     *
     * @param \DateTime $createtAt
     *
     * @return Publicacion
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
     * Set diaLibre
     *
     * @param \DateTime $diaLibre
     *
     * @return Publicacion
     */
    public function setDiaLibre($diaLibre)
    {
        $this->diaLibre = $diaLibre;

        return $this;
    }

    /**
     * Get diaLibre
     *
     * @return \DateTime
     */
    public function getDiaLibre()
    {
        return $this->diaLibre;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     *
     * @return Publicacion
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFin
     *
     * @param \DateTime $horaFin
     *
     * @return Publicacion
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get horaFin
     *
     * @return \DateTime
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Set usuario
     *
     * @param \BackendBundle\Entity\Usuario $usuario
     *
     * @return Publicacion
     */
    public function setUsuario(\BackendBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \BackendBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
	
	/**
     * Get usuario_id
     *
     * @return string
     */
    public function getUsuario_Id()
    {
        return $this->usuario_id;
    }
	
	/**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return Publicacion
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }
	
	/**
     * Set mensajes
     *
     * @param integer $mensajes
     *
     * @return Publicacion
     */
    public function setMensajes($mensajes)
    {
        $this->mensajes = $mensajes;

        return $this;
    }

    /**
     * Get mensajes
     *
     * @return integer
     */
    public function getMensajes()
    {
        return $this->mensajes;
    }
	
	
	/**
     * Set cerrada
     *
     * @param integer $cerrada
     *
     * @return Publicacion
     */
    public function setCerrada($cerrada)
    {
        $this->cerrada = $cerrada;

        return $this;
    }

    /**
     * Get cerrada
     *
     * @return integer
     */
    public function getCerrada()
    {
        return $this->cerrada;
    }
	

    /**
     * Set usuarioId
     *
     * @param integer $usuarioId
     *
     * @return Publicacion
     */
    public function setUsuarioId($usuarioId)
    {
        $this->usuario_id = $usuarioId;

        return $this;
    }

    /**
     * Get usuarioId
     *
     * @return integer
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }
	
	/**
     * Set provincia
     *
     * @param string $provincia
     *
     * @return provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
	
}
