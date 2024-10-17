<?php

namespace App\Form;

use App\Entity\ClientEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'nom',
                ],
                'label' => 'nom',
        ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'prenom',
                ],
                'label' => 'prenom',
        ])
            ->add('telephone', TextType::class, [
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Téléphone',
                ],
                'label' => 'Téléphone',
        ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Adresse',
                ],
                'label' => 'Adresse',
        ])
            ->add('Save', SubmitType::class,[
            'attr' => [
                    'class' => 'mt-2 block w-20 px-4 py-2 border border-gray-300 rounded-md',
                ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ClientEntity::class,
        ]);
    }
}
