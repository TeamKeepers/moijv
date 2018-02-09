<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @var string
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @var string
     */
    private $firstname;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $username;

    // \ devant DateTime car fonction native de PHP (n'utilise pas le mapping ORM)
    /**
     * @ORM\Column(type="date")
     * @var \DateTime
     */
    private $birthdate;
    
    /** 
     * @ORM\OneToMany(targetEntity="Product", mappedBy="user")
     * @var Collection
     */
    private $products;
    
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $roles;
        
    public function __construct() {
        $this->products= new ArrayCollection();
    }
    
    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }
    
    public function getRoles()
    {
        // nos rôles seront stockés sous ce format: "ROLE_USER|ROLE_ADMIN"
        return explode('|', $this->roles);
    }
    
        public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }
    
    /* collection = déclaré comme un array */
    public function getProducts(): Collection {
        return $this->products;
    }

    public function setProducts(Collection $products) {
        $this->products = $products;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getBirthdate(): \DateTime {
        return $this->birthdate;
    }
    
    public function setRoles($roles) {
        $this->roles = $roles;
        return $this;
    }
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setBirthdate(\DateTime $birthdate) {
        $this->birthdate = $birthdate;
        return $this;
    }


}
