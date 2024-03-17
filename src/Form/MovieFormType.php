<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Movie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MovieFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block mb-8  mx-auto border-b-2 w-2/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Enter movie title...',
                ),
                'label' => false,
                'required' => false,
            ])
            ->add('releaseYear', IntegerType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block mb-8 mx-auto border-b-2 w-2/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Enter release year...',
                ),
                'label' => false,
                'required' => false,
            ])
            ->add('rating', IntegerType::class, [
                'attr' => array(
                    'class' => 'bg-transparent block mb-8 mx-auto border-b-2 w-2/5 h-20 text-2xl outline-none',
                    'placeholder' => 'Enter rating 5-10...',
                ),
                'label' => false,
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'attr' => array(
                    'class' => 'h-80 mb-12 block bg-transparent mb-8 mx-auto border-b-2 w-4/5 text-md outline-none',
                    'placeholder' => 'Enter your review...',
                ),
                'label' => false,
                'required' => false,
            ])
            ->add('imagePath', FileType::class, [
                'attr' => array(
                    'class' => 'border rounded-md py-2 px-4 w-full mt-2',
                ),
                'required' => false,
                'mapped' => false,
                'label' => 'Thumbnail',
            ])

            // ->add('actors', EntityType::class, [
            //     'class' => Actor::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
