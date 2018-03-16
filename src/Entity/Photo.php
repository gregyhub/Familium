<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="PhotoRepository")
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\Column(type="string")
     */
    private $photo;
    
    /**
     * @ORM\ManyToMany(targetEntity="Album") //many articl pour one User
     * @ORM\JoinColumn(nullable=false)
     * @var Album 
     */
    private $album;
    
    public function __construct() {
       $this->album = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getAlbum(): Album {
        return $this->album;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
        return $this;
    }

    public function setAlbum(Album $album) {
        $this->album = $album;
        return $this;
    }


}
