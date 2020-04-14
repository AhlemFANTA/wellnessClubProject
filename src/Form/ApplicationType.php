<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;


class ApplicationType extends AbstractType
{
    /**
     * Permer d'avoir la configuration de base d'un champ
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    protected function getConfiguration($label, $placeholder)
    {
        return array_merge(
            [
                'label'=>$label,
                'attr' =>[
                    'placeholder' => $placeholder
                ]
            ])
            ;
    }
}