<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AlbumRepository")
 */
class Album
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @var string / title
     */
    private $title;
    
    /**
     * @ORM\ManyToOne(targetEntity="User") //many articl pour one User
     * @ORM\JoinColumn(nullable=false)
     * @var User 
     */
    private $author;
    
    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     *  //datearticle
     */
    private $dateupdate;
    
     /**
     * @ORM\Column(type="string")
     *  //Public ok private
     */
    private $visibility = "public";
    
    public function __construct() {
        $this->dateupdate = new \DateTime("now");
    }
    
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getAuthor(): User {
        return $this->author;
    }

    public function getDateupdate() {
        return $this->dateupdate;
    }

    public function getVisibility() {
        return $this->visibility;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
        return $this;
    }

    public function setDateupdate($dateupdate) {
        $this->dateupdate = $dateupdate;
        return $this;
    }

    public function setVisibility($visibility) {
        $this->visibility = $visibility;
        return $this;
    }


}
