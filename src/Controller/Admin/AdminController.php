<?php

namespace App\Controller\Admin;

use App\Dto\CounterDTO;
use App\Entity\Client;
use App\Entity\Job;
use App\Entity\Media;
use App\Entity\Project;
use App\Entity\Tag;
use App\Entity\User;
use App\Entity\Word;
use App\Entity\WordCategory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

#[Route('/admin', name: 'admin_')]
class AdminController extends AbstractController
{
    public function __construct() {

    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        $counters = [
            new CounterDTO('Client', Client::class, $this->generateUrl('admin_client_index')),
            new CounterDTO('Jobs', Job::class, $this->generateUrl('admin_job_index')),
            new CounterDTO('Medias', Media::class, $this->generateUrl('admin_media_index')),
            new CounterDTO('Projects', Project::class, $this->generateUrl('admin_project_index')),
            new CounterDTO('Tags', Tag::class, $this->generateUrl('admin_tag_index')),
            new CounterDTO('Users', User::class),
            new CounterDTO('Words', Word::class, $this->generateUrl('admin_word_index')),
            new CounterDTO('Words Categories', WordCategory::class, $this->generateUrl('admin_word_category_index')),
        ];

        return $this->render('admin/index.html.twig', [
            'counters' => $counters
        ]);
    }

}