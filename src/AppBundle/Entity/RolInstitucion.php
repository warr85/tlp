<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 08:38 AM
 */


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RolInstitucion
 *
 * @ORM\Table(name="rol_institucion", uniqueConstraints={@ORM\UniqueConstraint(name="i_rol_institucion", columns={"id_institucion", "id_rol"})}, indexes={@ORM\Index(name="fki_estatus_rol_institucion", columns={"id_estatus"}), @ORM\Index(name="fki_rol_rol_institucion", columns={"id_rol"}), @ORM\Index(name="IDX_E530B3F2EF433A34", columns={"id_institucion"})})
 * @ORM\Entity
 */
class RolInstitucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "identificador de registro rol institucion"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="rol_institucion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Rol
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Rol")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rol", referencedColumnName="id", nullable=false)
     * })
     */
    private $idRol;

    /**
     * @var \AppBundle\Entity\Institucion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Institucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_institucion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idInstitucion;

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
     * Set idRol
     *
     * @param \AppBundle\Entity\Rol $idRol
     * @return RolInstitucion
     */
    public function setIdRol(\AppBundle\Entity\Rol $idRol = null)
    {
        $this->idRol = $idRol;

        return $this;
    }

    /**
     * Get idRol
     *
     * @return \AppBundle\Entity\Rol
     */
    public function getIdRol()
    {
        return $this->idRol;
    }

    /**
     * Set idInstitucion
     *
     * @param \AppBundle\Entity\Institucion $idInstitucion
     * @return RolInstitucion
     */
    public function setIdInstitucion(\AppBundle\Entity\Institucion $idInstitucion = null)
    {
        $this->idInstitucion = $idInstitucion;

        return $this;
    }

    /**
     * Get idInstitucion
     *
     * @return \AppBundle\Entity\Institucion
     */
    public function getIdInstitucion()
    {
        return $this->idInstitucion;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return RolInstitucion
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


    /**
     * Get __toString
     *
     *
     */
    public function __toString()
    {
        return $this->getIdRol()->getIdPersona()->getCedulaPasaporte();
    }


}