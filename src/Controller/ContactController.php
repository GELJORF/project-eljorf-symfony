<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contactMessage = new ContactMessage();
        $form = $this->createForm(ContactFormType::class, $contactMessage);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contactMessage);
            $entityManager->flush();

            
            $this->sendConfirmationEmail($contactMessage, $mailer);

            
            return $this->redirectToRoute('contact_confirmation');
        }

        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'form' => $form->createView(),
        ]);
    }

    private function sendConfirmationEmail(ContactMessage $contactMessage, MailerInterface $mailer): void
    {
        $email = (new Email())
            ->from($contactMessage->getEmail())
            ->to('ale@mail.com')
            ->subject('Nouveau message de contact')
            ->html(sprintf('Nom: %s<br>E-mail: %s<br>Message: %s', $contactMessage->getName(), $contactMessage->getEmail(), $contactMessage->getMessage()));

        $mailer->send($email);
    }

    #[Route('/contact/confirmation', name: 'contact_confirmation')]
    public function confirmation(): Response
    {
        return $this->render('contact/confirmation.html.twig');
    }
}
