<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ClaseCurso
 *
 * @ORM\Table(name="tutor")
 * @ORM\Entity
 */
class Tutor {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del Tutor"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="tutor_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    /**
     * @var \AppBundle\Entity\Usuarios
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id", nullable=false)
     * })
     */
    private $idUsuario;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombres", type="string", length=100, nullable=false, options={"comment" = "Nombre del Modulo"})
     */
    private $nombres;
    
    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="text", nullable=false, options={"comment" = "Descripcion del Modulo"})
     */
    private $apellidos;
 
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Descripcion del Modulo"})
     */
    private $descripcion;

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
     * Set nombres
     *
     * @param string $nombres
     * @return Tutor
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;

        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return Tutor
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tutor
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
     * Set idUsuario
     *
     * @param \AppBundle\Entity\Usuarios $idUsuario
     * @return Tutor
     */
    public function setIdUsuario(\AppBundle\Entity\Usuarios $idUsuario)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \AppBundle\Entity\Usuarios 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
