<?php 

namespace App\Controller;

use App\Repository\AlphabetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(AlphabetRepository $alphabetRepository): Response
    {
        $lessons = $alphabetRepository->findAllLessonsWithContent();

        return $this->render('default/index.html.twig', [
            'menu' => $this->getMenu(),
            'lessons' => $lessons,
        ]);
    }

    private function getMenu(): array
    {
        return [
            'Accueil' => $this->generateUrl('homepage'),
            'À propos' => $this->generateUrl('a_propos'),
            'Cours' => $this->generateUrl('cours'),
            'Newsletter' => $this->generateUrl('newsletter'),
            'Contact' => $this->generateUrl('contact'),
            'Inscription' => $this->generateUrl('inscription'),
            'Connexion' => $this->generateUrl('connexion'),
        ];
    }
}
