<?php

namespace App\Form;

use App\Entity\Usuario;
use App\Entity\Endereco;
use App\Form\EnderecoType;
use App\Form\Type\CpfType;
use App\Enum\EscolaridadeEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', null, [
                'label' => 'Nome Completo',
            ])
            ->add('cpf', CpfType::class, [
                'label' => 'CPF',
                'required' => false
            ])
            ->add('rg', null, [
                'label' => 'RG',
            ])
            ->add('orgaoRg', null, [
                'label' => 'Órgão',
            ])
            ->add('dataNascimento', DateType::class, array(
                'widget' => 'single_text',
                'label' => 'Data Nascimento',
                'format' => 'yyyy-MM-dd',
                'required' => false
            ))
            ->add('email', null, [
                'label' => 'E-mail',
            ])
            ->add('sexo', ChoiceType::class, [
                'label' => 'Sexo',
                'choices'  => [
                    'F' => 'F',
                    'M' => 'M',
                ],
            ])
            ->add('pcd', ChoiceType::class, [
                'label' => 'PCD ?',
                'choices'  => [
                    'Não' => false,
                    'Sim' => true,
                ],
            ])
            ->add('naturalidade', null, [
                'label' => 'Naturalidade',
            ])
            ->add('profissao', null, [
                'label' => 'Profissão',
            ])
            ->add('ocupacao', null, [
                'label' => 'Ocupação',
            ])
            ->add('renda', null, [
               
                'label' => 'Renda',
            ])
            ->add('ctps', null, [
                'label' => 'CTPS',
            ])
            ->add('serieCtps', null, [
                'label' => 'Nº Série',
            ])
            ->add('escolaridade', ChoiceType::class, [
                'choices' => array_flip(EscolaridadeEnum::getEscolaridade()),
                'label' => 'Escolaridade',
            ])
            ->add('nis', null, [
                'label' => 'NIS',
            ])
            ->add(
                'endereco',
                EnderecoType::class,
                [
                    'label' => 'Endereço'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
