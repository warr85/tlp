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
 * CursoGrupo
 *
 * @ORM\Table(name="curso_grupo", uniqueConstraints={@ORM\UniqueConstraint(name="uq_curso_grupo", columns={"id_curso", "id_estatus"})}, indexes={@ORM\Index(name="fki_curso_grupo", columns={"id_curso"})})
 * @ORM\Entity
 */
class CursoGrupo
{
  

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del curso_grupo"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="curso_grupo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Curso
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Curso", inversedBy="grupos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCurso;
    
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
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del Grupo"})
     */
    private $nombre;
   

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
     * @return CursoGrupo
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
     * @return CursoGrupo
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
     * Set nombre
     *
     * @param string $nombre
     * @return CursoGrupo
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set idCurso
     *
     * @param \AppBundle\Entity\Curso $idCurso
     * @return CursoGrupo
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
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return CursoGrupo
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
     * Get nombre
     *
     * @return string
     */

    public function __toString()
    {
        return $this->getNombre();
    }
}
