<?php

namespace App\Form;

use App\Entity\Project;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('onHomepage', CheckboxType::class, [
            ])
            ->add('detail', DetailType::class,[
            ])
            ->add('tags', AutocompleteTagType::class)
            ->add('medias', AutocompleteMediaType::class)
            ->add('cover', AutocompleteMediaType::class, [
                'multiple' => false,
                'label' => "Cover"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
