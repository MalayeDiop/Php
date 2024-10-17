<?php

namespace App\Form;

use App\Entity\DetteEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Entrez le montant',
                ],
                'label' => 'Montant',
        ])
            ->add('montantverse', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Entrez le montant versé',
                ],
                'label' => 'Montant versé',
        ])
            ->add('montantrestant', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Entrez le montant restant',
                ],
                'label' => 'Montant restant',
        ])
            ->add('Save', SubmitType::class,[
                'attr' => [
                        'class' => 'w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600',
                    ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetteEntity::class,
        ]);
    }
}
