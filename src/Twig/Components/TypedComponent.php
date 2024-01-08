<?php

namespace App\Twig\Components;

use App\Entity\Media;
use App\Enums\MediaType;
use App\MediaUtil;
use App\Repository\MediaRepository;
use App\Repository\WordCategoryRepository;
use App\Repository\WordRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('typed', 'components/typed.html.twig')]
final class TypedComponent
{
    public array $wordsList = [];
    public bool $loop = true;
    public string $style = '';
    public array $categoriesName = [];
    public int $backDelay = 1000;


    public function __construct(private readonly WordRepository $wordRepository){

    }

    public function words(): Collection|array{
        if (!empty($this->wordsList)) {
            return $this->wordsList;
        }

        $wordsData = empty($this->categoriesName) ? $this->wordRepository->findAll() : $this->wordRepository->findByCategories($this->categoriesName);

        $words = [];

        foreach($wordsData as $word){
            $words[] = $word->getName();
        }

        shuffle($words);

        return $words;
    }
}
