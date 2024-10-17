<?php

namespace App\Form;

use App\Entity\ClientEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use \Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Entrez le nom',
                    // 'pattern' => '^([77|76|78|70])[0-9]{7}$',
                ],
                'label' => 'Nom',
        ])
            ->add('prenom', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Entrez le prénom',
                ],
                'label' => 'Prenom',
        ])
            ->add('telephone', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Entrez le numéro de téléphone',
                ],
                'label' => 'Téléphone',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un numéro valable',
                    ]),
                    new NotNull([
                        'message' => 'Ce champ ne peut pas être nul',
                    ]),
                    new Regex(
                        '/^(77|76|78|70)([0-9]{7})$/',
                        'Ce numéro est invalide',
                    ),
                ],
        ])
            ->add('adresse', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'mt-2 block w-1/4 px-4 py-2 border border-gray-300 rounded-md shadow-sm sm:text-sm',
                    'placeholder' => 'Quel est votre adresse ?',
                ],
                'label' => 'Adresse',
        ])
            ->add('Save', SubmitType::class,[
            'attr' => [
                    'class' => 'w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600',
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
