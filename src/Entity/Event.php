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
    
}
