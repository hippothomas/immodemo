<?php

namespace App\Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    #[Route('/annonces/{slug}', name: 'property')]
    public function index(Property $property): Response
    {
        // Check if property is published
        if ($property->getStatus() !== 2) throw new NotFoundHttpException("This property doesn't exist!");

        return $this->render('pages/property.html.twig', [
            'property' => $property
        ]);
    }
}
