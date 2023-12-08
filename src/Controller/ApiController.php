<?php

namespace App\Controller;

use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/lieux', name: 'api_location', methods: ['GET'])]
    public function location(LocationRepository $locationRepository, Request $request): JsonResponse
    {
		$search  = $request->query->get("search");
        if (empty($search)) throw new HttpException(400, 'Bad request');

        if (str_contains($search, '_')) {
            $locations = [ $locationRepository->findOneBy(['identifier' => $search]) ];
        } elseif (is_numeric($search)) {
            $locations = $locationRepository->findByPostalCode($search);
        } else {
            $locations = $locationRepository->findByName($search);
        }

        $data = $this->formatLocationResults($locations);
        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * Formats the location results
     *
     * @param array $locations The array of locations to be formatted.
     * @return array The formatted location results.
     */
    private function formatLocationResults(array $locations): array
    {
        $results = [];
        foreach ($locations as $location) {
            $results[] = [
                'value' => $location->getIdentifier(),
                'label' => $location->getCity().' ('.$location->getPostalCode().')'
            ];
        }
        return $results;
    }
}
