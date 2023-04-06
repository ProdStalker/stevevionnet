<?php

namespace App\Twig\Components;

use App\Entity\Word;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('counter')]
final class CounterComponent
{
    public string $entity;
    public string $title = 'Counter';
    public string $url = '';

    public function __construct(private readonly EntityManagerInterface $entityManager) {

    }

    public function count(): int {
        return $this->entityManager->getRepository($this->entity)->count([]);
    }
}
