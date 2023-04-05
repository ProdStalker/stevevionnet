<?php

namespace App\Form;

use App\Entity\Tag;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class AutocompleteTagType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => Tag::class,
            'label' => 'Tags',
            'choice_label' => 'name',
            'multiple' => true,
            'constraints' => [
                new Count(min: 1, minMessage: 'Need minimum 1 tag'),
            ],
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