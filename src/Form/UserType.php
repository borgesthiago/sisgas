<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\RolesEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            
            ->add('roles',  ChoiceType::class, array(
                'choices' => RolesEnum::getRoles(),
                'multiple' => true,
                'label' => 'Nível'
            ));
        $builder->add('password', PasswordType::class, array(
            'label' => 'Senha',
            'required' => false
        ));
        $builder->add('funcionario', null, [
            'required' => false
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
