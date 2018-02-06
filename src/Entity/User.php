<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
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
    
    public function __construct() {
        $this->products= new ArrayCollection();
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
