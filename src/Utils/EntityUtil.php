<?php

namespace App\Utils;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\CacheInterface;

abstract class EntityUtil
{
    public function __construct(protected readonly EntityManagerInterface $em, protected readonly CacheInterface $cache)
    {

    }

    abstract protected function getRepository(): ServiceEntityRepository;
}