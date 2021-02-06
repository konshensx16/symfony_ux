<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Dropzone\Form\DropzoneType;

class DropzoneController extends AbstractController
{
    #[Route('/dropzone', name: 'dropzone')]
    public function index(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('file', DropzoneType::class, [
            ])
            ->add('save', SubmitType::class)
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            dd($form->getData());
        }

        return $this->render('dropzone/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
