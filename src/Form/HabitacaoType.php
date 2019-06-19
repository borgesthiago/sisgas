<?php

namespace App\Form;

use App\Entity\Habitacao;
use App\Entity\Bairro;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class HabitacaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('endereco')
            ->add('bairro', null, array(
                'required'   => false,
            ))
            ->add('cidade', null, array(
                'required'   => false,
            ))
            ->add('cep', null, array(
                'required'   => false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Habitacao::class,
        ]);
    }
}
