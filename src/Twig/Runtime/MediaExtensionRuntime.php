<?php

namespace App\Twig\Runtime;

use App\Entity\Media;
use Twig\Extension\RuntimeExtensionInterface;

class MediaExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    public function mediaUrl(Media $media): string
    {
        return sprintf('/uploads/%s', $media->getPath());
    }
}
