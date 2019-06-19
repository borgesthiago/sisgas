<?php

namespace App\Form;

use App\Entity\Secretaria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SecretariaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('endereco', null, array(
                'label' => 'Endereço'
            ))
            ->add('telefone')
            ->add('email')
            ->add('secretariaPai', null, array(
                'label' => 'Secretaria Responsável'
            ))
            ->add('equipamento',  ChoiceType::class, array(
                'required' => false,
                'label' => 'Equipamento',
                'choices'  => array(
                    'Não'  =>0,
                    'Sim' =>1
            )))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Secretaria::class,
        ]);
    }
}
