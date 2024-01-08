<?php

namespace App\Controller;

use App\Entity\Project;
use App\Utils\ProjectUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProjectUtil $projectUtil): Response
    {
        /**
         * @var Project[] $projects
         */
        $projects = $projectUtil->homepageProjects();

        return $this->render('default/index.html.twig', [
            'categoryName' => 'Programming',
            'projects' => $projects
        ]);
    }
}
