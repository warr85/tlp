<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evaluacion
 *
 * @ORM\Table(name="evaluacion_curso")
 * @ORM\Entity
 */
class Evaluacion
{
    

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del Curso"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="curso_modulos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\ClaseCurso
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ClaseCurso")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_clase", referencedColumnName="id", nullable=false)
     * })
     */
    private $idClase;
    
    /**
     * @var \AppBundle\Entity\CursoModuloUnidad
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoModuloUnidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_unidad", referencedColumnName="id", nullable=false)
     * })
     */
    private $idUnidad;
    
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
     * @var decimal
     *
     * @ORM\Column(name="calificacion", type="decimal", nullable=true, options={"comment" = "Código del Curso"})
     */
    private $calificacion;
    
    
    /** @ORM\Column(type="date", nullable=false, options={"comment" = "Fecha de creación de la solicitud"})  
     /**
     * @Assert\Date()
     */      
    private $fecha_evaluacion;
    
     


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
     * Set calificacion
     *
     * @param string $calificacion
     * @return Evaluacion
     */
    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;

        return $this;
    }

    /**
     * Get calificacion
     *
     * @return string 
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Set fecha_evaluacion
     *
     * @param \DateTime $fechaEvaluacion
     * @return Evaluacion
     */
    public function setFechaEvaluacion($fechaEvaluacion)
    {
        $this->fecha_evaluacion = $fechaEvaluacion;

        return $this;
    }

    /**
     * Get fecha_evaluacion
     *
     * @return \DateTime 
     */
    public function getFechaEvaluacion()
    {
        return $this->fecha_evaluacion;
    }

    /**
     * Set idClase
     *
     * @param \AppBundle\Entity\ClaseCurso $idClase
     * @return Evaluacion
     */
    public function setIdClase(\AppBundle\Entity\ClaseCurso $idClase)
    {
        $this->idClase = $idClase;

        return $this;
    }

    /**
     * Get idClase
     *
     * @return \AppBundle\Entity\ClaseCurso 
     */
    public function getIdClase()
    {
        return $this->idClase;
    }

    /**
     * Set idUnidad
     *
     * @param \AppBundle\Entity\CursoModuloUnidad $idUnidad
     * @return Evaluacion
     */
    public function setIdUnidad(\AppBundle\Entity\CursoModuloUnidad $idUnidad)
    {
        $this->idUnidad = $idUnidad;

        return $this;
    }

    /**
     * Get idUnidad
     *
     * @return \AppBundle\Entity\CursoModuloUnidad 
     */
    public function getIdUnidad()
    {
        return $this->idUnidad;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return Evaluacion
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
