<?php
/**
 * Created by PhpStorm.
 * User: Wilmer Ramones
 * Date: 23/02/17
 * Time: 02:02 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * Notificacion
 *
 * @ORM\Table(name="notificaciones")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */

class Notificacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de las notificaciones"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="estatus_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\TipoNotificacion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoNotificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_notificacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idTipoNotificacion;


    /**
     * @var \AppBundle\Entity\Estatus
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Estatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     * })
     */
    private $idEstatus;


    /**
     * @ORM\Column(name="fecha_creacion", type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $FechaCreacion;

    /**
     * @ORM\Column(name="leida", type="boolean", nullable=false)
     *
     * @var \Boolean
     */
    private $leida;

    /**
     * @ORM\Column(name="id_notificacion", type="integer", nullable=true)
     *
     * @var \Integer
     */
    private $idNotificacion;



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
     * @ORM\PrePersist()
     */
    public function setFechaCreacion()
    {
        $this->FechaCreacion = new \DateTime();

        return $this;
    }

    /**
     * Get FechaCreacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->FechaCreacion;
    }

    /**
     * Set leida
     *
     * @param boolean $leida
     * @return Notificacion
     */
    public function setLeida($leida)
    {
        $this->leida = $leida;

        return $this;
    }

    /**
     * Get leida
     *
     * @return boolean 
     */
    public function getLeida()
    {
        return $this->leida;
    }

    /**
     * Set idTipoNotificacion
     *
     * @param \AppBundle\Entity\TipoNotificacion $idTipoNotificacion
     * @return Notificacion
     */
    public function setIdTipoNotificacion(\AppBundle\Entity\TipoNotificacion $idTipoNotificacion)
    {
        $this->idTipoNotificacion = $idTipoNotificacion;

        return $this;
    }

    /**
     * Get idTipoNotificacion
     *
     * @return \AppBundle\Entity\TipoNotificacion 
     */
    public function getIdTipoNotificacion()
    {
        return $this->idTipoNotificacion;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return Notificacion
     */
    public function setIdEstatus(\AppBundle\Entity\Estatus $idEstatus)
    {
        $this->idEstatus = $idEstatus;

        return $this;
    }

    /**
     * Get idEstatus
     *
     * @return \AppBundle\Entity\Estatus 
     */
    public function getIdEstatus()
    {
        return $this->idEstatus;
    }



    /**
     * Set idNotificacion
     *
     * @param integer $idNotificacion
     * @return Notificacion
     */
    public function setIdNotificacion($idNotificacion)
    {
        $this->idNotificacion = $idNotificacion;

        return $this;
    }

    /**
     * Get idNotificacion
     *
     * @return integer 
     */
    public function getIdNotificacion()
    {
        return $this->idNotificacion;
    }
}
