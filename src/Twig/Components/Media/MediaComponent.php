<?php

namespace App\Twig\Components\Media;

use App\Entity\Media;
use App\MediaUtil;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('media', 'components/media/media.html.twig')]
final class MediaComponent
{
    public Media $media;

    public function __construct(private readonly MediaUtil $mediaUtil){

    }

    public function isImage(): bool{
        return $this->mediaUtil->isImage($this->media);
    }

    public function isVideo(): bool{
        return $this->mediaUtil->isVideo($this->media);
    }

    public function isPdf(): bool{
        return $this->mediaUtil->isPdf($this->media);
    }

    public function preview(): string{
        return $this->mediaUtil->mediaUrl($this->media);
    }
}
