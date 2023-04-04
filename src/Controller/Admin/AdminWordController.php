<?php

namespace App\Controller\Admin;

use App\Entity\Word;
use App\Form\WordType;
use App\Repository\WordRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/word', name: 'admin_word_')]
class AdminWordController extends AbstractController
{
    public function __construct() {

    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Word $word, WordRepository $wordRepository): Response
    {
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wordRepository->save($word, true);

            return $this->redirectToRoute('admin_word_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/word/edit.html.twig', [
            'word' => $word,
            'form' => $form,
        ]);
    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(WordRepository $wordRepository): Response
    {
        return $this->render('admin/word/index.html.twig', [
            'words' => $wordRepository->findAll()
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, WordRepository $wordRepository): Response
    {
        $word = new Word();
        $form = $this->createForm(WordType::class, $word);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $wordRepository->save($word, true);

            return $this->redirectToRoute('admin_word_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/word/new.html.twig', [
            'word' => $word,
            'form' => $form,
        ]);
    }
}