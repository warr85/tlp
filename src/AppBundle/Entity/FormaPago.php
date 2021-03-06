<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Estatus
 *
 * @ORM\Table(name="forma_pago")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class FormaPago
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del FormaPago"})
     */
    private $nombre;
    
    
    /**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Nombre del FormaPago"})
     */
    private $descripcion;
                 

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
     * @return FormaPago
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
     * @return FormaPago
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
}
