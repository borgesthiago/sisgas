<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Secretaria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            
            ->add('roles',  ChoiceType::class, array(
                'choices' => ['Administrador' => '["ROLE_SUPER_ADMIN"]', 'Gerente' => 'ROLE_ADMIN', 'Operador' => 'ROLE_USER'],                
                'multiple' => true,
                'label' => 'Nível'
            ));
        $builder->add('password', PasswordType::class, array(
            'label' => 'Senha',
            'required' => false
        ));
        $builder->add('funcionario', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
