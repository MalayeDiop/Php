<?php

namespace App\Form;

use App\Entity\ArticleEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref', TextType::class, [
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Référence',
                ],
                'label' => 'Référence',
        ])
            ->add('libelle', TextType::class, [
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Libelle',
                ],
                'label' => 'Libelle',
        ])
            ->add('qte_stock', TextType::class, [
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Qte Stock',
                ],
                'label' => 'Qte Stock',
        ])
            ->add('prix', TextType::class, [
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Prix',
                ],
                'label' => 'Prix',
        ])
            ->add('Save', SubmitType::class,[
                'attr' => [
                        'class' => 'mt-2 block w-20 px-4 py-2 border border-gray-300 rounded-md',
                    ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ArticleEntity::class,
        ]);
    }
}
