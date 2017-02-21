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
 * CursoModuloTema
 *
 * @ORM\Table(name="curso_modulo_tema", uniqueConstraints={@ORM\UniqueConstraint(name="uq_curso_modulo_tema", columns={"id_curso_modulo", "id_tema"})}, indexes={@ORM\Index(name="fki_curso_modulo", columns={"id_curso_modulo"})})
 * @ORM\Entity
 */
class CursoModuloTema
{
  

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del curso_modulo_tema"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="curso_modulo_tema_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\CursoModulo
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoModulo", inversedBy="temas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_modulo", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoModulo;
    
    /**
     * @var \AppBundle\Entity\Tema
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Tema")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tema", referencedColumnName="id", nullable=false)
     * })
     */
    private $idTema;
       
    
    /**
     * @ORM\Column(type="string", nullable=false)
     *
     * @var \string
     */
    private $orden;
    
    
    /**
     * @ORM\OneToMany(targetEntity="CursoModuloTemaEvaluacion", mappedBy="idCursoModuloTema", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $evaluaciones;
    
    
    /**
     * @ORM\OneToMany(targetEntity="CursoModuloTemaLogro", mappedBy="idCursoModuloTema", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $logros;
    
    
    
    
   

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
     * Set orden
     *
     * @param string $orden
     * @return CursoModuloTema
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return string 
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set idCursoModulo
     *
     * @param \AppBundle\Entity\CursoModulo $idCursoModulo
     * @return CursoModuloTema
     */
    public function setIdCursoModulo(\AppBundle\Entity\CursoModulo $idCursoModulo)
    {
        $this->idCursoModulo = $idCursoModulo;

        return $this;
    }

    /**
     * Get idCursoModulo
     *
     * @return \AppBundle\Entity\CursoModulo 
     */
    public function getIdCursoModulo()
    {
        return $this->idCursoModulo;
    }

    /**
     * Set idTema
     *
     * @param \AppBundle\Entity\Tema $idTema
     * @return CursoModuloTema
     */
    public function setIdTema(\AppBundle\Entity\Tema $idTema)
    {
        $this->idTema = $idTema;

        return $this;
    }

    /**
     * Get idTema
     *
     * @return \AppBundle\Entity\Tema 
     */
    public function getIdTema()
    {
        return $this->idTema;
    }
    
    public function __toString() {
        return $this->getIdTema()->getNombre();
    }
    

    /**
     * Add evaluaciones
     *
     * @param \AppBundle\Entity\CursoModuloTemaEvaluacion $evaluaciones
     * @return CursoModuloTema
     */
    public function addEvaluacione(\AppBundle\Entity\CursoModuloTemaEvaluacion $evaluaciones)
    {
        $this->evaluaciones[] = $evaluaciones;

        return $this;
    }

    /**
     * Remove evaluaciones
     *
     * @param \AppBundle\Entity\CursoModuloTemaEvaluacion $evaluaciones
     */
    public function removeEvaluacione(\AppBundle\Entity\CursoModuloTemaEvaluacion $evaluaciones)
    {
        $this->evaluaciones->removeElement($evaluaciones);
    }

    /**
     * Get evaluaciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvaluaciones()
    {
        return $this->evaluaciones;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->evaluaciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->logros = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add logros
     *
     * @param \AppBundle\Entity\CursoModuloTemaLogro $logros
     * @return CursoModuloTema
     */
    public function addLogro(\AppBundle\Entity\CursoModuloTemaLogro $logros)
    {
        $this->logros[] = $logros;

        return $this;
    }

    /**
     * Remove logros
     *
     * @param \AppBundle\Entity\CursoModuloTemaLogro $logros
     */
    public function removeLogro(\AppBundle\Entity\CursoModuloTemaLogro $logros)
    {
        $this->logros->removeElement($logros);
    }

    /**
     * Get logros
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLogros()
    {
        return $this->logros;
    }
}
