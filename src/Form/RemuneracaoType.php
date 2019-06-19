<?php

namespace App\Form;
use App\Entity\Remuneracao;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RemuneracaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('salario', null, array(
                'required'   => false,
                'label' => 'Salário',
            ))
            ->add('gratificacao', null, array(
                'required'   => false,
                'label' => 'Gratificação',
            ))
            ->add('desconto')
            //->add('funcionario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Remuneracao::class,
        ]);
    }
}
