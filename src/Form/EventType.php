<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType  extends AbstractType //extends ArticleType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->add(  'localisation',
                    TextType::class,
                    [
                         'label' => 'lieu de l\'evenement'
                    ]
                  )
            ->add(  'dateevent',
                    DateType::class,
                    [
                     'label' => 'date de l\'evenement'
                    ]
              )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
                'data_class' => Event::class,
        ]);
    }
}
