<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/recherche', name: 'search')]
    public function index(PropertyRepository $propertyRepository): Response
    {
        // Fetch last properties
        $propertiesList = $propertyRepository->findBy(['status' => 2], ['updated' => 'DESC'], 12);

        return $this->render('pages/search.html.twig', [
            'properties' => $propertiesList
        ]);
    }
}
