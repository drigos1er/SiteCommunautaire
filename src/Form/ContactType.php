<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends TricksType
{



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('firstname',TextType::class,$this->getConfiguration('Nom', 'Votre nom','form-control'))
            ->add('lastname',TextType::class, $this->getConfiguration('Prénoms', 'Votre prénoms','form-control'))
            ->add('email', EmailType::class,$this->getConfiguration('Email', 'Votre mail','form-control'))
            ->add('contact',TextType::class, $this->getConfiguration('Contact', 'Votre contact','form-control'))
            ->add('message', TextareaType::class,$this->getConfiguration('Mesage', 'Votre message','form-control'))


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
