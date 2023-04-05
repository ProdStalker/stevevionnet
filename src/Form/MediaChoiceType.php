<?php

namespace App\Form;

use App\Entity\Media;
use App\MediaUtil;
use App\Repository\MediaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediaChoiceType extends AbstractType
{
    public function __construct(private readonly MediaUtil $mediaUtil) {

    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('medias', ChoiceType::class, [
                'multiple' => true,
                'choice_label' => 'path',
                'expanded' => true,
                'choices' => $this->getChoices($options['types'])
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Media::class,
            'multiple' => true,
            'types' => [
                \App\Enums\MediaType::Image,
                \App\Enums\MediaType::Pdf,
                \App\Enums\MediaType::Video,
            ]
        ]);
    }

    private function getChoices(array $types = [])
    {
        $medias = $this->mediaUtil->mediasFiltered($types);

        return $medias;
    }
}