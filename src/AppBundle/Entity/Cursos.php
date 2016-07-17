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
 * Cursos
 *
 * @ORM\Table(name="cursos", uniqueConstraints={@ORM\UniqueConstraint(name="uq_cursos", columns={"codigo"})}, indexes={@ORM\Index(name="fki_categoria_curso_cursos", columns={"id_categoria_curso"})})
 * @ORM\Entity
 */
class Cursos
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false, options={"comment" = "Nombre del Curso"})
     */
    private $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Descripcion del Curso"})
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=100, nullable=false, options={"comment" = "Código del Curso"})
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del Curso"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="cursos_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\CategoriaCursos
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CategoriaCursos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoria_curso", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCategoriaCurso;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Cursos
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
     * @return Cursos
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
     * @return Cursos
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
     * Set idCategoriaCurso
     *
     * @param \AppBundle\Entity\CategoriaCursos $idCategoriaCurso
     * @return Cursos
     */
    public function setIdCategoriaCurso(\AppBundle\Entity\CategoriaCursos $idCategoriaCurso)
    {
        $this->idCategoriaCurso = $idCategoriaCurso;

        return $this;
    }

    /**
     * Get idCategoriaCurso
     *
     * @return \AppBundle\Entity\CategoriaCursos 
     */
    public function getIdCategoriaCurso()
    {
        return $this->idCategoriaCurso;
    }
}
