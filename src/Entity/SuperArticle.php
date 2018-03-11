<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SuperArticleRepository")
 

 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator_column", type="string")
 * @ORM\DiscriminatorMap({"SuperArticle" = "SuperArticle", "Article" = "Article", "Event"="Event"})
 *
 */
abstract class SuperArticle
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
    protected $title;
    
    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank()
     * @var string / content
     */
    protected $content;
    
   
    /**
     * @ORM\ManyToOne(targetEntity="Category", fetch="EAGER") //many articl pour one category //fetch EAGER = force doctrine à récupérer la catégory dans la foulé, sinon il chargé par une requete au moment de l'affichage du name -> evite donc le LAZY Loading
     * @ORM\JoinColumn(nullable=false) //on peut présiser le champ de référence dans la table target, mais par défaut c'est id, et les cascad aussi.
     * @Assert\NotBlank()
     * @var Category
     */
    protected $category; //instance de l'entity Category (clé étrangère)
    
    /**
     * @ORM\ManyToOne(targetEntity="User") //many articl pour one User
     * @ORM\JoinColumn(nullable=false)
     * @var User 
     */
    protected $author;
    
    /**
     * @ORM\Column(type="datetime")
     * @Assert\DateTime()
     *  //datearticle
     */
    protected $datearticle;
    
    /**
     * @ORM\Column(nullable=true)
     * @Assert\Image()
     * @var //picture
     */
    protected $picture;
    
     

    public function __construct() {
        $this->datearticle = new \DateTime("now");
        dump($this->datearticle);
    }

    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getContent() {
        return $this->content;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getAuthor(): User {
        return $this->author;
    }

    public function setTitle(string $title) {
        $this->title = $title;
        return $this;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }


    public function setCategory(Category $category) {
        $this->category = $category;
        return $this;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
        return $this;
    }
    public function getPicture() {
        return $this->picture;
    }

    public function setPicture($picture) {
        $this->picture = $picture;
        return $this;
    }
    
    public function getDatarticle() {
        return $this->datepost;
    }

    public function setDatearticle($datepost) {
        $this->datepost = $datepost;
        return $this;
    }




}
