<?php

namespace App;

use App\Entity\Media;
use App\Enums\MediaType;
use App\Repository\MediaRepository;

class MediaUtil
{
    public function __construct(private readonly MediaRepository $mediaRepository) {

    }

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

    public function mediasFiltered(array $filters = [])
    {
        $finalFilters = [];

        foreach($filters as $mediaType) {
            $finalFilters = array_merge($finalFilters, $this->mimeTypeForMediaType($mediaType));
        }

        return $this->mediaRepository->mediasFiltered($finalFilters);
    }

    public function mimeTypeForMediaType(MediaType $mediaType): array
    {
        $mimes = [];

        switch($mediaType) {
            case MediaType::Image:
                $mimes = [
                    'image/jpeg',
                    'image/png',
                    'image/svg+xml'
                ];
            break;
            case MediaType::Pdf:
                $mimes = [
                    'application/pdf'
                ];
            break;
            case MediaType::Video:
                $mimes = [

                ];
            break;
            default:
            break;
        }

        return $mimes;
    }

    public function isSupported(string $mimeType): bool
    {
        $mimeTypesSupported = array_merge(
            $this->mimeTypeForMediaType(MediaType::Image),
            $this->mimeTypeForMediaType(MediaType::Pdf),
            $this->mimeTypeForMediaType(MediaType::Video),
        );

        return in_array($mimeType, $mimeTypesSupported);
    }

}