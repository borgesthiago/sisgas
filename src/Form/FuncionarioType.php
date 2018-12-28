<?php

namespace App\Form;

use App\Entity\Funcionario;
use App\Entity\Secretaria;
use App\Entity\Remuneracao;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Form\Type\CpfType;

class FuncionarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('matricula')
            ->add('cpf', CpfType::class, [
                'required' => false
            ])
            ->add('endereco')
            ->add('secretaria', EntityType::class, [
                'class' => Secretaria::class,
                'choice_label' => 'nome',
                'placeholder' => 'Selecione'
                ])                              
        ;
        $builder->add('admissao', DateType::class, array(
            'widget' => 'single_text',
            'label' => 'Admissão',
            // this is actually the default format for single_text
            'format' => 'yyyy-MM-dd',
            'required' => false
        ));
        $builder->add('exoneracao', DateType::class, array(
            'widget' => 'single_text',
            'label' => 'Exoneração',
            // this is actually the default format for single_text
            'format' => 'yyyy-MM-dd',
            'required' => false
        ));
        $builder->add('status', ChoiceType::class, array(
            'choices'  => array(
                'Ativo'    =>1,
                'Inativo' =>0
            )))
        ;
        $builder->add('tipo', ChoiceType::class, array(
            'choices'  => array(
                'Estatutário'    => 'Estatutário',
                'Comissionado' => 'Comissionado'
            )))
        ;
        // $builder->add('user', UserType::class);
         $builder->add('contato', ContatoType::class);
         $builder->add('remuneracao', RemuneracaoType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Funcionario::class,
        ]);
    }
}
