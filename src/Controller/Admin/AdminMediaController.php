<?php

namespace App\Controller\Admin;

use App\Entity\Job;
use App\Entity\Media;
use App\Form\JobType;
use App\Form\MediaType;
use App\MediaUtil;
use App\Repository\JobRepository;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/media', name: 'admin_media_')]
class AdminMediaController extends AbstractController
{
    public function __construct(private readonly MediaUtil $mediaUtil) {

    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('admin/media/index.html.twig', [
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, MediaRepository $mediaRepository): Response
    {
        $media = new Media();
        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $form['path']->getData();

            if ($this->mediaUtil->isSupported($uploadedFile->getMimeType())) {
                $media->setSize($uploadedFile->getSize())
                    ->setMimeType($uploadedFile->getMimeType());

                if ($this->mediaUtil->isImage($media)) {
                    $imageSize = getimagesize($uploadedFile->getRealPath());
                    $media->setDimensions($imageSize[0] . 'x' . $imageSize[1]);
                }

                $destination = $this->getParameter('kernel.project_dir') . '/public/uploads';
                $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = base64_encode($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
                $uploadedFile->move(
                    $destination,
                    $newFilename
                );

                $media->setPath($newFilename);

                $mediaRepository->save($media, true);

                return $this->redirectToRoute('admin_media_index', [], Response::HTTP_SEE_OTHER);
            }
            else {
                $this->addFlash('error', 'The mime type '.$uploadedFile->getMimeType().' is not supported');
            }
        }

        return $this->render('admin/media/new.html.twig', [
            'media' => $media,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Media $media, MediaRepository $mediaRepository): Response
    {
        $form = $this->createForm(MediaType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mediaRepository->save($media, true);

            return $this->redirectToRoute('admin_media_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/media/edit.html.twig', [
            'media' => $media,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Media $media, MediaRepository $mediaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$media->getId(), $request->request->get('_token'))) {
            $mediaRepository->remove($media, true);
        }

        return $this->redirectToRoute('admin_media_index', [], Response::HTTP_SEE_OTHER);
    }
}