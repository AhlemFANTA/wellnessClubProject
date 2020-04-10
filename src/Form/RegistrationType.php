<?php

namespace App\Form;

use App\Entity\User;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends ApplicationType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,$this->getConfiguration("Prénom", "Votre prénom..."))
            ->add('lastName', TextType::class,$this->getConfiguration("Nom", "nom de famille..."))
            ->add('email', EmailType::class,$this->getConfiguration("Email", "Votre adresse mail..."))
            ->add('hash', PasswordType::class,$this->getConfiguration("Mot de passe", "Choisissez un bon mot de passe..."))
            ->add('passwordConfirm', PasswordType::class,$this->getConfiguration("Confirmation Mot de passe", "Veuillez confirmez votre mot de passe..."))
          //  ->add('instroduction', TextType::class,$this->getConfiguration("Introduction ", "Presentez vous en quelque mot..."))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
