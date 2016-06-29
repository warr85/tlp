<?php
/**
 * Created by PhpStorm.
 * User: ubv-cipee
 * Date: 29/06/16
 * Time: 08:36 AM
 */



namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios", uniqueConstraints={@ORM\UniqueConstraint(name="usuarios_id_rol_institucion_key", columns={"id_rol_institucion"})})
 * @ORM\Entity(repositoryClass="UsuariosRepository")
 * @UniqueEntity(fields="username", message="Username already taken")
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
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false, options={"comment" = "contraseña encryptada"})
     */
    protected $password;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;



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
     * @var \AppBundle\Entity\RolInstitucion
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RolInstitucion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_rol_institucion", referencedColumnName="id", nullable=false)
     * })
     */
    protected $idRolInstitucion;

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
     * Set idRolInstitucion
     *
     * @param \AppBundle\Entity\RolInstitucion $idRolInstitucion
     * @return Usuarios
     */
    public function setIdRolInstitucion(\AppBundle\Entity\RolInstitucion $idRolInstitucion = null)
    {
        $this->idRolInstitucion = $idRolInstitucion;

        return $this;
    }

    /**
     * Get idRolInstitucion
     *
     * @return \AppBundle\Entity\RolInstitucion
     */
    public function getIdRolInstitucion()
    {
        return $this->idRolInstitucion;
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
}