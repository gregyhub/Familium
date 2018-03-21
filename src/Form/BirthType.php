<?php

namespace App\Form;

use App\Entity\Birth;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BirthType extends ArticleType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add(  'firstname',
                    TextType::class,
                    [
                        'label' => 'Prénom du bébé'
                    ]
                  )
            ->add(  'gender',
                    ChoiceType::class,
                    [
                        'label' => 'Sexe du bébé',
                        'choices' => ['Garçon' => 'm', 'Fille'=>'f'],
                        'expanded' => true,
                        'multiple' => false
                    ]
              )
            ->add(  'weight',
                    TextType::class,
                    [
                     'label' => 'Poids du bébé',
                     'required' => false
                    ]
              )
            ->add(  'height',
                    TextType::class,
                    [
                     'label' => 'Taille du bébé',
                     'required' => false
                    ]
              )
            ->add(  'birthdate',
                    DateType::class,
                    [
                     'label' => 'Date de naissance'
                    ]
              )
            ->add(  'birthhour',
                    TimeType::class,
                    [
                     'label' => 'Heure de naissance',
                     'required' => false
                    ]
              )
        ;
    }
   

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
                'data_class' => Birth::class,
        ]);
    }
}
