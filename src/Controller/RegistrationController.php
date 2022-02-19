<?php

namespace App\Controller;

use App\Entity\Compte;
use App\Entity\Utilisateur;
use App\Entity\TypeUtilisateur;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use SebastianBergmann\LinesOfCode\Counter;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    public function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
        
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            //pour generer l'identifiant et le mot de passe:

            //generer un compte depuis l'inscription utilisateur: il sera renvoyé a l'utilisateur
            $identifiant=$this->generateRandomString(6);
            $password=$this->generateRandomString(6);
            // $roles=$this->typeutilisateur;
            $account=new Compte();
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
            // $account->setroles(
            //     $roles
            // );
            
            $account->setUtilisateur(
                $user 
            );
            $user->setCompte(
                $account
            );
            $entityManager->persist($user);
            $entityManager->persist($account);
            $entityManager->flush();

            // generate a signed url and email it to the user
            //on verifie plus le user mais account
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $account,
                (new TemplatedEmail())
                    ->from(new Address('moi@toto.fr', 'moi'))

                    // ajouter le getemail
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            //afficher l'identifiant et le mot de  passe
            $this->addFlash('identifiant',$identifiant);
            $this->addFlash('password',$password);

            return $this->redirectToRoute('app_register');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_register');
    }
}
