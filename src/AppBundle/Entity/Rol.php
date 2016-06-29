<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 08:09 AM
 */



namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="rol", uniqueConstraints={@ORM\UniqueConstraint(name="i_rol", columns={"id_persona", "id_tipo_persona"})}, indexes={@ORM\Index(name="IDX_E553F3750BDD1F3", columns={"id_estatus"}), @ORM\Index(name="IDX_E553F378F781FEB", columns={"id_persona"}), @ORM\Index(name="IDX_E553F3761DDE249", columns={"id_tipo_persona"})})
 * @ORM\Entity
 */
class Rol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "identificador de la persona asociado al rol"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="rol_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\TipoPersona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idTipoPersona;

    /**
     * @var \AppBundle\Entity\Persona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Persona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idPersona;


    /**
     * @var \AppBundle\Entity\AreaPersona
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AreaPersona")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_area_persona", referencedColumnName="id", nullable=false)
     * })
     */
    private $idAreaPersona;





    /**
     * @var \AppBundle\Entity\Estatus
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Estatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     * })
     */
    private $idEstatus;



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
     * Set idTipoPersona
     *
     * @param \AppBundle\Entity\TipoPersona $idTipoPersona
     * @return Rol
     */
    public function setIdTipoPersona(\AppBundle\Entity\TipoPersona $idTipoPersona = null)
    {
        $this->idTipoPersona = $idTipoPersona;

        return $this;
    }

    /**
     * Get idTipoPersona
     *
     * @return \AppBundle\Entity\TipoPersona
     */
    public function getIdTipoPersona()
    {
        return $this->idTipoPersona;
    }

    /**
     * Set idPersona
     *
     * @param \AppBundle\Entity\Persona $idPersona
     * @return Rol
     */
    public function setIdPersona(\AppBundle\Entity\Persona $idPersona = null)
    {
        $this->idPersona = $idPersona;

        return $this;
    }

    /**
     * Get idPersona
     *
     * @return \AppBundle\Entity\Persona
     */
    public function getIdPersona()
    {
        return $this->idPersona;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return Rol
     */
    public function setIdEstatus(\AppBundle\Entity\Estatus $idEstatus = null)
    {
        $this->idEstatus = $idEstatus;

        return $this;
    }

    /**
     * Get idEstatus
     *
     * @return \AppBundle\Entity\Estatus
     */
    public function getIdEstatus()
    {
        return $this->idEstatus;
    }

    public function __toString(){

        return $this->getIdTipoPersona()->getNombre();

    }

    /**
     * @return AreaPersona
     */
    public function getIdAreaPersona()
    {
        return $this->idAreaPersona;
    }

    /**
     * @param AreaPersona $idAreaPersona
     */
    public function setIdAreaPersona($idAreaPersona)
    {
        $this->idAreaPersona = $idAreaPersona;
    }

}