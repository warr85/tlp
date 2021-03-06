<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Estatus
 *
 * @ORM\Table(name="suscripcion")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Suscripcion
{
    
    
    
    /**
     * @var \AppBundle\Entity\Inscripcion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Inscripcion", inversedBy="suscripciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_inscripcion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idInscripcion;
    
    
    /**
     * @var \AppBundle\Entity\CostoCursoModulo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CostoCursoModulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_costo_curso_modulo", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCostoCursoModulo;
    
    
    
    /**
     * @ORM\Column(name="fecha_suscripcion", type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $FechaSuscripcion;


    /**
     * @ORM\Column(name="fecha_pago", type="datetime", nullable=true)
     *
     * @var \DateTime
     */
    private $FechaPago;


    /**
     * @var string
     *
     * @ORM\Column(name="referencia", type="string", length=255, nullable=true, options={"comment" = "codigo del voucher del deposito, transferencia o mercado pago"})
     */
    private $referencia;
    
    
      
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
     * @var \AppBundle\Entity\FormaPago
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\FormaPago")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_forma_pago", referencedColumnName="id", nullable=false)
     * })
     */
    private $idFormaPago;


    /**
     * @var \AppBundle\Entity\Banco
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Banco")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_banco", referencedColumnName="id", nullable=true)
     * })
     */
    private $idBanco;
        
    

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del estatus"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="estatus_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * @ORM\PrePersist
     */
    public function setFechaSuscripcion($fechaSuscripcion)
    {
        $this->FechaSuscripcion = new \DateTime();;

        return $this;
    }

    /**
     * Get FechaPago
     *
     * @return \DateTime 
     */
    public function getFechaSuscripcion()
    {
        return $this->FechaSuscripcion;
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
     * Set idInscripcion
     *
     * @param \AppBundle\Entity\Inscripcion $idInscripcion
     * @return Suscripcion
     */
    public function setIdInscripcion(\AppBundle\Entity\Inscripcion $idInscripcion)
    {
        $this->idInscripcion = $idInscripcion;

        return $this;
    }

    /**
     * Get idInscripcion
     *
     * @return \AppBundle\Entity\Inscripcion 
     */
    public function getIdInscripcion()
    {
        return $this->idInscripcion;
    }

    /**
     * Set idCostoCursoModulo
     *
     * @param \AppBundle\Entity\CostoCursoModulo $idCostoCursoModulo
     * @return Suscripcion
     */
    public function setIdCostoCursoModulo(\AppBundle\Entity\CostoCursoModulo $idCostoCursoModulo)
    {
        $this->idCostoCursoModulo = $idCostoCursoModulo;

        return $this;
    }

    /**
     * Get idCostoCursoModulo
     *
     * @return \AppBundle\Entity\CostoCursoModulo 
     */
    public function getIdCostoCursoModulo()
    {
        return $this->idCostoCursoModulo;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return Suscripcion
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
     * Set idFormaPago
     *
     * @param \AppBundle\Entity\FormaPago $idFormaPago
     * @return Suscripcion
     */
    public function setIdFormaPago(\AppBundle\Entity\FormaPago $idFormaPago)
    {
        $this->idFormaPago = $idFormaPago;

        return $this;
    }

    /**
     * Get idFormaPago
     *
     * @return \AppBundle\Entity\FormaPago 
     */
    public function getIdFormaPago()
    {
        return $this->idFormaPago;
    }

    /**
     * Set referencia
     *
     * @param string $referencia
     * @return Suscripcion
     */
    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;

        return $this;
    }

    /**
     * Get referencia
     *
     * @return string 
     */
    public function getReferencia()
    {
        return $this->referencia;
    }

    /**
     * Set idBanco
     *
     * @param \AppBundle\Entity\Banco $idBanco
     * @return Suscripcion
     */
    public function setIdBanco(\AppBundle\Entity\Banco $idBanco = null)
    {
        $this->idBanco = $idBanco;

        return $this;
    }

    /**
     * Get idBanco
     *
     * @return \AppBundle\Entity\Banco 
     */
    public function getIdBanco()
    {
        return $this->idBanco;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setFechaPago()
    {
        $this->FechaPago = new \DateTime();

        return $this;
    }

    /**
     * Get FechaPago
     *
     * @return \DateTime 
     */
    public function getFechaPago()
    {
        return $this->FechaPago;
    }
}
