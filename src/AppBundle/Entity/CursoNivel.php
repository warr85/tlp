<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursoNivel
 *
 * @ORM\Table(name="curso_nivel")
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


    /**
     * @var string
     *
     * @ORM\Column(name="sobre_nombre", type="string", length=255, nullable=false, options={"comment" = "Sobre nombre del Nivel"})
     */
    private $sobreNombre;
   

    
    
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
     * Set sobreNombre
     *
     * @param string $sobreNombre
     * @return CursoNivel
     */
    public function setSobreNombre($sobreNombre)
    {
        $this->sobreNombre = $sobreNombre;

        return $this;
    }

    /**
     * Get sobreNombre
     *
     * @return string 
     */
    public function getSobreNombre()
    {
        return $this->sobreNombre;
    }
}
