<?php

namespace App\Form;

use App\Entity\AuthenticatedUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Formulaire du Profil
 * Class ProfileType
 * @package App\Form
 */
class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstname')
            ->add('lastname')

            ->add('contact')

            ->add('picture', FileType::class, [
                'required'=>false,
                'label'=>'Image de Profile',
                'data_class' => null ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AuthenticatedUser::class,
        ]);
    }
}
