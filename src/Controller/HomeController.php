<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use App\Repository\TestimonialRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(PropertyRepository $propertyRepository, TestimonialRepository $testimonialRepository): Response
    {
        // Fetch featured properties
        $featuredList = $propertyRepository->findBy(['featured' => true, 'status' => 2], null, 10);

        // Fetch last testimonials
        $testimonialList = $testimonialRepository->findBy([], ['created' => 'DESC'], 6);

        return $this->render('pages/home.html.twig', [
            'featured' => $featuredList,
            'testimonials' => $testimonialList
        ]);
    }
}
