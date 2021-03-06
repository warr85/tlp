<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * TipoEvaluacion
 *
 * @ORM\Table(name="tipo_evaluacion")
 * @ORM\Entity
 */
class TipoEvaluacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del Evaluacion"})
     */
    private $nombre;
    
    
    /**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Nombre del Evaluacion"})
     */
    private $descripcion;
    
    /**
     * @var \AppBundle\Entity\EvaluacionModo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EvaluacionModo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_modo_evaluacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idEvaluacionModo;
                             

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
     * @return string
     */
    public function __toString() {
        return $this->getNombre();
    }

    

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return TipoEvaluacion
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return TipoEvaluacion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
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
     * Set idEvaluacionModo
     *
     * @param \AppBundle\Entity\EvaluacionModo $idEvaluacionModo
     * @return TipoEvaluacion
     */
    public function setIdEvaluacionModo(\AppBundle\Entity\EvaluacionModo $idEvaluacionModo)
    {
        $this->idEvaluacionModo = $idEvaluacionModo;

        return $this;
    }

    /**
     * Get idEvaluacionModo
     *
     * @return \AppBundle\Entity\EvaluacionModo 
     */
    public function getIdEvaluacionModo()
    {
        return $this->idEvaluacionModo;
    }
}
