<?php

namespace App\Controller;

use App\Entity\Project;
use App\Utils\ProjectUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TagController extends AbstractController
{
    #[Route('/tag/{slug}', name: 'tag')]
    public function index(string $slug, ProjectUtil $projectUtil): Response
    {
        /**
         * @var Project[] $projects
         */
        $projects = $projectUtil->projectsByTag($slug);

        return $this->render('tag/index.html.twig', [
            'projects' => $projects
        ]);
    }
}
