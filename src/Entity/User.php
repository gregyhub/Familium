<?php

namespace App\Entity; //vérifier l'unicité d'un champ en base

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;  //nécessaire car UserInterface contiend des méthodes dont l'encodage à besoin pour bosser.
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="cette email existe déjà")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column()
     * @Assert\NotBlank()
     * @var string
     */
    private $prenom;
    /**
     * @ORM\Column()
     * @Assert\NotBlank()
     * @var string
     */
    private $nom;

    /**
     * @ORM\Column(unique=true)
     * @Assert\NotBlank()
     * @Assert\Email(message="cet email n'est pas valide")
     * @var string
     */
    private $email;
    
    /**
     * @ORM\Column()
     * @var string
     */
    private $mdp;

    /**
     * @ORM\Column(length=20)
     * @var string
     */
    private $role = 'ROLE_USER';
    
    
    /**
     * @ORM\Column(type="date")
     * @var string
     */
    private $datenaissance;
    
    /**
     * @ORM\Column()
     * @var string
     */
    private $telephone;
    
    /**
     * @ORM\Column(nullable=true)
     * @Assert\Image()
     * @var string
     */
    private $avatar;
    
    /**
     * @ORM\Column()
     * @var string
     */
    private $adresse;
    
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $cp;
            
    /**
     * @ORM\Column()
     * @var string
     */
    private $ville;
            
    /**
     * @ORM\Column()
     * @var string
     */
    private $pays;
    
    /**
     * @var string
     * @Assert\NotBlank()
     */
    
    private $mdpclair;

    public function getPrenom() {
        return ucfirst($this->prenom);
    }

    public function getNom() {
        return strtoupper($this->nom);
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMdp() {
        return $this->mdp;
    }
    public function getPassword() {
        return $this->mdp;
    }

    public function getRole() {
        return $this->role;
    }

    public function getDatenaissance() {
        return $this->datenaissance;
    }

    public function getTelephone() {
        return $this->telephone;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getCp() {
        return $this->cp;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getPays() {
        return $this->pays;
    }

    public function getMdpclair() {
        return $this->mdpclair;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
        return $this;
    }

    public function setNom($nom) {
        $this->nom = $nom;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setMdp($mdp) {
        $this->mdp = $mdp;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    public function setDatenaissance($datenaissance) {
        $this->datenaissance = $datenaissance;
        return $this;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
        return $this;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
        return $this;
    }

    public function setAdresse($adresse) {
        $this->adresse = $adresse;
        return $this;
    }

    public function setCp($cp) {
        $this->cp = $cp;
        return $this;
    }

    public function setVille($ville) {
        $this->ville = $ville;
        return $this;
    }

    public function setPays($pays) {
        $this->pays = $pays;
        return $this;
    }

    public function setMdpclair($mdpclair) {
        $this->mdpclair = $mdpclair;
        return $this;
    }

        
    
    public function getId() {
        return $this->id;
    }


    public function getFullName(){
        return $this->getPrenom(). ' '.$this->getNom();
    }
    
    public function eraseCredentials() {
        //si on veut enlever une partie des droit à un user, dans cet exemple on laisse vide
    }

    public function getRoles() {
        return array($this->role);
    }

    public function getSalt() {
        //c'est pour l'encodage de mdp, certain systeme de cryptage ajout un "grain de sel".
        //on laisse a vide dans cette exemple
    }

    public function getUsername(): string {
        //UserName c'est l'identifiant de user > ici on renvoi donc l'email
        return $this->email;
    }

    public function __toString() {
        return $this->getFullName();
    }
}

