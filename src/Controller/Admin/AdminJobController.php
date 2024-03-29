<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use App\Form\JobType;
use App\Repository\JobRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/job', name: 'admin_job_')]
class AdminJobController extends AbstractController
{
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(JobRepository $jobRepository): Response
    {
        return $this->render('admin/job/index.html.twig', [
            'jobs' => $jobRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, JobRepository $jobRepository): Response
    {
        $job = new Job();
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $jobRepository->save($job, true);

            return $this->redirectToRoute('admin_job_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/job/new.html.twig', [
            'job' => $job,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Job $job): Response
    {
        return $this->render('admin/job/show.html.twig', [
            'job' => $job,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Job $job, JobRepository $jobRepository): Response
    {
        $form = $this->createForm(JobType::class, $job);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $jobRepository->save($job, true);

            return $this->redirectToRoute('admin_job_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/job/edit.html.twig', [
            'job' => $job,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Job $job, JobRepository $jobRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$job->getId(), $request->request->get('_token'))) {
            $jobRepository->remove($job, true);
        }

        return $this->redirectToRoute('admin_job_index', [], Response::HTTP_SEE_OTHER);
    }
}
