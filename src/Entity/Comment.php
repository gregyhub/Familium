<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="User") //many comment pour one User
     * @ORM\JoinColumn(nullable=false)
     * @var User 
     */
    private $author; 

    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     *  //datearticle
     */
    private $datecomment;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @var string
     */
    private $comment;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="SuperArticle") //many Comment pour one Article
     * @ORM\JoinColumn(nullable=false)
     * @var SuperArticle 
     */
    private $article;
    
    public function __construct() {
        $this->datecomment = new \DateTime();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getAuthor(): User {
        return $this->author;
    }

    public function getDatecomment() {
        return $this->datecomment;
    }

    public function getComment() {
        return $this->comment;
    }

    public function getArticle(): SuperArticle {
        return $this->article;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
        return $this;
    }

    public function setDatecomment($datecomment) {
        $this->datecomment = $datecomment;
        return $this;
    }

    public function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }

    public function setArticle(SuperArticle $article) {
        $this->article = $article;
        return $this;
    }
}
