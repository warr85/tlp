<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 08:45 AM
 */


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursoModulo
 *
 * @ORM\Table(name="curso_modulo", uniqueConstraints={@ORM\UniqueConstraint(name="uq_curso_modulo", columns={"id_curso", "id_modulo"})}, indexes={@ORM\Index(name="fki_curso", columns={"id_curso"})})
 * @ORM\Entity
 */
class CursoModulo
{
  

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del curso_modulo"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="curso_modulo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Curso
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Curso", inversedBy="modulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCurso;
    
    /**
     * @var \AppBundle\Entity\Modulo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Modulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modulo", referencedColumnName="id", nullable=false)
     * })
     */
    private $idModulo;
    
    
    /**
     * @var \AppBundle\Entity\Costo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CostoCursoModulo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_costo_curso_modulo", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCostoCursoModulo;
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $FechaInicio;
    
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $FechaFin;
    
    
    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @var \string
     */
    private $orden;
    
    
    



    

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
     * Set FechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return CursoModulo
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->FechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get FechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->FechaInicio;
    }

    /**
     * Set FechaFin
     *
     * @param \DateTime $fechaFin
     * @return CursoModulo
     */
    public function setFechaFin($fechaFin)
    {
        $this->FechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get FechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->FechaFin;
    }

    /**
     * Set orden
     *
     * @param string $orden
     * @return CursoModulo
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return string 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set idCurso
     *
     * @param \AppBundle\Entity\Curso $idCurso
     * @return CursoModulo
     */
    public function setIdCurso(\AppBundle\Entity\Curso $idCurso)
    {
        $this->idCurso = $idCurso;

        return $this;
    }

    /**
     * Get idCurso
     *
     * @return \AppBundle\Entity\Curso 
     */
    public function getIdCurso()
    {
        return $this->idCurso;
    }

    /**
     * Set idModulo
     *
     * @param \AppBundle\Entity\Modulo $idModulo
     * @return CursoModulo
     */
    public function setIdModulo(\AppBundle\Entity\Modulo $idModulo)
    {
        $this->idModulo = $idModulo;

        return $this;
    }

    /**
     * Get idModulo
     *
     * @return \AppBundle\Entity\Modulo 
     */
    public function getIdModulo()
    {
        return $this->idModulo;
    }

    /**
     * Set idCostoCursoModulo
     *
     * @param \AppBundle\Entity\CostoCursoModulo $idCostoCursoModulo
     * @return CursoModulo
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
    
    public function __toString() {
        return $this->getIdModulo()->getNombre();
    }
}
