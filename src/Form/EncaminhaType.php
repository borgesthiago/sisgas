<?php

namespace App\Form;

use App\Entity\Documento;
use App\Entity\Secretaria;
use App\Enum\TipoDocumentoEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class EncaminhaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'tipo',
                ChoiceType::class,
                [
                    'choices' => array_flip(TipoDocumentoEnum::getTipo()),
                    'label' => 'Tipo',
                    'placeholder' => 'Selecione',
                    'attr' => [
                        'readonly' => true,
                    ]
                ]
            )
            ->add(
                'numero',
                null,
                [
                    'label' => 'Número',
                    'attr' => [
                        'readonly' => true,
                    ]
                ]
            )
            ->add(
                'dataRecebido',
                DateType::class,
                [
                'widget' => 'single_text',
                'label' => 'Data Recebido',
                'format' => 'yyyy-MM-dd',
                'required' => false,
                'attr' => [
                    'readonly' => true,
                ]
                ]
            )
            ->add(
                'prazo',
                null,
                [
                    'label' => 'Prazo em dias',
                    'attr' => [
                        'readonly' => true,
                    ]
                ]
            )
            ->add(
                'reiteracao',
                ChoiceType::class,
                [
                    'label' => 'Reiteração ?',
                    'choices'  => [
                        'Selecione' => null,
                        'Sim' => true,
                        'Não' => false,
                    ],
                    'attr' => [
                        'readonly' => true,
                    ]
                ]
            )
            ->add(
                'origem',
                EntityType::class,
                [
                    'class' => Secretaria::class,
                    'choice_label' => 'nome',
                    'placeholder' => 'Selecione',
                    'label' => 'Destino',
                ]
            )             
            ->add(
                'numero_reiteracao',
                HiddenType::class          
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
            'data_class' => Documento::class,
            ]
        );
    }
}
