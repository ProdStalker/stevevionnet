<?php

namespace App\Form;

use App\Entity\Media;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Autocomplete\Form\AsEntityAutocompleteField;
use Symfony\UX\Autocomplete\Form\ParentEntityAutocompleteType;

#[AsEntityAutocompleteField]
class AutocompleteMediaType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['multiple'] = $options['multiple'] ?? true;
        $view->vars['label'] = $options['label'] ?? 'Medias';
    }

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