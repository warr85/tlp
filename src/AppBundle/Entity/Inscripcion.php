<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



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
     * @ORM\OneToMany(targetEntity="CursoAvance", mappedBy="idInscripcion", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $avances;
    
    
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
        $this->avances = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Add avances
     *
     * @param \AppBundle\Entity\CursoAvance $avances
     * @return Inscripcion
     */
    public function addAvance(\AppBundle\Entity\CursoAvance $avances)
    {
        $this->avances[] = $avances;

        return $this;
    }

    /**
     * Remove avances
     *
     * @param \AppBundle\Entity\CursoAvance $avances
     */
    public function removeAvance(\AppBundle\Entity\CursoAvance $avances)
    {
        $this->avances->removeElement($avances);
    }

    /**
     * Get avances
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAvances()
    {
        return $this->avances;
    }
}
