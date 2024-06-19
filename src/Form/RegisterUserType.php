<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'attr' => [
                    'placeholder' => "Veuillez renseigner votre email. !"
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                    new Length([
                        'min' => 4,
                        'max' => 50,
                    ])
                ],
                'first_options'  => ['label' => 'Veuillez renseigner votre mdp.', 'hash_property_path' => 'password'],
                'second_options' => ['label' => 'Veuillez ressaisir votre mdp'],
                'mapped' => false,
            ])

            ->add('firstname', TextType::class,[
                'attr' => [
                'placeholder' => "Veuillez renseigner votre prénom. !"
            ]
        ])
            ->add('lastname', TextType::class,[
                'attr' => [
                'placeholder' => "Veuillez renseigner votre nom. !"
            ]
        ])
            ->add('submit', SubmitType::class,
            [
                'label' => "Valider",
                'attr' => [
                    'class' => 'btn btn-success'
                ]
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
