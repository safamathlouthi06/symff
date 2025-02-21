<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateD', null, [
                'widget' => 'single_text'
            ])
            ->add('dateF', null, [
                'widget' => 'single_text'
            ])
            ->add('lieu')
            ->add('nom')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'id'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
