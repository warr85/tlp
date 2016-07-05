<?php
/**
 * Created by PhpStorm.
 * User: Wilmer Ramones
 * Date: 29/06/16
 * Time: 07:52 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Adscripcion
 *
 * @ORM\Table(name="solicitud_adscripcion", uniqueConstraints={@ORM\UniqueConstraint(name="adscripcion_id_rol_institucion_key", columns={"id_rol_institucion"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Adscripcion
{

	/**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de la Adscripcion"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="adscripcion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    
    
	/**
     * @var \AppBundle\Entity\RolInstitucion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RolInstitucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rol_institucion", referencedColumnName="id", nullable=false)
     * })
     */
    protected $idRolInstitucion;

    
    /**
     * @ORM\Column(type="string", nullable=false, options={"comment" = "ubicacion de la constancia de trabajo"})
     *
     * @Assert\NotBlank(message="Debe cargar su constancia de Trabajo, es obligatoria.")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $trabajo;
    
    
    /**
     * @ORM\Column(type="string", nullable=false, options={"comment" = "ubicacion del titulo de pregrado"})
     *
     * @Assert\NotBlank(message="debe cargar su título de pregrado en digital, es obligatorio.")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $pregrado;
    
    
    /**
     * @ORM\Column(type="string", nullable=true, options={"comment" = "ubicacion del titulo de postgrado en caso de tenerlo"})
     *
     *
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $postgrado;
    
    
    
    /** @ORM\Column(type="datetime", nullable=false, options={"comment" = "Fecha de creación de la solicitud"})
    
    */
    
    private $fecha_creacion;
    
    
    /** @ORM\Column(type="datetime", nullable=false, options={"comment" = "Fecha de actualizacion de la solicitud"})
    
    */
    
    private $fecha_ultima_actualizacion;
    
       
    
    

    public function getTrabajo()
    {
        return $this->trabajo;
    }

    public function setTrabajo($trabajo)
    {
        $this->trabajo = $trabajo;

        return $this;
    }
    
    public function getPregrado()
    {
        return $this->pregrado;
    }

    public function setPregrado($pregrado)
    {
        $this->pregrado = $pregrado;

        return $this;
    }
    
    public function getPostgrado()
    {
        return $this->postgrado;
    }

    public function setPostgrado($postgrado)
    {
        $this->postgrado = $postgrado;

        return $this;
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
     * Get nombre
     *
     * @return string
     */
    public function __toString()
    {
        return $this->trabajo;
    }
    
     /**
     * Set idRolInstitucion
     *
     * @param \AppBundle\Entity\RolInstitucion $idRolInstitucion
     * @return Usuarios
     */
    public function setIdRolInstitucion(\AppBundle\Entity\RolInstitucion $idRolInstitucion = null)
    {
        $this->idRolInstitucion = $idRolInstitucion;

        return $this;
    }

    /**
     * Get idRolInstitucion
     *
     * @return \AppBundle\Entity\RolInstitucion
     */
    public function getIdRolInstitucion()
    {
        return $this->idRolInstitucion;
    }
    
   /**
   * @ORM\PrePersist
   */
    public function setFechaCreacion()
    {
	    $this->fecha_creacion = new \DateTime();
	    $this->fecha_ultima_actualizacion = new \DateTime();
    }

    /**
    * @ORM\PreUpdate
    */
    public function setFechaUltimaActualizacion()
    {
        $this->fecha_utlima_actualizacion = new \DateTime();
    }
    
    
       
    
    
    


}
