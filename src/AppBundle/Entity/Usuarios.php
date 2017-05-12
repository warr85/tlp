<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios")
 * @ORM\Entity(repositoryClass="UsuariosRepository")
 * @UniqueEntity(fields="username", message="Nombre de usuario ya Existe")
 */
class Usuarios implements UserInterface, \Serializable
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false, options={"comment" = "nombre de usuariro"})
     */
    protected $username;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Email
     * @var string
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false, options={"comment" = "contraseña encryptada"})
     */
    protected $password;

    /**
     * 
     * @Assert\Length(max=4096)
     */
    private $plainPassword;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Inscripcion", mappedBy="idUsuario", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $inscripciones;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\UsuariosLogros", mappedBy="idUsuario", cascade={"all"})
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $logros;


    /**
     * @var integer
     *
     * @ORM\Column(name="experiencia", type="integer", nullable=true, options={"comment" = "Experiencia Acumulada del participante en esa inscripcion"})
     */
    private $experiencia;



    /**
     * @var \AppBundle\Entity\CursoNivel
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CursoNivel", inversedBy="usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_curso_nivel", referencedColumnName="id", nullable=true)
     * })
     */
    private $idCursoNivel;



    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", options={"comment" = "identificador de los usuarios"}, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="usuarios_id_seq", allocationSize=1, initialValue=1)
     */
    protected $id;
    

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role", inversedBy="user")
     * @ORM\JoinTable(name="user_role",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="rol_id", referencedColumnName="id", nullable=false)
     *   }
     * )
     */
    protected $rol;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rol = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set username
     *
     * @param string $username
     * @return Usuarios
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    
    
     /**
     * Set username
     *
     * @param string $email
     * @return Usuarios
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    

    /**
     * Set password
     *
     * @param string $password
     * @return Usuarios
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
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
     * Add rol
     *
     * @param \AppBundle\Entity\Role $rol
     * @return Role
     */
    public function addRol(\AppBundle\Entity\Role $rol)
    {
        $this->rol[] = $rol;

        return $this;
    }

    /**
     * Remove rol
     *
     * @param \AppBundle\Entity\Role $rol
     */
    public function removeRol(\AppBundle\Entity\Role $rol)
    {
        $this->rol->removeElement($rol);
    }

    /**
     * Get rol
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRol()
    {
        return $this->rol;
    }


    public function getRoles()
    {
        return $this->rol->toArray();  /*IMPORTANTE: el mecanismo de seguridad de Sf2 requiere ésto como un array*/
    }

    public function equals(UserInterface $user) {
        return md5($this->getUsername()) == md5($user->getUsername());

    }

    /**
     * Erases the user credentials.
     */
    public function eraseCredentials() {

    }

    public function serialize()
    {
        /*
         * ! Don't serialize $roles field !
         */
        return \serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            ) = \unserialize($serialized);
    }

    public function __toString() {
        return $this->getuserName();
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    public function isGranted($rol)
    {
        return in_array($rol, $this->getRoles());
    }


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Add inscripciones
     *
     * @param \AppBundle\Entity\inscripcion $inscripciones
     * @return Usuarios
     */
    public function addInscripcione(\AppBundle\Entity\inscripcion $inscripciones)
    {
        $this->inscripciones[] = $inscripciones;

        return $this;
    }

    /**
     * Remove inscripciones
     *
     * @param \AppBundle\Entity\inscripcion $inscripciones
     */
    public function removeInscripcione(\AppBundle\Entity\inscripcion $inscripciones)
    {
        $this->inscripciones->removeElement($inscripciones);
    }

    /**
     * Get inscripciones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInscripciones()
    {
        return $this->inscripciones;
    }



    /**
     * Set experiencia
     *
     * @param integer $experiencia
     * @return Usuarios
     */
    public function setExperiencia($experiencia)
    {
        $this->experiencia = $experiencia;

        return $this;
    }

    /**
     * Get experiencia
     *
     * @return integer 
     */
    public function getExperiencia()
    {
        return $this->experiencia;
    }

    /**
     * Set idCursoNivel
     *
     * @param \AppBundle\Entity\CursoNivel $idCursoNivel
     * @return Usuarios
     */
    public function setIdCursoNivel(\AppBundle\Entity\CursoNivel $idCursoNivel = null)
    {
        $this->idCursoNivel = $idCursoNivel;

        return $this;
    }

    /**
     * Get idCursoNivel
     *
     * @return \AppBundle\Entity\CursoNivel 
     */
    public function getIdCursoNivel()
    {
        return $this->idCursoNivel;
    }





    /**
     * Add logro
     *
     * @param \AppBundle\Entity\UsuariosLogros $logro
     *
     * @return Usuarios
     */
    public function addLogro(\AppBundle\Entity\UsuariosLogros $logro)
    {
        $this->logros[] = $logro;

        return $this;
    }

    /**
     * Remove logro
     *
     * @param \AppBundle\Entity\UsuariosLogros $logro
     */
    public function removeLogro(\AppBundle\Entity\UsuariosLogros $logro)
    {
        $this->logros->removeElement($logro);
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
