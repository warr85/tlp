<?php
/**
 * Created by PhpStorm.
 * User: Wilmer Ramones
 * Date: 29/06/16
 * Time: 07:52 AM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * CategoriaCursos
 *
 * @ORM\Table(name="cursos_categoria", uniqueConstraints={@ORM\UniqueConstraint(name="uq_nombre_categoria", columns={"nombre"})})
 * @ORM\Entity
 */
class CategoriaCursos
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre de la categoria"})
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del genero"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="curso_categoria_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Cursos", mappedBy="idCategoriaCurso")
     */
    private $cursos;


    public function __construct()
    {
        $this->cursos = new ArrayCollection();
    }
    
    
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



    /**
     * Add cursos
     *
     * @param \AppBundle\Entity\Cursos $cursos
     * @return CategoriaCursos
     */
    public function addCurso(\AppBundle\Entity\Cursos $cursos)
    {
        $this->cursos[] = $cursos;

        return $this;
    }

    /**
     * Remove cursos
     *
     * @param \AppBundle\Entity\Cursos $cursos
     */
    public function removeCurso(\AppBundle\Entity\Cursos $cursos)
    {
        $this->cursos->removeElement($cursos);
    }

    /**
     * Get cursos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCursos()
    {
        return $this->cursos;
    }
}
