<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursoModuloUnidad
 *
 * @ORM\Table(name="curso_modulo_unidad", uniqueConstraints={@ORM\UniqueConstraint(name="uq_curso_modulo_unidad", columns={"codigo"})}, indexes={@ORM\Index(name="fki_curso_modulo_unidad_curso_modulos", columns={"id_curso_modulo"})})
 * @ORM\Entity
 */
class CursoModuloUnidad
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false, options={"comment" = "Nombre del Modulo"})
     */
    private $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Descripcion del Modulo"})
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=100, nullable=false, options={"comment" = "Código del modulo"})
     */
    private $codigo;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="secuencia", type="integer", nullable=false, options={"comment" = "Código del Curso"})
     */
    private $secuencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del Curso"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="curso_modulos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\CursoModulos
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoModulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_modulo", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoModulo;


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CursoModuloUnidad
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
     * @return CursoModuloUnidad
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
     * Set codigo
     *
     * @param string $codigo
     * @return CursoModuloUnidad
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set secuencia
     *
     * @param integer $secuencia
     * @return CursoModuloUnidad
     */
    public function setSecuencia($secuencia)
    {
        $this->secuencia = $secuencia;

        return $this;
    }

    /**
     * Get secuencia
     *
     * @return integer 
     */
    public function getSecuencia()
    {
        return $this->secuencia;
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
     * Set idCursoModulo
     *
     * @param \AppBundle\Entity\CursoModulos $idCursoModulo
     * @return CursoModuloUnidad
     */
    public function setIdCursoModulo(\AppBundle\Entity\CursoModulos $idCursoModulo)
    {
        $this->idCursoModulo = $idCursoModulo;

        return $this;
    }

    /**
     * Get idCursoModulo
     *
     * @return \AppBundle\Entity\CursoModulos 
     */
    public function getIdCursoModulo()
    {
        return $this->idCursoModulo;
    }
}
