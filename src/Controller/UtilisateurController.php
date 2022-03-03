<?php

namespace App\Controller;

use App\Entity\Compte;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use App\Entity\Utilisateur;
use App\Form\Utilisateur1Type;
use App\Form\UtilisateurType;
use App\Repository\TypeUtilisateurRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[Route('/utilisateur')]
class UtilisateurController extends AbstractController
{

    #[Route('/list/{role}', name: 'utilisateur_index', methods: ['GET'])]
    public function index(UtilisateurRepository $utilisateurRepository, TypeUtilisateurRepository $typeUtilisateurRepository, $role = "ROLE_USER"): Response
    {
        $type = $typeUtilisateurRepository->findOneBy([
            'role' => $role
        ]);
        //ici je crée une variable et lui donne une valeur par defaut/ la valeur par defaut permet de ne pas afficher l'action
        $actions = "ROLE_USER";

        if ($role == "ROLE_USER") {
            $users = $utilisateurRepository->findAll();
        } else {
            $users = $utilisateurRepository->findBy([
                'typeutilisateur' => $type->getId()
            ]);
            //j'envoie le role de l'utilisateur qu'on a passé en parametre
            $actions = $type->getRole();
        }

        return $this->render('utilisateur/index.html.twig', [
            //activer et desactiver les bouton 
            'cequejemetsici' => $actions,
            //utilisateurs est l'instentiation de $user
            'utilisateurs' => $users,
        ]);
    }

    public function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }



    /**
     * @IsGranted("ROLE_Gestionnaire_Ecole")
     */
    #[Route('/new', name: 'new_utilisateur', methods: ['GET', 'POST'])]

    public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $entityManager->persist($utilisateur);
            // $entityManager->flush();
            $identifiant = $this->generateRandomString(6);
            $password = $this->generateRandomString(6);
            $utilisateur->getTypeutilisateur()->setBdRole("ROLE_" . $utilisateur->getTypeutilisateur()->getRole());

            $roles[] = $utilisateur->getTypeutilisateur()->getBdRole();
            // dd($roles);
            $account = new Compte();
            $account->setIdentifiant(
                $identifiant
            );

            //ici c'est pour hasher la password 
            $account->setPassword(
                $userPasswordHasher->hashPassword(
                    $account,
                    $password
                )
            );
            $account->setRoles(
                $roles
            );

            $account->setUtilisateur(
                $utilisateur
            );
            $utilisateur->setCompte(
                $account
            );
            $entityManager->persist($utilisateur);
            $entityManager->persist($account);
            $entityManager->flush();

            //afficher l'identifiant et le mot de  passe
            $this->addFlash('identifiant', $identifiant);
            $this->addFlash('password', $password);

            return $this->redirectToRoute('new_utilisateur', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateur/new.html.twig', [
            // Form
            'utilisateur' => $form->createView(),
            // 'utilisateur' => $utilisateur,
            // 'form' => $form,
        ]);
    }

    /**
     * @IsGranted("ROLE_Administrateur")
     */
    #[Route('/new1', name: 'utilisateur1_new', methods: ['GET', 'POST'])]
    public function newAdmin(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $utilisateur = new Utilisateur();
        $form = $this->createForm(Utilisateur1Type::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $identifiant = $this->generateRandomString(6);
            $password = $this->generateRandomString(6);
            $utilisateur->getTypeutilisateur()->setBdRole("ROLE_" . $utilisateur->getTypeutilisateur()->getRole());
            $roles[] = $utilisateur->getTypeutilisateur()->getBdRole();

            $account = new Compte();
            $account->setIdentifiant(
                $identifiant
            );
            $account->setPassword(
                $userPasswordHasher->hashPassword(
                    $account,
                    $password
                )
            );
            $account->setRoles(
                $roles
            );
            $account->setUtilisateur(
                $utilisateur
            );
            $utilisateur->setCompte(
                $account
            );
            $entityManager->persist($utilisateur);
            $entityManager->persist($account);
            $entityManager->flush();


            $this->addFlash('identifiant', $identifiant);
            $this->addFlash('password', $password);

            return $this->redirectToRoute('utilisateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('utilisateur/new.html.twig', [
            // Form
            'utilisateur' => $form->createView(),
            // 'utilisateur' => $utilisateur,
            // 'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'utilisateur_show', methods: ['GET'])]
    public function show(Utilisateur $utilisateur): Response
    {
        return $this->render('utilisateur/show.html.twig', [
            'utilisateur' => $utilisateur,
        ]);
    }



    #[Route('/{id}/edit', name: 'utilisateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Utilisateur1Type::class, $utilisateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('utilisateur_show', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('utilisateur/edit.html.twig', [
            'user' => $form,
            'utilisateur' => $utilisateur
            // 'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'utilisateur_delete', methods: ['POST'])]
    public function delete(Request $request, Utilisateur $utilisateur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $utilisateur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($utilisateur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('utilisateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
