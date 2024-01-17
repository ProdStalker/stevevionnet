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

        $half = 0;
        if (count($words) > 1) {
            $half = (int) (count($words)/2);
            $half = strpos($text, $words[$half]);
        }
        else {
            $half = strlen($text)/2;
        }

        $half = (int) $half;
        for ($i = 0; $i < $half; $i++) {
            $content .= $text[$i];
        }

        $content .= '<span class="white-text weight-600">';
        for ($i = $half; $i < strlen($text); $i++) {
            $content .= $text[$i];
        }

        $content .= '</span></p>';

        return $content;
    }
}
