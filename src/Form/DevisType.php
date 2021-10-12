<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('venteouloc', ChoiceType::class,[
                'choices'=>[
                    'Vente'=>'vente',
                    'Location'=>'location'
                ],
                'data'=>'vente',
                'required'=>true,
                'attr'=>[
                    'class'=>'venteoulocation'
                ],
                'label'=>false,

                'expanded'=> true,
            ])
            ->add('typeDeBien', ChoiceType::class,[
                'choices'=>[
                    'Appartement'=>'Appartement',
                    'Maison'=>'Maison',
                    'Local commercial'=>'Local commercial'
                ],
                'required'=>true,
                'data'=>'Appartement',
                'attr'=>[
                    'class'=>'typedebien'
                ],
                'label'=>false,
                'expanded'=> true,
            ])
            ->add('anneeconstruction', ChoiceType::class,[
                'choices'=>[
                    'Avant 1949'=>'Avant 1949',
                    'Entre 1949 et 1997'=>'Entre 1949 et 1997',
                    'Après 1997'=>'Après 1997'
                ],
                'required'=>true,
                'data'=>'Avant 1949',
                'attr'=>[
                    'class'=>'anneeconstruction'
                ],
                'label'=>false,
                'expanded'=> true,
            ])
            ->add('superficie',NumberType::class,[
                'label'=>false,
                'required'=>true,
            ])
            ->add('nom',TextType::class,[
                'label'=>false,
                'attr'=>[
                    'placeholder'=>'Votre nom',
                ]
            ])
            ->add('telephone',TelType::class,[
                'label'=>false,
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'Votre téléphone',
                ]
            ])
            ->add('email',EmailType::class,[
                'label'=>false,
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'Votre adresse mail',
                ]
            ])->add('message',TextType::class,[
                'label'=>false,

                'attr'=>[
                    'class'=>'message',
                    'id'=>'remarque',
                    'placeholder'=>'Vous avez une remarque, une question?',
                ]
            ])
            ->add('ville', TextType::class,[
                'label'=> false,
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'Votre ville',
                ]
            ])
            ->add('codepostal', TextType::class,[
                'label'=> false,
                'required'=>true,
                'attr'=>[
                    'placeholder'=>'Code postal',
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
