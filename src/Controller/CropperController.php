<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Cropperjs\Factory\CropperInterface;
use Symfony\UX\Cropperjs\Form\CropperType;

class CropperController extends AbstractController
{
    #[Route('/cropper', name: 'cropper')]
    public function index(CropperInterface $cropper, Request $request): Response
    {
        $filename = $this->getParameter('root_dir').'/public/img/img.png';
        $crop = $cropper->createCrop($filename);
        $crop->setCroppedMaxSize(1000, 500);
        $form = $this->createFormBuilder(['crop' => $crop])
            ->add('crop', CropperType::class,
            [
                'public_url' => '/img/img.png',
                'aspect_ratio' => 2000 / 1500,
                'attr' => [
                    'data-controller' => 'cropper'
                ]
            ])
            ->add('save', SubmitType::class)
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $encoded = ($crop->getCroppedImage());
            $resource = (imagecreatefromstring($encoded));

            imagepng($resource, $filename);
        }

        return $this->render('cropper/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
