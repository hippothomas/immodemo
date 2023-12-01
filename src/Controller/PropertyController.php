<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    #[Route('/annonces/{slug}', name: 'property')]
    public function index(): Response
    {
        return $this->render('pages/property.html.twig');
    }
}
