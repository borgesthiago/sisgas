<?php

namespace App\Form;

use App\Entity\Tramitacao;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TramitacaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dataInicio')
            ->add('dataFim')
            ->add('observacao')
            ->add('origem')
            ->add('funcionarioOrigem')
            ->add('funcionarioDestino')
            ->add('destino')
            ->add('status')
            ->add('documento')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tramitacao::class,
        ]);
    }
}
