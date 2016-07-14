<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 08:07 AM
 */



namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AreaInstitucion
 *
 * @ORM\Table(name="area_institucion", uniqueConstraints={@ORM\UniqueConstraint(name="area_institucion_nombre_key", columns={"nombre"})})
 * @ORM\Entity
 */
class AreaInstitucion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=80, nullable=false, options={"comment" = "identificador del area de desenvolvimiento de persona"})
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer",nullable=false, options={"comment" = "nombre del area donde hace vida la persona"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="area_persona_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
     /**
     * @var \AppBundle\Entity\TipoArea
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoArea")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_area", referencedColumnName="id", nullable=false)
     * })
     */
    private $idTipoArea;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return AreaInstitucion
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Get nombre
     *
     * @return string
     */
    public function __toString()
    {
        return $this->nombre;
    }
    
    
    /**
     * Set idTipoArea
     *
     * @param \AppBundle\Entity\Estado $idTipoArea
     * @return TipoArea
     */
    public function setIdTipoArea(\AppBundle\Entity\TipoArea $idTipoArea = null)
    {
        $this->idEstado = $idTipoArea;

        return $this;
    }

    /**
     * Get idTipoArea
     *
     * @return \AppBundle\Entity\TipoArea
     */
    public function getIdTipoArea()
    {
        return $this->idTipoArea;
    }


}