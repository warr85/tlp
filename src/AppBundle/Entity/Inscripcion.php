<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Estatus
 *
 * @ORM\Table(name="inscripcion")
 * @ORM\Entity
 */
class Inscripcion
{
    
    
    
    /**
     * @var \AppBundle\Entity\CursoGrupo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoGrupo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_grupo", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoGrupo;
    
    
    /**
     * @var \AppBundle\Entity\CursoAvance
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoAvance")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_avance", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoAvance;
    
    
    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $FechaInscripcion;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Suscripcion", mappedBy="idInscripcion", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $suscripciones;
    

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
        $this->suscripciones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set FechaInscripcion
     *
     * @param \DateTime $fechaInscripcion
     * @return Inscripcion
     */
    public function setFechaInscripcion($fechaInscripcion)
    {
        $this->FechaInscripcion = $fechaInscripcion;

        return $this;
    }

    /**
     * Get FechaInscripcion
     *
     * @return \DateTime 
     */
    public function getFechaInscripcion()
    {
        return $this->FechaInscripcion;
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
     * Set idCursoGrupo
     *
     * @param \AppBundle\Entity\CursoGrupo $idCursoGrupo
     * @return Inscripcion
     */
    public function setIdCursoGrupo(\AppBundle\Entity\CursoGrupo $idCursoGrupo)
    {
        $this->idCursoGrupo = $idCursoGrupo;

        return $this;
    }

    /**
     * Get idCursoGrupo
     *
     * @return \AppBundle\Entity\CursoGrupo 
     */
    public function getIdCursoGrupo()
    {
        return $this->idCursoGrupo;
    }

    /**
     * Set idCursoAvance
     *
     * @param \AppBundle\Entity\CursoAvance $idCursoAvance
     * @return Inscripcion
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
     * Add suscripciones
     *
     * @param \AppBundle\Entity\Suscripcion $suscripciones
     * @return Inscripcion
     */
    public function addSuscripcione(\AppBundle\Entity\Suscripcion $suscripciones)
    {
        $this->suscripciones[] = $suscripciones;

        return $this;
    }

    /**
     * Remove suscripciones
     *
     * @param \AppBundle\Entity\Suscripcion $suscripciones
     */
    public function removeSuscripcione(\AppBundle\Entity\Suscripcion $suscripciones)
    {
        $this->suscripciones->removeElement($suscripciones);
    }

    /**
     * Get suscripciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSuscripciones()
    {
        return $this->suscripciones;
    }
}