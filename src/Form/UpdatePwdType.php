<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\TricksType;

/**
 * Formulaire de Modification de mot de passe
 * Class UpdatePwdType
 * @package App\Form
 */
class UpdatePwdType extends TricksType
{



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'oldpwd',
                PasswordType::class,
                $this->getConfiguration('Mot de Passe actuel', 'Mot de passe actuel', 'form-control')
            )
            ->add(
                'newpwd',
                PasswordType::class,
                $this->getConfiguration(
                    'Nouveau Mot de Passe',
                    ' Nouveau Mot de passe ',
                    'form-control'
                )
            )
            ->add(
                'confirmpwd',
                PasswordType::class,
                $this->getConfiguration(
                    'Confirmer Mot de passe',
                    'Confirmer Mot de passe',
                    'form-control'
                )
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
