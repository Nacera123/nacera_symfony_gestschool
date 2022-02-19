<?php

namespace App\Controller;

use App\Entity\ProfClasse;
use App\Form\ProfClasseType;
use App\Repository\ProfClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/prof/classe')]
class ProfClasseController extends AbstractController
{
    #[Route('/', name: 'prof_classe_index', methods: ['GET'])]
    public function index(ProfClasseRepository $profClasseRepository): Response
    {
        return $this->render('prof_classe/index.html.twig', [
            'prof_classes' => $profClasseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'prof_classe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profClasse = new ProfClasse();
        $form = $this->createForm(ProfClasseType::class, $profClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($profClasse);
            $entityManager->flush();

            return $this->redirectToRoute('prof_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prof_classe/new.html.twig', [
            'prof_classe' => $profClasse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'prof_classe_show', methods: ['GET'])]
    public function show(ProfClasse $profClasse): Response
    {
        return $this->render('prof_classe/show.html.twig', [
            'prof_classe' => $profClasse,
        ]);
    }

    #[Route('/{id}/edit', name: 'prof_classe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProfClasse $profClasse, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfClasseType::class, $profClasse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('prof_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('prof_classe/edit.html.twig', [
            'prof_classe' => $profClasse,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'prof_classe_delete', methods: ['POST'])]
    public function delete(Request $request, ProfClasse $profClasse, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$profClasse->getId(), $request->request->get('_token'))) {
            $entityManager->remove($profClasse);
            $entityManager->flush();
        }

        return $this->redirectToRoute('prof_classe_index', [], Response::HTTP_SEE_OTHER);
    }
}
