<?php

namespace App\Controller;

use App\Entity\Composer;
use App\Form\ComposerType;
use App\Repository\ComposerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/composer')]
class ComposerController extends AbstractController
{
    #[Route('/', name: 'app_composer_index', methods: ['GET'])]
    public function index(ComposerRepository $composerRepository): Response
    {
        return $this->render('composer/index.html.twig', [
            'composers' => $composerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_composer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ComposerRepository $composerRepository): Response
    {
        $composer = new Composer();
        $form = $this->createForm(ComposerType::class, $composer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $composerRepository->save($composer, true);

            return $this->redirectToRoute('app_composer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('composer/new.html.twig', [
            'composer' => $composer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_composer_show', methods: ['GET'])]
    public function show(Composer $composer): Response
    {
        return $this->render('composer/show.html.twig', [
            'composer' => $composer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_composer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Composer $composer, ComposerRepository $composerRepository): Response
    {
        $form = $this->createForm(ComposerType::class, $composer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $composerRepository->save($composer, true);

            return $this->redirectToRoute('app_composer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('composer/edit.html.twig', [
            'composer' => $composer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_composer_delete', methods: ['POST'])]
    public function delete(Request $request, Composer $composer, ComposerRepository $composerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$composer->getId(), $request->request->get('_token'))) {
            $composerRepository->remove($composer, true);
        }

        return $this->redirectToRoute('app_composer_index', [], Response::HTTP_SEE_OTHER);
    }
}
