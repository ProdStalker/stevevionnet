<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class AutocompleteMediaType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Media::class,
            'label' => 'Medias',
            'choice_label' => 'name',
            'multiple' => true,
            'autocomplete' => true,
            'security' => function(Security $security): bool {
                return $security->isGranted('ROLE_TEST');
            }
        ]);
    }

    public function getParent(): string
    {
        return ParentEntityAutocompleteType::class;
    }
}