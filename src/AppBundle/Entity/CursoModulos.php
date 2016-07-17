<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CursoModulos
 *
 * @ORM\Table(name="curso_modulos", uniqueConstraints={@ORM\UniqueConstraint(name="uq_curso_modulos", columns={"codigo"})}, indexes={@ORM\Index(name="fki_curso_modulos_cursos", columns={"id_curso"})})
 * @ORM\Entity
 */
class CursoModulos
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
     * @var \AppBundle\Entity\Cursos
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCurso;
    
     /**
     * @ORM\OneToMany(targetEntity="CursoModuloUnidad", mappedBy="idCursoModulo")
     */
    private $unidad;

    public function __construct()
    {
        $this->unidad = new ArrayCollection();
    }



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CursoModulos
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
     * Set codigo
     *
     * @param string $codigo
     * @return CursoModulos
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

        
    /**
     * 
     * @return string
     */
    public function __toString() {
        return $this->getNombre();
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CursoModulos
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
     * Set secuencia
     *
     * @param integer $secuencia
     * @return CursoModulos
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
     * Set idCurso
     *
     * @param \AppBundle\Entity\Cursos $idCurso
     * @return CursoModulos
     */
    public function setIdCurso(\AppBundle\Entity\Cursos $idCurso)
    {
        $this->idCurso = $idCurso;

        return $this;
    }

    /**
     * Get idCurso
     *
     * @return \AppBundle\Entity\Cursos 
     */
    public function getIdCurso()
    {
        return $this->idCurso;
    }

    /**
     * Add unidad
     *
     * @param \AppBundle\Entity\CusoModuloUnidad $unidad
     * @return CursoModulos
     */
    public function addUnidad(\AppBundle\Entity\CusoModuloUnidad $unidad)
    {
        $this->unidad[] = $unidad;

        return $this;
    }

    /**
     * Remove unidad
     *
     * @param \AppBundle\Entity\CusoModuloUnidad $unidad
     */
    public function removeUnidad(\AppBundle\Entity\CusoModuloUnidad $unidad)
    {
        $this->unidad->removeElement($unidad);
    }

    /**
     * Get unidad
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUnidad()
    {
        return $this->unidad;
    }
}
