<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Estatus
 *
 * @ORM\Table(name="curso")
 * @ORM\Entity
 */
class Curso
{
    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false, options={"comment" = "Titulo del Curso"})
     */
    private $titulo;
    
    
    /**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Nombre del Curso"})
     */
    private $descripcion;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="cupo", type="integer", nullable=false, options={"comment" = "cupo del curso"})
     */
    private $cupo;
    
    /**
     * @ORM\OneToMany(targetEntity="Modulo", mappedBy="CursoId", cascade={"all"})
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
     * Set titulo
     *
     * @param string $titulo
     * @return Curso
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
     * @return Curso
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
     * Set cupo
     *
     * @param integer $cupo
     * @return Curso
     */
    public function setCupo($cupo)
    {
        $this->cupo = $cupo;

        return $this;
    }

    /**
     * Get cupo
     *
     * @return integer 
     */
    public function getCupo()
    {
        return $this->cupo;
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
     * @return Curso
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
    
    
    /**
     * @return string
     */
    public function __toString() {
        return $this->getTitulo();
    }
}
