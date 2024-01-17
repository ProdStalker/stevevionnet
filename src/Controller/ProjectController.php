<?php

namespace App\Controller;

use App\Entity\Project;
use App\Utils\ProjectUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    #[Route('/p/{slug}', name: 'project_detail')]
    public function index(string $slug, ProjectUtil $projectUtil): Response
    {
        /**
         * @var Project $project
         */
        $project = $projectUtil->projectBySlug($slug);

        if ($project == null) {
            $this->createNotFoundException('Project not found');
        }

        return $this->render('project/detail.html.twig', [
            'project' => $project
        ]);
    }
}
