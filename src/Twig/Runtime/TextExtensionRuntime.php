<?php

namespace App\Twig\Runtime;

use App\Entity\Media;
use App\MediaUtil;
use Twig\Extension\RuntimeExtensionInterface;

class TextExtensionRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    public function doubleColorText(string $text): string
    {
        $words = explode(' ', $text);
        $content = '<p class="short-description weight-300">';

        $half = floor(count($words)/2);
        for ($i = 0; $i < $half; $i++) {
            $content .= $words[$i].' ';
        }

        $content .= '<span class="white-text weight-600">';
        for ($i = $half; $i < count($words); $i++) {
            $content .= $words[$i].' ';
        }

        $content .= '</span></p>';

        return $content;
    }
}
