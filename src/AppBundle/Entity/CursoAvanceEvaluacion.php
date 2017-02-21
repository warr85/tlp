<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Estatus
 *
 * @ORM\Table(name="curso_avance_evaluacion")
 * @ORM\Entity
 */
class CursoAvanceEvaluacion
{
    
    
    
    /**
     * @var \AppBundle\Entity\CursoAvance
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoAvance", inversedBy="evaluaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_avance", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoAvance;
    
    
    /**
     * @var \AppBundle\Entity\CursoModuloTemaEvaluacion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoModuloTemaEvaluacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_modulo_tema_evaluacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoModuloTemaEvaluacion;
    
    
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
     * @ORM\OneToMany(targetEntity="CursoAvanceEvaluacionResultado", mappedBy="idCursoAvanceEvaluacion", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $resultados;
    
    
    
    
    
    
    
        
    

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
     * Constructor
     */
    public function __construct()
    {
        $this->resultados = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set idCursoAvance
     *
     * @param \AppBundle\Entity\CursoAvance $idCursoAvance
     * @return CursoAvanceEvaluacion
     */
    public function setIdCursoAvance(\AppBundle\Entity\CursoAvance $idCursoAvance)
    {
        $this->idCursoAvance = $idCursoAvance;

        return $this;
    }

    /**
     * Get idCursoAvance
     *
     * @return \AppBundle\Entity\CursoAvance 
     */
    public function getIdCursoAvance()
    {
        return $this->idCursoAvance;
    }

    /**
     * Set idCursoModuloTemaEvaluacion
     *
     * @param \AppBundle\Entity\CursoModuloTemaEvaluacion $idCursoModuloTemaEvaluacion
     * @return CursoAvanceEvaluacion
     */
    public function setIdCursoModuloTemaEvaluacion(\AppBundle\Entity\CursoModuloTemaEvaluacion $idCursoModuloTemaEvaluacion)
    {
        $this->idCursoModuloTemaEvaluacion = $idCursoModuloTemaEvaluacion;

        return $this;
    }

    /**
     * Get idCursoModuloTemaEvaluacion
     *
     * @return \AppBundle\Entity\CursoModuloTemaEvaluacion 
     */
    public function getIdCursoModuloTemaEvaluacion()
    {
        return $this->idCursoModuloTemaEvaluacion;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return CursoAvanceEvaluacion
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
     * Add resultados
     *
     * @param \AppBundle\Entity\CursoAvanceEvaluacionResultado $resultados
     * @return CursoAvanceEvaluacion
     */
    public function addResultado(\AppBundle\Entity\CursoAvanceEvaluacionResultado $resultados)
    {
        $this->resultados[] = $resultados;

        return $this;
    }

    /**
     * Remove resultados
     *
     * @param \AppBundle\Entity\CursoAvanceEvaluacionResultado $resultados
     */
    public function removeResultado(\AppBundle\Entity\CursoAvanceEvaluacionResultado $resultados)
    {
        $this->resultados->removeElement($resultados);
    }

    /**
     * Get resultados
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResultados()
    {
        return $this->resultados;
    }

   
}
