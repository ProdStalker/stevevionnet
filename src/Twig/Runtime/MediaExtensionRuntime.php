<?php

namespace App\Twig\Runtime;

use App\Entity\Media;
use App\MediaUtil;
use Twig\Extension\RuntimeExtensionInterface;

class MediaExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct(private readonly MediaUtil $mediaUtil)
    {
        // Inject dependencies if needed
    }

    public function mediaUrl(Media $media): string
    {
        return $this->mediaUtil->mediaUrl($media);
    }
}
