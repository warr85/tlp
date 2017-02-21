<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Estatus
 *
 * @ORM\Table(name="inscripcion_logro")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class InscripcionLogro
{
        

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
     * @ORM\Column(name="fecha_logro", type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $fechaLogro;
    
    
    /**
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $fechaActualizacion;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="contador", type="integer", nullable=false, options={"comment" = "Contador de cuantas veces ha repasado el logro"})
     */
    private $contador;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="ultima_vez", type="integer", nullable=false, options={"comment" = "saber cuando fue la ultima vez que ejecuto la acción"})
     */
    private $ultimaVez;
    
    
    /**
     * @var \AppBundle\Entity\CursoModuloTemaLogro
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoModuloTemaLogro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_modulo_tema_logro", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoModuloTemaLogro;
    
    
    /**
     * @var \AppBundle\Entity\Inscripcion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Inscripcion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_inscripcion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idInscripcion;
    
    
    
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
   * @ORM\PrePersist
   */
    public function setFechaLogro()
    {
	    $this->fechaLogro = new \DateTime();
	    $this->fechaActualizacion = new \DateTime();
    }

    /**
     * Get fechaLogro
     *
     * @return \DateTime 
     */
    public function getFechaLogro()
    {
        return $this->fechaLogro;
    }

    /**
    * @ORM\PreUpdate
    */
    public function setFechaActualizacion()
    {
        $this->fechaActualizacion = new \DateTime();

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime 
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    /**
     * Set contador
     *
     * @param integer $contador
     * @return InscripcionLogro
     */
    public function setContador($contador)
    {
        $this->contador = $contador;

        return $this;
    }

    /**
     * Get contador
     *
     * @return integer 
     */
    public function getContador()
    {
        return $this->contador;
    }

    /**
     * Set idCursoModuloTemaLogro
     *
     * @param \AppBundle\Entity\CursoModuloTemaLogro $idCursoModuloTemaLogro
     * @return InscripcionLogro
     */
    public function setIdCursoModuloTemaLogro(\AppBundle\Entity\CursoModuloTemaLogro $idCursoModuloTemaLogro)
    {
        $this->idCursoModuloTemaLogro = $idCursoModuloTemaLogro;

        return $this;
    }

    /**
     * Get idCursoModuloTemaLogro
     *
     * @return \AppBundle\Entity\CursoModuloTemaLogro 
     */
    public function getIdCursoModuloTemaLogro()
    {
        return $this->idCursoModuloTemaLogro;
    }

    /**
     * Set idInscripcion
     *
     * @param \AppBundle\Entity\Inscripcion $idInscripcion
     * @return InscripcionLogro
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
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return InscripcionLogro
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
     * Set ultimaVez
     *
     * @param integer $ultimaVez
     * @return InscripcionLogro
     */
    public function setUltimaVez($ultimaVez)
    {
        $this->ultimaVez = $ultimaVez;

        return $this;
    }

    /**
     * Get ultimaVez
     *
     * @return integer 
     */
    public function getUltimaVez()
    {
        return $this->ultimaVez;
    }
}
