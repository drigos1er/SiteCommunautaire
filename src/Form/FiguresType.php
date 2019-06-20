<?php

namespace App\Form;

use App\Entity\Figures;
use App\Entity\GroupFigures;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiguresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('groupfigures', EntityType::class, [
                'class' => GroupFigures::class,
                'choice_label' => 'name'
            ])

            ->add('mediaimage', CollectionType::class, array(
                'entry_type' => MediaImageType::class,
                'allow_add' => true

            ))

            ->add('mediavideo', CollectionType::class, array(
                'entry_type' => MediaVideoType::class,
                'allow_add' => true

            ))


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Figures::class,
        ]);
    }
}
