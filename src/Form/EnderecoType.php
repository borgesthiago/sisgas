<?php

namespace App\Form;

use App\Entity\Bairro;
use App\Entity\Endereco;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EnderecoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('logradouro')
            ->add('numero', null, [
                'label' => 'Complemento'
            ])
            ->add('cep')
            ->add('bairro', EntityType::class, [
                'class' => Bairro::class,
                'placeholder' => 'Selecione o Bairro'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Endereco::class,
        ]);
    }
}