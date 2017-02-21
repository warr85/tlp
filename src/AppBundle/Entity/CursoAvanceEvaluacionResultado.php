<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Estatus
 *
 * @ORM\Table(name="curso_avance_evaluacion_resultado")
 * @ORM\Entity
 */
class CursoAvanceEvaluacionResultado
{
    
    
    
    /**
     * @var \AppBundle\Entity\CursoAvanceEvaluacion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoAvanceEvaluacion", inversedBy="resultados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_avance_evaluacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoAvanceEvaluacion;
    
    
   
    
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
     * @var string
     *
     * @ORM\Column(name="resultado", type="string", length=50, nullable=false, options={"comment" = "Resultado Evaluacion"})
     */
    private $resultado;
    
                
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $FechaResultado;
    
    
      
    
    

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
     * Set resultado
     *
     * @param string $resultado
     * @return CursoAvanceEvaluacionResultado
     */
    public function setResultado($resultado)
    {
        $this->resultado = $resultado;

        return $this;
    }

    /**
     * Get resultado
     *
     * @return string 
     */
    public function getResultado()
    {
        return $this->resultado;
    }

    /**
     * Set FechaResultado
     *
     * @param \DateTime $fechaResultado
     * @return CursoAvanceEvaluacionResultado
     */
    public function setFechaResultado($fechaResultado)
    {
        $this->FechaResultado = $fechaResultado;

        return $this;
    }

    /**
     * Get FechaResultado
     *
     * @return \DateTime 
     */
    public function getFechaResultado()
    {
        return $this->FechaResultado;
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
     * Set idCursoAvanceEvaluacion
     *
     * @param \AppBundle\Entity\CursoAvanceEvaluacion $idCursoAvanceEvaluacion
     * @return CursoAvanceEvaluacionResultado
     */
    public function setIdCursoAvanceEvaluacion(\AppBundle\Entity\CursoAvanceEvaluacion $idCursoAvanceEvaluacion)
    {
        $this->idCursoAvanceEvaluacion = $idCursoAvanceEvaluacion;

        return $this;
    }

    /**
     * Get idCursoAvanceEvaluacion
     *
     * @return \AppBundle\Entity\CursoAvanceEvaluacion 
     */
    public function getIdCursoAvanceEvaluacion()
    {
        return $this->idCursoAvanceEvaluacion;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return CursoAvanceEvaluacionResultado
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
}
