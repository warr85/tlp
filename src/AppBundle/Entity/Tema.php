<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Estatus
 *
 * @ORM\Table(name="tema")
 * @ORM\Entity
 */
class Tema
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del Tema"})
     */
    private $nombre;
    
    
    /**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Nombre del Tema"})
     */
    private $descripcion;
        
    
    /**
     * @ORM\OneToMany(targetEntity="Modulo", mappedBy="ModuloId", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $modulos;

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
        $this->modulos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Tema
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
     * @return Tema
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
     * Add modulos
     *
     * @param \AppBundle\Entity\Modulo $modulos
     * @return Tema
     */
    public function addModulo(\AppBundle\Entity\Modulo $modulos)
    {
        $this->modulos[] = $modulos;

        return $this;
    }

    /**
     * Remove modulos
     *
     * @param \AppBundle\Entity\Modulo $modulos
     */
    public function removeModulo(\AppBundle\Entity\Modulo $modulos)
    {
        $this->modulos->removeElement($modulos);
    }

    /**
     * Get modulos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModulos()
    {
        return $this->modulos;
    }
}
