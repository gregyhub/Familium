<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->controller = $options['controller'];
        $builder
            ->add(  'nom',
                    TextType::class,
                    [
                         'label' => 'Nom'
                    ]
                  )
            ->add(  'prenom',
                     TextType::class,
                    [
                     'label' => 'Prénom'
                    ]
              )
            ->add(  'email',
                    EmailType::class,
                    [
                     'label' => 'Email'
                    ]
              )
            ->add(  'telephone',
                    TelType::class,
                    [
                     'label' => 'Télephone'
                    ]
              )
            ->add(  'datenaissance',
                    BirthdayType::class,
                    [
                     'label' => 'Date de naissance'
                    ]
              )
            ->add(  'adresse',
                     TextType::class,
                    [
                     'label' => 'Adresse'
                    ]
              )
            ->add(  'cp',
                     TextType::class,
                    [
                     'label' => 'Code Postal'
                    ]
              )
            ->add(  'ville',
                     TextType::class,
                    [
                     'label' => 'Ville'
                    ]
              )
            ->add(  'pays',
                    CountryType::class,
                    [
                     'label' => 'Pays'
                    ]
              );
        if($this->controller == 'security'){
            $builder->add(  'mdpclair',
                    RepeatedType::class,  //2 champs qui doivent être identique
                    [
                        //de type password
                     'type' => PasswordType::class,
                     'first_options' => ['label' => 'Mot de passe'],
                     'second_options' => ['label' => 'Confirmation du mot de passe'],
                    ]
              );
        }
        elseif($this->controller == 'user'){
            $builder->add( 'mdpclair',
                    PasswordType::class,
                    [
                     'label' => 'Saississez votre mot de passe'
                    ]
              );
        }
            
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => User::class,
            'controller' => null,
        ]);
    }
}
