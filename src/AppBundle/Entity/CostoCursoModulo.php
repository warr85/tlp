<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Estatus
 *
 * @ORM\Table(name="costo_curso_modulo")
 * @ORM\Entity
 */
class CostoCursoModulo
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del CostoCursoModulo"})
     */
    private $nombre;
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="costo", type="float", nullable=false, options={"comment" = "valor del cursoso Modulo"})
     */
    private $costo;
        
    

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
     * Set nombre
     *
     * @param string $nombre
     * @return CostoCursoModulo
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
     * Set costo
     *
     * @param float $costo
     * @return CostoCursoModulo
     */
    public function setCosto($costo)
    {
        $this->costo = $costo;

        return $this;
    }

    /**
     * Get costo
     *
     * @return float 
     */
    public function getCosto()
    {
        return $this->costo;
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
     * @return string
     */
    public function __toString() {
        return $this->getNombre();
    }
}
