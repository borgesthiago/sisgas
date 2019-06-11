<?php

namespace App\Form;

use App\Entity\Funcionario;
use App\Entity\Secretaria;
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
            ->add('matricula', null, array(
                'required'   => false,
                'label' => 'Matrícula',
            ))
            ->add('cpf', CpfType::class, [
                'required' => false
            ])            
            ->add('cargo')
            ->add('funcao', null, array(
                'required'   => false,
                'label' => 'Função',
            ))
            ->add('rg')
            ->add('orgaoRg', null, array(
                'required'   => false,
                'label' => 'Órgão do RG',
            ))
            ->add('rgProfissao', null, array(
                'required'   => false,
                'label' => 'Registro Profissional',
            ))
            ->add('orgaoRgProfissao', null, array(
                'required'   => false,
                'label' => 'Órgão do Registro',
            ))
            ->add('coordenador', ChoiceType::class, array(
                'choices'  => array(
                    'Não'  =>0,
                    'Sim' =>1
                )))
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
            'label' => 'Vínculo',
            'choices'  => array(
                'Estatutário'    => 'Estatutário',
                'Comissionado' => 'Comissionado'
            )))
        ;
        // $builder->add('user', UserType::class);
         $builder->add('contato', ContatoType::class);
         $builder->add('remuneracao', RemuneracaoType::class);
         $builder->add('habitacao', HabitacaoType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Funcionario::class,
        ]);
    }
}
