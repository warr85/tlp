<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Estatus
 *
 * @ORM\Table(name="inscripcion_logro")
 * @ORM\Entity
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fechaLogro
     *
     * @param \DateTime $fechaLogro
     * @return InscripcionLogro
     */
    public function setFechaLogro($fechaLogro)
    {
        $this->fechaLogro = $fechaLogro;

        return $this;
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
     * Set fechaActualizacion
     *
     * @param \DateTime $fechaActualizacion
     * @return InscripcionLogro
     */
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;

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
}
