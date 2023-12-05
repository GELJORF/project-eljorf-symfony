<?php

namespace App\Controller;

use App\Repository\AlphabetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CoursController extends AbstractController
{
    #[Route('/cours', name: 'app_cours')]
    public function index(AlphabetRepository $alphabetRepository)
    {
        $alphabet = $alphabetRepository->findAllLessonsWithContent();

        return $this->render('cours/index.html.twig', [
            'cours' => $alphabet,
        ]);
    }
}
