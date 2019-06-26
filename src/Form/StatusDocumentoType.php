<?php

namespace App\Form;

use App\Entity\Status;
use App\Entity\StatusDocumento;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StatusDocumentoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'status',
                EntityType::class,
                [
                    'class' => Status::class,
                    'choice_label' => 'descricao',
                    'placeholder' => 'Selecione'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => StatusDocumento::class,
        ]);
    }
}
