<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Estatus
 *
 * @ORM\Table(name="curso_modulo_tema_logro")
 * @ORM\Entity
 */
class CursoModuloTemaLogro
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del logro"})
     */
    private $nombre;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_corto", type="string", length=255, nullable=true, options={"comment" = "Nombre del logro"})
     */
    private $nombreCorto;
    
    
    /**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Descripción del logro a obtener"})
     */
    private $descripcion;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false, options={"comment" = "Orden del logro dentro del tema"})
     */
    private $orden;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_necesaria", type="integer", nullable=false, options={"comment" = "Numero de veces necesarias para obtener el logro"})
     */
    private $cantidadNecesaria;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="periodo_tiempo", type="integer", nullable=false, options={"comment" = "Tiempo necesario para el logro"})
     */
    private $periodoTiempo;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="badge", type="integer", nullable=false, options={"comment" = "número de seguidilla de logro"})
     */
    private $badge;
        
    

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del logro"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="estatus_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    /**
     * @var \AppBundle\Entity\CursoModuloTema
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoModuloTema", inversedBy="logros")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_modulo_tema", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCursoModuloTema;
    
    
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
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=false, options={"comment" = "nombre de la imagen en el directorio"})
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="fontawesome", type="string", length=100, nullable=true, options={"comment" = "imagen fontawesome del logro"})
     */
    private $fontawesome;
    
    
    

   
    
    public function __toString() {
        return $this->getNombre();
    }


    /**
     * Set nombre
     *
     * @param string $nombre
     * @return CursoModuloTemaLogro
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
     * @return CursoModuloTemaLogro
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
     * Set orden
     *
     * @param integer $orden
     * @return CursoModuloTemaLogro
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer 
     */
    public function getOrden()
    {
        return $this->orden;
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
     * Set idCursoModuloTema
     *
     * @param \AppBundle\Entity\CursoModuloTema $idCursoModuloTema
     * @return CursoModuloTemaLogro
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
     * Set imagen
     *
     * @param string $imagen
     * @return CursoModuloTemaLogro
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set nombreCorto
     *
     * @param string $nombreCorto
     * @return CursoModuloTemaLogro
     */
    public function setNombreCorto($nombreCorto)
    {
        $this->nombreCorto = $nombreCorto;

        return $this;
    }

    /**
     * Get nombreCorto
     *
     * @return string 
     */
    public function getNombreCorto()
    {
        return $this->nombreCorto;
    }

    /**
     * Set badge
     *
     * @param integer $badge
     * @return CursoModuloTemaLogro
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;

        return $this;
    }

    /**
     * Get badge
     *
     * @return integer 
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * Set cantidadNecesaria
     *
     * @param integer $cantidadNecesaria
     * @return CursoModuloTemaLogro
     */
    public function setCantidadNecesaria($cantidadNecesaria)
    {
        $this->cantidadNecesaria = $cantidadNecesaria;

        return $this;
    }

    /**
     * Get cantidadNecesaria
     *
     * @return integer 
     */
    public function getCantidadNecesaria()
    {
        return $this->cantidadNecesaria;
    }

    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return CursoModuloTemaLogro
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

    /**
     * Set periodoTiempo
     *
     * @param integer $periodoTiempo
     * @return CursoModuloTemaLogro
     */
    public function setPeriodoTiempo($periodoTiempo)
    {
        $this->periodoTiempo = $periodoTiempo;

        return $this;
    }

    /**
     * Get periodoTiempo
     *
     * @return integer 
     */
    public function getPeriodoTiempo()
    {
        return $this->periodoTiempo;
    }

    /**
     * Set fontawesome
     *
     * @param string $fontawesome
     *
     * @return CursoModuloTemaLogro
     */
    public function setFontawesome($fontawesome)
    {
        $this->fontawesome = $fontawesome;

        return $this;
    }

    /**
     * Get fontawesome
     *
     * @return string
     */
    public function getFontawesome()
    {
        return $this->fontawesome;
    }
}
