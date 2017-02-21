<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * UsuariosLogros
 *
 * @ORM\Table(name="usuario_logro")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class UsuariosLogros
{


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
     * @ORM\Column(name="fecha_logro", type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $fechaLogro;


    /**
     * @ORM\Column(name="fecha_actualizacion", type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $fechaActualizacion;


    /**
     * @var integer
     *
     * @ORM\Column(name="contador", type="integer", nullable=false, options={"comment" = "Contador de cuantas veces ha repasado el logro"})
     */
    private $contador;


    /**
     * @var integer
     *
     * @ORM\Column(name="ultima_vez", type="integer", nullable=false, options={"comment" = "saber cuando fue la ultima vez que ejecuto la acción"})
     */
    private $ultimaVez;


    /**
     * @var \AppBundle\Entity\CursoModuloTemaLogro
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoModuloTemaLogro")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_modulo_tema_logro", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoModuloTemaLogro;


    /**
     * @var \AppBundle\Entity\Usuarios
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_inscripcion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idUsuario;



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
     * @ORM\PrePersist
     */
    public function setFechaLogro()
    {
        $this->fechaLogro = new \DateTime();
        $this->fechaActualizacion = new \DateTime();
    }

    /**
     * Get fechaLogro
     *
     * @return \DateTime
     */
    public function getFechaLogro()
    {
        return $this->fechaLogro;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setFechaActualizacion()
    {
        $this->fechaActualizacion = new \DateTime();

        return $this;
    }

    /**
     * Get fechaActualizacion
     *
     * @return \DateTime
     */
    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }



    /**
     * Set contador
     *
     * @param integer $contador
     * @return UsuariosLogros
     */
    public function setContador($contador)
    {
        $this->contador = $contador;

        return $this;
    }

    /**
     * Get contador
     *
     * @return integer 
     */
    public function getContador()
    {
        return $this->contador;
    }

    /**
     * Set ultimaVez
     *
     * @param integer $ultimaVez
     * @return UsuariosLogros
     */
    public function setUltimaVez($ultimaVez)
    {
        $this->ultimaVez = $ultimaVez;

        return $this;
    }

    /**
     * Get ultimaVez
     *
     * @return integer 
     */
    public function getUltimaVez()
    {
        return $this->ultimaVez;
    }

    /**
     * Set idCursoModuloTemaLogro
     *
     * @param \AppBundle\Entity\CursoModuloTemaLogro $idCursoModuloTemaLogro
     * @return UsuariosLogros
     */
    public function setIdCursoModuloTemaLogro(\AppBundle\Entity\CursoModuloTemaLogro $idCursoModuloTemaLogro)
    {
        $this->idCursoModuloTemaLogro = $idCursoModuloTemaLogro;

        return $this;
    }

    /**
     * Get idCursoModuloTemaLogro
     *
     * @return \AppBundle\Entity\CursoModuloTemaLogro 
     */
    public function getIdCursoModuloTemaLogro()
    {
        return $this->idCursoModuloTemaLogro;
    }

    /**
     * Set idUsuario
     *
     * @param \AppBundle\Entity\Usuarios $idUsuario
     * @return UsuariosLogros
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

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return UsuariosLogros
     */
    public function setIdEstatus(\AppBundle\Entity\Estatus $idEstatus)
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
}
