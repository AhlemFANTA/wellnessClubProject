<?php

namespace App\Form;

use App\Entity\Task;
use App\Entity\Comment;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class CommentType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Prenom', TextType::class,$this->getConfiguration("Prénom", "Votre prénom..."))
            ->add('Nom', TextType::class,$this->getConfiguration("Nom", "Votre Object..."))
            ->add('email', EmailType::class,$this->getConfiguration("E-mail", "Votre Email "))
            ->add('rating', IntegerType::class,$this->getConfiguration("Note sur 5",  "Veuillez indiquer votre note de 0 à 5 ",[
                'attr' => [
                    'min' => 0,
                    'max' => 5,
                    'step' => 1
                ]
            ] ))
            ->add('content', TextareaType::class,$this->getConfiguration("Contenu", "Votre commentaire..."))
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}