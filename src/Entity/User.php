<?php

namespace App\Entity; //vérifier l'unicité d'un champ en base

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;  //nécessaire car UserInterface contiend des méthodes dont l'encodage à besoin pour bosser.
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="email", message="cette email existe déjà")
 */
class User implements AdvancedUserInterface
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
    private $firstname;
    /**
     * @ORM\Column()
     * @Assert\NotBlank()
     * @var string
     */
    private $lastname;

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
    private $password;

    /**
     * @ORM\Column(length=20)
     * @var string
     */
    private $role = 'ROLE_USER';
    
    
    /**
     * @ORM\Column(type="date")
     * @var string
     */
    private $birthdate;
    
    
    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('m', 'f')")
     * @Assert\NotBlank()
     */
    private $gender;
    
    /**
     * @ORM\Column()
     * @var string
     */
    private $phone;
    
    /**
     * @ORM\Column(nullable=true)
     * @Assert\Image(groups={"edit"})
     * @var string
     */
    private $avatar;
    
    /**
     * @ORM\Column()
     * @var string
     */
    private $adress;
    
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    private $cp;
            
    /**
     * @ORM\Column()
     * @var string
     */
    private $city;
            
    /**
     * @ORM\Column()
     * @var string
     */
    private $country;
    
    /**
     * @var string
     * @Assert\NotBlank()
     */
    
    private $plainpassword;
    
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive=false;
    
    
    
    public function getFirstname() {
        return $this->firstname;
    }

    public function getLastname() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole() {
        return $this->role;
    }

    public function getBirthdate() {
        return $this->birthdate;
    }

    public function getGender() {
        return $this->gender;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getAvatar() {
        return $this->avatar;
    }

    public function getAdress() {
        return $this->adress;
    }

    public function getCp() {
        return $this->cp;
    }
    public function getCity() {
        return $this->city;
    }

    public function getPlainpassword() {
        return $this->plainpassword;
    }

        public function getCountry() {
        return $this->country;
    }

    public function setFirstname($firstname) {
        $this->firstname = $firstname;
        return $this;
    }

    public function setLastname($lastname) {
        $this->lastname = $lastname;
        return $this;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setRole($role) {
        $this->role = $role;
        return $this;
    }

    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function setGender($gender) {
        $this->gender = $gender;
        return $this;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    public function setAvatar($avatar) {
        $this->avatar = $avatar;
        return $this;
    }

    public function setAdress($adress) {
        $this->adress = $adress;
        return $this;
    }

    public function setCp($cp) {
        $this->cp = $cp;
        return $this;
    }

    public function setCountry($country) {
        $this->country = $country;
        return $this;
    }
    public function setCity($city) {
        $this->city = $city;
        return $this;
    }

    public function setPlainpassword($plainpassword) {
        $this->plainpassword = $plainpassword;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function getFullName(){
        return $this->getFirstname(). ' '.$this->getLastname();
    }
    
    public function getIsActive() {
        return $this->isActive;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
        return $this;
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
   
    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

 // serialize and unserialize must be updated - see below
    public function serialize()
    {
        return serialize(array(
            $this->isActive,
        ));
    }
    public function unserialize($serialized)
    {
        list (
            $this->isActive,
        ) = unserialize($serialized);
    }
}
