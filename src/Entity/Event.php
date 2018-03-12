<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventRepository")
 */
class Event extends SuperArticle
{
   
    /**
     *
     * @ORM\Column()
     */
    private $localisation;
    
    /**
     * @ORM\Column(type="date")
     * @Assert\Date()
     */
    private $dateevent;
    
    public function getLocalisation() {
        return $this->localisation;
    }

    public function getDateevent() {
        return $this->dateevent;
    }

    public function setLocalisation($localisation) {
        $this->localisation = $localisation;
        return $this;
    }

    public function setDateevent($dateevent) {
        $this->dateevent = $dateevent;
        return $this;
    }
}
