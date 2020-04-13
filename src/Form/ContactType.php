<?php
namespace App\Form;

use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('firstName', TextType::class,$this->getConfiguration("Nom", "Votre prénom..."))
        ->add('subject', TextType::class,$this->getConfiguration("Object", "Votre Object..."))
        ->add('from', EmailType::class,$this->getConfiguration("E-mail", "Votre mail..."))
        ->add('message', TextareaType::class,$this->getConfiguration("Message", "Votre message..."))


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}