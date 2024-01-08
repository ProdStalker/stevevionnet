<?php

namespace App\Utils;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Psr\Cache\CacheItemInterface;

class ProjectUtil extends EntityUtil
{
    protected function getRepository(): ProjectRepository
    {
        return $this->em->getRepository(Project::class);
    }

    public function homepageProjects(): array
    {
        return $this->cache->get('homepage-projects', function (CacheItemInterface $item) {
            $item->expiresAfter(30);
            return $this->getRepository()->findHomepageProjects();
        });
    }
}