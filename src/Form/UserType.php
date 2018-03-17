<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
        if($this->controller == 'security' || $this->controller == 'user')
        {
            $builder
            ->add(  'lastname',
                    TextType::class,
                    [
                         'label' => 'Nom'
                    ]
                  )
            ->add(  'firstname',
                     TextType::class,
                    [
                     'label' => 'Prénom'
                    ]
              )
            ->add(  'gender',
                    ChoiceType::class,
                    [
                        'label' => 'sexe du bébé',
                        'choices' => ['Homme' => 'm', 'Femme'=>'f'],
                        'expanded' => true,
                        'multiple' => false
                    ]
              )
            ->add(  'email',
                    EmailType::class,
                    [
                     'label' => 'Email'
                    ]
              )
            ->add(  'phone',
                    TelType::class,
                    [
                     'label' => 'Télephone'
                    ]
              )
            ->add(  'birthdate',
                    BirthdayType::class,
                    [
                     'label' => 'Date de naissance'
                    ]
              )
            ->add(  'adress',
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
            ->add(  'city',
                     TextType::class,
                    [
                     'label' => 'Ville'
                    ]
              )
            ->add(  'country',
                    CountryType::class,
                    [
                     'label' => 'Pays'
                    ]
            )->add(  'avatar',
                    FileType::class,
                    [
                    'label'    => 'avatar',
                    'required' => false
                    ]
            );
        }
        if($this->controller == 'security' || $this->controller == 'editpassword')
        {
            $builder->add(  'plainpassword',
                    RepeatedType::class,  //2 champs qui doivent être identique
                    [
                        //de type password
                     'type' => PasswordType::class,
                     'first_options' => ['label' => 'Mot de passe'],
                     'second_options' => ['label' => 'Confirmation du mot de passe'],
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
