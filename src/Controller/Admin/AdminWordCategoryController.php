<?php

namespace App\Controller\Admin;

use App\Entity\WordCategory;
use App\Form\WordCategoryType;
use App\Repository\WordCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/word/category', name: 'admin_word_category_')]
class AdminWordCategoryController extends AbstractController
{
    public function __construct() {

    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(WordCategoryRepository $wordCategoryRepository): Response
    {
        return $this->render('admin/word_category/index.html.twig', [
            'categories' => $wordCategoryRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, WordCategoryRepository $wordCategoryRepository): Response
    {
        $wordCategory = new WordCategory();
        $form = $this->createForm(WordCategoryType::class, $wordCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wordCategoryRepository->save($wordCategory, true);

            return $this->redirectToRoute('admin_word_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/word_category/new.html.twig', [
            'wordCategory' => $wordCategory,
            'form' => $form,
        ]);
    }
}