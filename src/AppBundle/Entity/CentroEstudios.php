<?php
/**
 * Created by PhpStorm.
 * User: Wilmer Ramones
 * Date: 29/06/16
 * Time: 07:52 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CentroEstudios
 *
 * @ORM\Table(name="centro_estudios", uniqueConstraints={@ORM\UniqueConstraint(name="uq_nombre_ce", columns={"nombre"})})
 * @ORM\Entity
 */
class CentroEstudios
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del centro"})
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviacion", type="string", length=255, nullable=false, options={"comment" = "Abreviación del centro"})
     */
    private $abreviacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del Centro de Estudios"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="genero_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Genero
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
     * Set abreviacion
     *
     * @param string $abreviacion
     * @return CentroEstudios
     */
    public function setAbreviacion($abreviacion)
    {
        $this->nombre = $abreviacion;

        return $this;
    }

    /**
     * Get abreviacion
     *
     * @return string
     */
    public function getAbreviacion()
    {
        return $this->abreviacion;
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


}
