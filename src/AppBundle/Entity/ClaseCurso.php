<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ClaseCurso
 *
 * @ORM\Table(name="clase_curso", uniqueConstraints={@ORM\UniqueConstraint(name="uq_curso_id", columns={"id_curso_modulo"})}, indexes={@ORM\Index(name="fki_clase_curso_curso", columns={"id_curso_modulo"})})
 * @ORM\Entity
 */
class ClaseCurso
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
     * @var \AppBundle\Entity\CursoModulos
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoModulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_modulo", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoModulo;
    
    
    /**
     * @var \AppBundle\Entity\Tutor
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tutor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tutor", referencedColumnName="id", nullable=false)
     * })
     */
    private $idTutor;
    
    
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
     * @ORM\OneToMany(targetEntity="Evaluacion", mappedBy="idClase")
     */
    private $evaluacion;
    // ...

    public function __construct() {
        $this->evaluacion = new ArrayCollection();
    }
    
    
    /**
     * @var decimal
     *
     * @ORM\Column(name="promedio", type="decimal", nullable=true, options={"comment" = "Código del Curso"})
     */
    private $promedio;
    
    
    /** @ORM\Column(type="date", nullable=false, options={"comment" = "Fecha de creación de la solicitud"})  
     /**
     * @Assert\Date()
     */      
    private $fecha_creacion;
    
    /** @ORM\Column(type="date", nullable=false, options={"comment" = "Fecha de creación de la solicitud"})  
     /**
     * @Assert\Date()
     */      
    private $fecha_inicio;
    
    /** @ORM\Column(type="date", nullable=false, options={"comment" = "Fecha de actualizada la solicitud"})  
     /**
     * @Assert\Date()
     */      
    private $fecha_fin;



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
     * Set promedio
     *
     * @param string $promedio
     * @return ClaseCurso
     */
    public function setPromedio($promedio)
    {
        $this->promedio = $promedio;

        return $this;
    }

    /**
     * Get promedio
     *
     * @return string 
     */
    public function getPromedio()
    {
        return $this->promedio;
    }

    /**
     * Set fecha_creacion
     *
     * @param \DateTime $fechaCreacion
     * @return ClaseCurso
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fecha_creacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fecha_creacion
     *
     * @return \DateTime 
     */
    public function getFechaCreacion()
    {
        return $this->fecha_creacion;
    }

    /**
     * Set fecha_inicio
     *
     * @param \DateTime $fechaInicio
     * @return ClaseCurso
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fecha_inicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fecha_inicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fecha_inicio;
    }

    /**
     * Set fecha_fin
     *
     * @param \DateTime $fechaFin
     * @return ClaseCurso
     */
    public function setFechaFin($fechaFin)
    {
        $this->fecha_fin = $fechaFin;

        return $this;
    }

    /**
     * Get fecha_fin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fecha_fin;
    }

    /**
     * Set idCursoModulo
     *
     * @param \AppBundle\Entity\CursoModulos $idCursoModulo
     * @return ClaseCurso
     */
    public function setIdCursoModulo(\AppBundle\Entity\CursoModulos $idCursoModulo)
    {
        $this->idCursoModulo = $idCursoModulo;

        return $this;
    }

    /**
     * Get idCursoModulo
     *
     * @return \AppBundle\Entity\CursoModulos 
     */
    public function getIdCursoModulo()
    {
        return $this->idCursoModulo;
    }

    /**
     * Set idTutor
     *
     * @param \AppBundle\Entity\Tutor $idTutor
     * @return ClaseCurso
     */
    public function setIdTutor(\AppBundle\Entity\Tutor $idTutor)
    {
        $this->idTutor = $idTutor;

        return $this;
    }

    /**
     * Get idTutor
     *
     * @return \AppBundle\Entity\Tutor 
     */
    public function getIdTutor()
    {
        return $this->idTutor;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return ClaseCurso
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
     * Add evaluacion
     *
     * @param \AppBundle\Entity\Evaluacion $evaluacion
     * @return ClaseCurso
     */
    public function addEvaluacion(\AppBundle\Entity\Evaluacion $evaluacion)
    {
        $this->evaluacion[] = $evaluacion;

        return $this;
    }

    /**
     * Remove evaluacion
     *
     * @param \AppBundle\Entity\Evaluacion $evaluacion
     */
    public function removeEvaluacion(\AppBundle\Entity\Evaluacion $evaluacion)
    {
        $this->evaluacion->removeElement($evaluacion);
    }

    /**
     * Get evaluacion
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluacion()
    {
        return $this->evaluacion;
    }
}
