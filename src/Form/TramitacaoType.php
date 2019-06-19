<?php

namespace App\Form;

use App\Entity\Status;
use App\Entity\Secretaria;
use App\Entity\Tramitacao;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TramitacaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'dataInicio',
                HiddenType::class
            )
            ->add(
                'dataFim',
                HiddenType::class
            )
            ->add(
                'observacao',
                TextareaType::class,
                [
                    'required' => false
                ]
            )
            ->add(
                'origem',
                EntityType::class,
                [
                    'class' => Secretaria::class,
                    'choice_label' => 'nome',
                    'attr' => [
                        'readonly' => true
                    ]
                ]
            )
            ->add(
                'funcionarioOrigem',
                null, [
                    'label' => 'Funcionário Origem',
                    'attr' => [
                        'readonly' => true
                    ]
                ]
            )
            ->add(
                'funcionarioDestino',
                HiddenType::class
            )
            ->add(
                'destino',
                EntityType::class,
                [
                    'class' => Secretaria::class,
                    'choice_label' => 'nome',
                    'placeholder' => 'Selecione o Destino',
                    'required' =>  true
                ]
            )
            ->add(
                'documento',
                null, [
                    'label' => 'Nº Documento',
                    'attr' => [
                        'readonly' => true
                    ]
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tramitacao::class,
        ]);
    }
}
