<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/media', name: 'admin_media_')]
class AdminMediaController extends AbstractController
{
    public function __construct() {

    }

    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(MediaRepository $mediaRepository): Response
    {
        return $this->render('admin/media/index.html.twig', [
            'medias' => $mediaRepository->findAll(),
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

            $imageSize = getimagesize($uploadedFile->getRealPath());

            $media->setSize($uploadedFile->getSize())
                ->setMimeType($uploadedFile->getMimeType())
                ->setDimensions($imageSize[0].'x'.$imageSize[1]);

            $destination = $this->getParameter('kernel.project_dir').'/public/uploads';
            $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $newFilename = base64_encode($originalFilename).'-'.uniqid().'.'.$uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(
                $destination,
                $newFilename
            );


            $media->setPath($newFilename);

            $mediaRepository->save($media, true);

            return $this->redirectToRoute('admin_media_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/media/new.html.twig', [
            'media' => $media,
            'form' => $form,
        ]);
    }
}