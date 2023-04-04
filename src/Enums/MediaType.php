<?php

namespace App\Enums;

enum MediaType: string {
    case Image = 'Image';
    case Pdf = 'PDF';
    case Video = 'Video';
    case Unsupported = 'Unsupported';
}