<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Estatus
 *
 * @ORM\Table(name="curso_avance")
 * @ORM\Entity
 */
class CursoAvance
{
    
    
    
    /**
     * @var \AppBundle\Entity\Inscripcion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Inscripcion", inversedBy="avances", cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_inscripcion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idInscripcion;
    
    
    /**
     * @var \AppBundle\Entity\CursoModuloTema
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoModuloTema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_modulo_tema", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoModuloTema;
    
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
     * @ORM\OneToMany(targetEntity="CursoAvanceEvaluacion", mappedBy="idCursoAvance", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $evaluaciones;
    
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $FechaAvance;
                
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
        $this->evaluaciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set FechaAvance
     *
     * @param \DateTime $fechaAvance
     * @return CursoAvance
     */
    public function setFechaAvance($fechaAvance)
    {
        $this->FechaAvance = $fechaAvance;

        return $this;
    }

    /**
     * Get FechaAvance
     *
     * @return \DateTime 
     */
    public function getFechaAvance()
    {
        return $this->FechaAvance;
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
     * @return CursoAvance
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
     * Set idCursoModuloTema
     *
     * @param \AppBundle\Entity\CursoModuloTema $idCursoModuloTema
     * @return CursoAvance
     */
    public function setIdCursoModuloTema(\AppBundle\Entity\CursoModuloTema $idCursoModuloTema)
    {
        $this->idCursoModuloTema = $idCursoModuloTema;

        return $this;
    }

    /**
     * Get idCursoModuloTema
     *
     * @return \AppBundle\Entity\CursoModuloTema 
     */
    public function getIdCursoModuloTema()
    {
        return $this->idCursoModuloTema;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return CursoAvance
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
     * Add evaluaciones
     *
     * @param \AppBundle\Entity\CursoAvanceEvaluacion $evaluaciones
     * @return CursoAvance
     */
    public function addEvaluacione(\AppBundle\Entity\CursoAvanceEvaluacion $evaluaciones)
    {
        $this->evaluaciones[] = $evaluaciones;

        return $this;
    }

    /**
     * Remove evaluaciones
     *
     * @param \AppBundle\Entity\CursoAvanceEvaluacion $evaluaciones
     */
    public function removeEvaluacione(\AppBundle\Entity\CursoAvanceEvaluacion $evaluaciones)
    {
        $this->evaluaciones->removeElement($evaluaciones);
    }

    /**
     * Get evaluaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluaciones()
    {
        return $this->evaluaciones;
    }
}
