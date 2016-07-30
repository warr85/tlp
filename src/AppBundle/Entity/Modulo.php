<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Estatus
 *
 * @ORM\Table(name="modulo")
 * @ORM\Entity
 */
class Modulo
{
    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false, options={"comment" = "Titulo del Modulo"})
     */
    private $titulo;
    
    
    /**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Nombre del Modulo"})
     */
    private $descripcion;
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="precio", type="float", nullable=false, options={"comment" = "Valor del modulo"})
     */
    private $precio;
    
    /**
     * @ORM\OneToMany(targetEntity="ModuloTema", mappedBy="ModuloId", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $temas;

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
        $this->temas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Modulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Modulo
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
     * Set precio
     *
     * @param float $precio
     * @return Modulo
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
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
     * Add temas
     *
     * @param \AppBundle\Entity\ModuloTema $temas
     * @return Modulo
     */
    public function addTema(\AppBundle\Entity\ModuloTema $temas)
    {
        $this->temas[] = $temas;

        return $this;
    }

    /**
     * Remove temas
     *
     * @param \AppBundle\Entity\ModuloTema $temas
     */
    public function removeTema(\AppBundle\Entity\ModuloTema $temas)
    {
        $this->temas->removeElement($temas);
    }

    /**
     * Get temas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTemas()
    {
        return $this->temas;
    }
    
    /**
     * @return string
     */
    public function __toString() {
        return $this->getTitulo();
    }
}
