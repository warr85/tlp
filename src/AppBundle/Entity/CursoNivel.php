<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursoNivel
 *
 * @ORM\Table(name="curso_nivel", uniqueConstraints={@ORM\UniqueConstraint(name="uq_curso_nivel", columns={"id_curso"})}, indexes={@ORM\Index(name="fki_curso_nivel", columns={"id_curso"})})
 * @ORM\Entity
 */
class CursoNivel
{
  

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del curso_nivel"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="curso_grupo_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Curso
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Curso", inversedBy="niveles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCurso;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="experiencia_necesaria", type="integer", nullable=false, options={"comment" = "Cantidad de experiencia necesaria para alcanzar el nivel"})
     */
    protected $experienciaNecesaria;
            
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del Grupo"})
     */
    private $nombre;
   

    
    
    public function __toString() {
        return $this->getNombre();
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
     * Set experienciaNecesaria
     *
     * @param integer $experienciaNecesaria
     * @return CursoNivel
     */
    public function setExperienciaNecesaria($experienciaNecesaria)
    {
        $this->experienciaNecesaria = $experienciaNecesaria;

        return $this;
    }

    /**
     * Get experienciaNecesaria
     *
     * @return integer 
     */
    public function getExperienciaNecesaria()
    {
        return $this->experienciaNecesaria;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CursoNivel
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
     * Set idCurso
     *
     * @param \AppBundle\Entity\Curso $idCurso
     * @return CursoNivel
     */
    public function setIdCurso(\AppBundle\Entity\Curso $idCurso)
    {
        $this->idCurso = $idCurso;

        return $this;
    }

    /**
     * Get idCurso
     *
     * @return \AppBundle\Entity\Curso 
     */
    public function getIdCurso()
    {
        return $this->idCurso;
    }
    
    
    
}
