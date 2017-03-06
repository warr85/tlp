<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
Use Doctrine\Common\Collections\Criteria;


/**
 * Estatus
 *
 * @ORM\Table(name="curso")
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Curso
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false, options={"comment" = "Nombre del Curso"})
     */
    private $nombre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre_corto", type="string", length=255, nullable=true, options={"comment" = "Nombre Corto del curso"})
     */
    private $nombreCorto;
    
    
    /**
     * @var text
     *
     * @ORM\Column(name="descripcion", type="text", nullable=false, options={"comment" = "Nombre del Curso"})
     */
    private $descripcion;
          
    
    /**
     * @ORM\OneToMany(targetEntity="CursoModulo", mappedBy="idCurso", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $modulos;


     /**
     * @ORM\OneToMany(targetEntity="CursoGrupo", mappedBy="idCurso", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $grupos;

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
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="course_image", fileNameProperty="imageName")
     * 
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;
    
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modulos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->grupos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    
    

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Curso
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
     * @return Curso
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     * @return Curso
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string 
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Curso
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    
    
     /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Curso
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }

        return $this;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }
    
    /**
     * @return string
     */
    public function __toString() {
        return $this->getNombre();
    }

    /**
     * Add modulos
     *
     * @param \AppBundle\Entity\CursoModulo $modulos
     * @return Curso
     */
    public function addModulo(\AppBundle\Entity\CursoModulo $modulos)
    {
        $this->modulos[] = $modulos;

        return $this;
    }

    /**
     * Remove modulos
     *
     * @param \AppBundle\Entity\CursoModulo $modulos
     */
    public function removeModulo(\AppBundle\Entity\CursoModulo $modulos)
    {
        $this->modulos->removeElement($modulos);
    }

    /**
     * Get modulos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModulos()
    {
        return $this->modulos;
    }

    /**
     * Add grupos
     *
     * @param \AppBundle\Entity\CursoGrupo $grupos
     * @return Curso
     */
    public function addGrupo(\AppBundle\Entity\CursoGrupo $grupos)
    {
        $this->grupos[] = $grupos;

        return $this;
    }

    /**
     * Remove grupos
     *
     * @param \AppBundle\Entity\CursoGrupo $grupos
     */
    public function removeGrupo(\AppBundle\Entity\CursoGrupo $grupos)
    {
        $this->grupos->removeElement($grupos);
    }

    /**
     * Get grupos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGrupos()
    {
        return $this->grupos;
    }

    /**
     * Set nombreCorto
     *
     * @param string $nombreCorto
     * @return Curso
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
     * Add niveles
     *
     * @param \AppBundle\Entity\CursoNivel $niveles
     * @return Curso
     */
    public function addNivele(\AppBundle\Entity\CursoNivel $niveles)
    {
        $this->niveles[] = $niveles;

        return $this;
    }

    /**
     * Remove niveles
     *
     * @param \AppBundle\Entity\CursoNivel $niveles
     */
    public function removeNivele(\AppBundle\Entity\CursoNivel $niveles)
    {
        $this->niveles->removeElement($niveles);
    }

    /**
     * Get niveles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNiveles()
    {
        return $this->niveles;
    }


    /* @param Integer $exp
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getNivelesByXp($exp)
    {
        $criteria = Criteria::create()
            ->andWhere(Criteria::expr()->gte('experienciaNecesaria', $exp))
            ->orderBy(array("id" => Criteria::ASC))
            ->setFirstResult(0)
            ->setMaxResults(1);
        return $this->getNiveles()->matching($criteria);
    }
    

}
