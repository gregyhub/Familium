<?php

namespace App\Form;

use App\Entity\Messaging;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessagingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
               
        $builder            
                ->add('message', \Ivory\CKEditorBundle\Form\Type\CKEditorType::class, array(
                    'config' => array(
                        'uiColor' => '#ffffff',
                    ),
                ));
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            'data_class' => Messaging::class,
        ]);
    }
}
