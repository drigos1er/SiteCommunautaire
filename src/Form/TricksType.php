<?php

namespace App\Form;

use App\Entity\Tricks;
use App\Entity\TricksGroup;
use App\Entity\Image;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TricksType extends AbstractType
{

    /**
     * Methode de configuration de champs de formulaire
     * @param  String $label
     * @param String $placeholder
     * @return array
     */
    public function getConfiguration($label, $placeholder, $class)
    {
        return [
            'label'=>$label,
            'attr'=> [
                'placeholder'=>$placeholder,
                'class'=>$class

            ]

        ];
    }

    /**
     * Formulaire de création de Figures
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration('Nom', 'Nom de la figure', 'form-control'))
            ->add(
                'description',
                TextType::class,
                $this->getConfiguration('Description', 'Description de la figure', 'form-control')
            )
            ->add('tricksgroup', EntityType::class, [
                'class' => TricksGroup::class,
                'label'=>'Groupe de figure',
                'placeholder'=>'--- Choisir un groupe ---',

                'choice_label' => 'name',
                'attr'=> [

                    'class'=>'form-control'

                ]


            ])


           ->add('image', CollectionType::class, [
               'entry_type' => ImageType::class,
               'allow_add' => true,
               'allow_delete' => true,
               'label'=>false,
           ])



            ->add('video', CollectionType::class, [
                'entry_type' => VideoType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'label'=>false,
            ])

        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class,
        ]);
    }




}
