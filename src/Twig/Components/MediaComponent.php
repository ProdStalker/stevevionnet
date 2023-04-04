<?php

namespace App\Twig\Components;

use App\Entity\Media;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('media', 'components/media/media.html.twig')]
final class MediaComponent
{
    public Media $media;

    public function preview(): string{
        $path = sprintf('/uploads/%s', $this->media->getPath());

        return $path;
    }
}
