<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


/**
 * Estatus
 *
 * @ORM\Table(name="curso_modulo_tema_evaluacion")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class CursoModuloTemaEvaluacion
{
    
    
    
    /**
     * @var \AppBundle\Entity\TipoEvaluacion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TipoEvaluacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_evaluacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $idTipoEvaluacion;
    
    
    /**
     * @var \AppBundle\Entity\CursoModuloTema
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoModuloTema", inversedBy="evaluaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_modulo_tema", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoModuloTema;
          
    
    /**
     * @ORM\Column(type="float", nullable=false)
     *
     * @var float
     */
    private $ponderacion;
    
    

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idTipoEvaluacion
     *
     * @param \AppBundle\Entity\TipoEvaluacion $idTipoEvaluacion
     * @return CursoModuloTemaEvaluacion
     */
    public function setIdTipoEvaluacion(\AppBundle\Entity\TipoEvaluacion $idTipoEvaluacion)
    {
        $this->idTipoEvaluacion = $idTipoEvaluacion;

        return $this;
    }

    /**
     * Get idTipoEvaluacion
     *
     * @return \AppBundle\Entity\TipoEvaluacion 
     */
    public function getIdTipoEvaluacion()
    {
        return $this->idTipoEvaluacion;
    }

    /**
     * Set idCursoModuloTema
     *
     * @param \AppBundle\Entity\CursoModuloTema $idCursoModuloTema
     * @return CursoModuloTemaEvaluacion
     */
    public function setIdCursoModuloTema(\AppBundle\Entity\CursoModuloTema $idCursoModuloTema)
    {
        $this->idCursoModuloTema = $idCursoModuloTema;

        return $this;
    }

    /**
     * Get idCursoModuloTema
     *
     * @return \AppBundle\Entity\CursoModuloTema 
     */
    public function getIdCursoModuloTema()
    {
        return $this->idCursoModuloTema;
    }

    /**
     * Set ponderacion
     *
     * @param float $ponderacion
     * @return CursoModuloTemaEvaluacion
     */
    public function setPonderacion($ponderacion)
    {
        $this->ponderacion = $ponderacion;

        return $this;
    }

    /**
     * Get ponderacion
     *
     * @return float 
     */
    public function getPonderacion()
    {
        return $this->ponderacion;
    }
    
    /**
     * @return string
     */
    public function __toString() {
        return $this->getIdTipoEvaluacion()->getNombre();
    }
}
