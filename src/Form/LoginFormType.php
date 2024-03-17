<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'bg-transparent block mt-8 mx-auto border-b-2 w-2/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Email',
                    'autocomplete' => 'email',
                    'autofocus' => true,
                ],
            ])
            ->add('password', PasswordType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'class' => 'bg-transparent block mt-8 mx-auto border-b-2 w-2/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Password',
                    'autocomplete' => 'current-password',
                ],
            ])
            ->add('remember_me', CheckboxType::class, [
                'label' => 'Remember me',
                'required' => false,
                'attr' => [
                    'class' => 'checkbox mt-8',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}