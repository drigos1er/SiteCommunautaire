<?php

namespace App\Form;

use App\Entity\AuthenticatedUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire de Création d'utilisateurs
 * Class RegistrationType
 * @package App\Form
 */
class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('contact', TextType::class)
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class)
            ->add('picture', FileType::class, [
                'required'=>false])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AuthenticatedUser::class,
        ]);
    }
}
