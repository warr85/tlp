<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Estatus
 *
 * @ORM\Table(name="modulo_tema")
 * @ORM\Entity
 */
class ModuloTema
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del Tema"})
     */
    private $nombre;
    
    
    /**
     * @var integer 
     *
     * @ORM\Column(name="orden", type="integer", nullable=false, options={"comment" = "Nombre del Tema"})
     */
    private $orden;
    
    
    /**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Descripcion del tema"})
     */
    private $descripcion;
    
        
    
    /**
     * @ORM\ManyToOne(targetEntity="Modulo", inversedBy="temas")
     * @ORM\JoinColumn(name="modulo_id", referencedColumnName="id", nullable=false)
     */
    protected $ModuloId;

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
     * @return ModuloTema
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
     * @return ModuloTema
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
     * Set ModuloId
     *
     * @param \AppBundle\Entity\Modulo $moduloId
     * @return ModuloTema
     */
    public function setModuloId(\AppBundle\Entity\Modulo $moduloId)
    {
        $this->ModuloId = $moduloId;

        return $this;
    }

    /**
     * Get ModuloId
     *
     * @return \AppBundle\Entity\Modulo 
     */
    public function getModuloId()
    {
        return $this->ModuloId;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     * @return ModuloTema
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
    }
    
    /**
     * @return string
     */
    public function __toString() {
        return $this->getNombre();
    }
}
