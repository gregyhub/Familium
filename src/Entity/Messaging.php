<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessagingRepository")
 */
class Messaging
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User") //many articl pour one User
     * @ORM\JoinColumn(nullable=false)
     * @var User 
     */
    private $author;
    
    /**
     * @ORM\ManyToOne(targetEntity="User") //many articl pour one User
     * @ORM\JoinColumn(nullable=false)
     * @var User 
     */
    private $recipient;
    
    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     */
    private $dateMessage;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @var string / 
     */
    private $message;
    
    /**
     *
     * @ORM\Column(type="text")
     */
    private $newmessage='new';
    
    
    private $newpersist='new';
    
    
    public function getNewpersist() {
        return $this->newpersist;
    }

    public function setNewpersist($newpersist) {
        $this->newpersist = $newpersist;
        return $this;
    }

        public function getNewmessage() {
        return $this->newmessage;
    }

    public function setNewmessage($newmessage) {
        $this->newmessage = $newmessage;
        return $this;
    }

    public function __construct() {
        $this->dateMessage = new \DateTime("now");
        $this->newpersist = $this->getNewmessage();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getAuthor(): User {
        return $this->author;
    }

    public function getRecipient(): User {
        return $this->recipient;
    }

    public function getDateMessage() {
        return $this->dateMessage;
    }

    public function getMessageClean() {
        return nl2br($this->message);
    }
    public function getMessage() {
        return $this->message;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
        return $this;
    }

    public function setRecipient(User $recipient) {
        $this->recipient = $recipient;
        return $this;
    }

    public function setDateMessage($dateMessage) {
        $this->dateMessage = $dateMessage;
        return $this;
    }

    public function setMessage($message) {
        $this->message = $message;
        return $this;
    }

    public function setHistory($originMessage){
        $history = '  <br>___________________________________________________<br>';
        $history .= 'le ';
        $history .= $originMessage->getDateMessage()->format('Y-m-d H:i:s');
        $history .= ', ';
        $history .= $originMessage->getAuthor()->getFullname();
        $history .= ' à écrit :<br>';
        
        dump($history);
        $history = str_replace('<br>', "\r\n", $history);
        dump($history);

        
        $history .= $originMessage->getMessage();
        $this->setMessage($history);
    }
    
    
}
