<?php

namespace BackendBundle\Entity;

/**
 * Notificacion
 */
class Notificacion
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $tipo;

    /**
     * @var integer
     */
    private $tipoId;

    /**
     * @var string
     */
    private $leido;

    /**
     * @var \DateTime
     */
    private $createtAt;

    /**
     * @var string
     */
    private $extra;

    /**
     * @var \BackendBundle\Entity\Usuario
     */
    private $usuario;


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
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Notificacion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set tipoId
     *
     * @param integer $tipoId
     *
     * @return Notificacion
     */
    public function setTipoId($tipoId)
    {
        $this->tipoId = $tipoId;

        return $this;
    }

    /**
     * Get tipoId
     *
     * @return integer
     */
    public function getTipoId()
    {
        return $this->tipoId;
    }

    /**
     * Set leido
     *
     * @param string $leido
     *
     * @return Notificacion
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
     * Set createtAt
     *
     * @param \DateTime $createtAt
     *
     * @return Notificacion
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
     * Set extra
     *
     * @param string $extra
     *
     * @return Notificacion
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * Get extra
     *
     * @return string
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Set usuario
     *
     * @param \BackendBundle\Entity\Usuario $usuario
     *
     * @return Notificacion
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
}
