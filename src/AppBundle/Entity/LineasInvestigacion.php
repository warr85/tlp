<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 08:45 AM
 */


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LineasInvestigacion
 *
 * @ORM\Table(name="lineas_investigacion", indexes={@ORM\Index(name="fki_areas_lineas", columns={"id_area_investigacion"})})
 * @ORM\Entity
 */
class LineasInvestigacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del area de investigacion"})
     */
    private $nombre;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del municipio"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="municipio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\AreasInvestigacion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AreasInvestigacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_investigacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idAreaInvestigacion;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return AreasInvestigacion
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
     * Set idAreaInvestigacion
     *
     * @param \AppBundle\Entity\AreasInvestigacion $idAreaInvestigacion
     * @return AreasInvestigacion
     */
    public function setIdAreaInvestigacion(\AppBundle\Entity\AreasInvestigacion $idAreaInvestigacion = null)
    {
        $this->idAreaInvestigacion = $idAreaInvestigacion;

        return $this;
    }

    /**
     * Get idAreaInvestigacion
     *
     * @return \AppBundle\Entity\AreasInvestigacion
     */
    public function getIdAreaInvestigacion()
    {
        return $this->idAreaInvestigacion;
    }
}