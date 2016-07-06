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
 * AreasInvestigacion
 *
 * @ORM\Table(name="areas_investigacion", indexes={@ORM\Index(name="fki_centroestudios_areasinvestigacion", columns={"id_centro_estudios"})})
 * @ORM\Entity
 */
class AreasInvestigacion
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false, options={"comment" = "Nombre del area de investigacion"})
     */
    private $nombre;


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del area de investigacion"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="area_investigacion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\CentroEstudios
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CentroEstudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_estudios", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCentroEstudios;



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
     * Set idCentroEstudios
     *
     * @param \AppBundle\Entity\CentroEstudios $idCentroEstudios
     * @return AreasInvestigacion
     */
    public function setIdEstado(\AppBundle\Entity\CentroEstudios $idCentroEstudios = null)
    {
        $this->idCentroEstudios = $idCentroEstudios;

        return $this;
    }

    /**
     * Get idCentroEstudios
     *
     * @return \AppBundle\Entity\CentroEstudios
     */
    public function getIdEstado()
    {
        return $this->idCentroEstudios;
    }

    public function __toString()
    {
        return $this->nombre;
    }
}