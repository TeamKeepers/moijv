<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

// ATTENTION, on ne ctrl/shift/i pas TagRepository car entre ""

/**
 * @ORM\Entity(repositoryClass="App\Repository\TagRepository")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @var string
     */
    private $name;
    
    /**
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="tags")
     * @var Collection 
     */
    private $products;
    
    public function __construct() {
        $this->products = new ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getProducts(): Collection {
        return $this->products;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setProducts(Collection $products) {
        $this->products = $products;
        return $this;
    }


}
