<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Votre nom',
                ]
            ])
            ->add('telephone',TelType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Votre téléphone',
                ]
            ])
            ->add('email',EmailType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Votre adresse mail',
                ]
            ])->add('message',TextareaType::class,[
                'label'=>false,
                'attr'=>[
                    'class'=>'message',
                    'placeholder'=>'Votre message',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
