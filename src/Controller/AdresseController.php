<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdresseController extends AbstractController
{
    #[Route('/adresse', name: 'app.adresse')]
    public function index(): Response
    {
        return $this->render('adresse/index.html.twig', [
            'controller_name' => 'AdresseController',
        ]);
    }
}
