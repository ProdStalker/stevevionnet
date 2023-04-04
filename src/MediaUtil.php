<?php

namespace App;

use App\Entity\Media;
use App\Enums\MediaType;

class MediaUtil
{

    public function getType(Media $media): MediaType {
        if ($this->isImage($media)) {
            return MediaType::Image;
        }
        elseif ($this->isVideo($media)){
            return MediaType::Video;
        }
        elseif ($this->isPdf($media)) {
            return MediaType::Pdf;
        }

        return MediaType::Unsupported;
    }

    public function isImage(Media $media): bool {
        return preg_match_all('/^image/', $media->getMimeType()) !== 0;
    }

    public function isPdf(Media $media): bool {
        return preg_match_all('/^application\/pdf/', $media->getMimeType()) !== 0;
    }

    public function isVideo(Media $media): bool {
        return preg_match_all('/^video/', $media->getMimeType()) !== 0;
    }

}