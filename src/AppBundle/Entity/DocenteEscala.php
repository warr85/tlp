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

/**
 * Escalafones
 *
 * @ORM\Table(name="docente_escala")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks() 
 */
class DocenteEscala
{


	 /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del docente_escala"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="docente_escala_id_seq", allocationSize=1, initialValue=1)
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
     * @var \AppBundle\Entity\Escalafones
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Escalafones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_escala", referencedColumnName="id", nullable=false)
     * })
     */
    protected $idEscala;
    
        
    
     /** @ORM\Column(type="datetime", nullable=false, options={"comment" = "Fecha de obtencion de la escala"})  
     /**
     * @Assert\Date()
     */      
    private $fecha_escala;
    
    
    /** @ORM\Column(type="datetime", nullable=false, options={"comment" = "Fecha de registro de la escala"})    
    */    
    private $fecha_creacion;
                
    
     /**
     * Set idEscala
     *
     * @param \AppBundle\Entity\Escalafones $idEscala
     * @return Usuarios
     */
    public function setidEscala(\AppBundle\Entity\Escalafones $idEscala = null)
    {
        $this->idEscala = $idEscala;

        return $this;
    }

    /**
     * Get idEscala
     *
     * @return \AppBundle\Entity\Escalafones
     */
    public function getidEscala()
    {
        return $this->idEscala;
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
   * @ORM\PrePersist
   */
    public function setFechaCreacion()
    {
	    $this->fecha_creacion = new \DateTime();	    
    }
    
    /**
 * Set fecha_escala
 *
 * @param \DateTime $fecha_escala
 * @return Comment
 */
public function setFechaEscala($fecha_escala)
{
    $this->fecha_escala = $fecha_escala;

    return $this;
}

/**
 * Get fecha_escala
 *
 * @return \DateTime
 */
public function getFechaEscala()
{
    return $this->postedon;
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
    
    
    
  



}
