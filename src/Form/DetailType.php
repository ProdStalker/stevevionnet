<?php

namespace App\Form;

use App\Entity\Embeddable\Detail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('startAt', DateType::class, [
                'required' => true,
                'years' => range(1990, date('Y')),
                'months' => range(date('m'), 12),
                'days' => range(date('d'), 31),
            ])
            ->add('endAt', DateType::class, [
                'required' => false,
                'years' => range(1990, date('Y')),
                'months' => range(date('m'), 12),
                'days' => range(date('d'), 31),
            ])
            ->add('title', TextType::class, [
                'required' => true
            ])
            ->add('shortDescription', TextType::class, [
                'required' => true
            ])
            ->add('description', TextareaType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Detail::class,
        ]);
    }
}
