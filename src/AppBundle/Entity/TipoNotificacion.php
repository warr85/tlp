<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 23/02/17
 * Time: 02:11 PM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


/**
 * TipoNotificacion
 *
 * @ORM\Table(name="notificaciones_tipo")
 * @ORM\Entity
 */


class TipoNotificacion
{

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre de la notificacion"})
     */
    private $nombre;



    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del tipo de notificacion"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="estatus_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return TipoNotificacion
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
}
