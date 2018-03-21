<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BirthRepository")
 */
class Birth extends SuperArticle
{
    
    /**
     *
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
    private $firstname;
    
    /**
     *
     * @ORM\Column(type="string", columnDefinition="ENUM('m', 'f')")
     * @Assert\NotBlank()
     *  //
     */
    private $gender;
    /**
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;
    /**
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $height;
    /**
     *
     * @ORM\Column(type="date")
     * @Assert\NotBlank()
     */
    private $birthdate;
    /**
     *
     * @ORM\Column(type="time", nullable=true)
     */
    private $birthhour;
    
    public function getFirstname() {
        return $this->firstname;
    }

    public function getGender() {
        if($this->gender == 'm'){
            return 'garçon';
        }
        return 'fille';
        
    }

    public function getWeight() {
        return $this->weight;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function getBirthhour() {
        return $this->birthhour;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setGender($gender) {
        $this->gender = $gender;
        return $this;
    }

    public function setWeight($weight) {
        $this->weight = $weight;
        return $this;
    }

    public function setHeight($height) {
        $this->height = $height;
        return $this;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function setBirthhour($birthhour) {
        $this->birthhour = $birthhour;
        return $this;
    }


}
