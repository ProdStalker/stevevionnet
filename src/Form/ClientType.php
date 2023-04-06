<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Media;
use App\MediaUtil;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function __construct(private readonly MediaUtil $mediaUtil)
    {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('logo', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'data_class' => Media::class,
                'choice_label' => 'name',
                'choices' => $this->getChoices(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }

    private function getChoices()
    {
        return $this->mediaUtil->mediasFiltered([
            \App\Enums\MediaType::Image
        ]);
    }
}
