<?php

namespace App\Controller;

use App\Entity\NewsletterSubscription;
use App\Form\NewsletterFormType;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Mailer\MailerInterface;

use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter', name: 'app_newsletter')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $subscription = new NewsletterSubscription();

        $form = $this->createForm(NewsletterFormType::class, $subscription);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subscription = $form->getData();
            $subscription->setIsActive(true);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subscription);
            $entityManager->flush();

            // Envoyez un e-mail de confirmation
            $this->sendConfirmationEmail($subscription, $mailer);

            // Redirigez l'utilisateur vers une page de confirmation
            return $this->redirectToRoute('newsletter_confirmation');
        }

        // Affichez le formulaire dans le template Twig
        return $this->render('newsletter/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function sendConfirmationEmail(NewsletterSubscription $subscription, MailerInterface $mailer): void
    {
        $email = (new TemplatedEmail())
            ->from(new Address('ale@email.com', 'ELJORF'))
            ->to($subscription->getEmail())
            ->subject('Confirmation d\'inscription à la newsletter')
            ->htmlTemplate('newsletter/emails/confirmation.html.twig')  // Assurez-vous que le chemin est correct
            ->context([
                'subscription' => $subscription,
            ]);

        $mailer->send($email);
    }

    #[Route('/newsletter/confirmation', name: 'newsletter_confirmation')]
    public function confirmation(): Response
    {
        return $this->render('newsletter/emails/confirmation.html.twig');
    }
}
