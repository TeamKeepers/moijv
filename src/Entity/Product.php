<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as CustomAssert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @Table(indexes={@Index(name="state_index", columns={"state"})})
 */
class Product {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Length(min=2, max=100)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Assert\Length(min=10, max=2000)
     * @CustomAssert\BadWord(badwords={"crotte", "zut"})
     * @var string
     */
    private $description;

    /**
     * @ORM\Column(type="string")
     * @Assert\Image(minWidth=300, maxHeight=300, maxSize="1024k")
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\Choice({"very bad", "bad", "average", "good", "very good"})
     * @var string
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="products")
     * @var User
     */
    private $user;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", mappedBy="products")
     * @var Collection
     */
    private $tags;

    public function __construct() {
        $this->tags = new ArrayCollection();
    }

    public function addTag($tag) {

        if ($this->getTags()->contains($tag)) {
            return;
        }

        $this->getTags()->add($tag);
        $tag->getProducts()->add($this);
    }

    public function getTags(): Collection {
        return $this->tags;
    }

    public function setTags(Collection $tags) {
        $this->tags = $tags;
        return $this;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getImage() {
        return $this->image;
    }

    public function getState() {
        return $this->state;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setImage($image) {
        $this->image = $image;
        return $this;
    }

    public function setState($state) {
        $this->state = $state;
        return $this;
    }

}
