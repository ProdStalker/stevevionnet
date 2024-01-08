<?php

namespace App\Twig\Components\Media;

use App\Entity\Media;
use App\Enums\MediaType;
use App\MediaUtil;
use App\Repository\MediaRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('gallery', 'components/media/gallery.html.twig')]
final class GalleryComponent
{
    public array $filters = [
        MediaType::Image,
        MediaType::Pdf,
        MediaType::Video
    ];

    public array $mediasList = [];
    public bool $canEdit = false;

    public function __construct(private readonly MediaUtil $mediaUtil){

    }

    public function medias(): Collection|array{
        if (!empty($this->mediasList)) {
            return $this->mediasList;
        }
        return $this->mediaUtil->mediasFiltered($this->filters);
    }
}
