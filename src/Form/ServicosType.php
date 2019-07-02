<?php

namespace App\Form;

use App\Entity\Servicos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ServicosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add(
                'status',
                ChoiceType::class,
                [
                    'required' => false,
                    'label' => 'Status',
                    'choices'  => array(
                        'Ativo' => true,
                        'Inativo' => false
                    )
                ]
            )
            ->add('secretarias')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Servicos::class,
        ]);
    }
}
