<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use App\Repository\PropertyTypeRepository;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    private int $maxResults = 12;

    #[Route('/recherche', name: 'search')]
    public function index(PropertyRepository $propertyRepository, PropertyTypeRepository $propertyTypeRepository, Request $request): Response
    {
        // Ensure page number is not less than 1
        $page = (int) $request->query->get("page");
        if ($page < 1) $page = 1;

		// Fetch last properties
        $propertiesList = $this->retrieveProperties($page, false, $request, $propertyRepository);

        // Generate links for next & previous page
        $count = $this->retrieveProperties($page, true, $request, $propertyRepository);
        $pagesCount = ceil($count / $this->maxResults);
        $nextPageLink = null;
        $prevPageLink = null;
        if ($page <= $pagesCount) {
            $queryParams = $request->query->all();
            if ($page > 1) {
                $prevPageLink = $this->generateUrl('search', array_merge($queryParams, ['page' => $page - 1]));
            }
            if ($page < $pagesCount) {
                $nextPageLink = $this->generateUrl('search', array_merge($queryParams, ['page' => $page + 1]));
            }
        }

        // Fetch property types
        $propertyTypes = $propertyTypeRepository->findAll();

        return $this->render('pages/search.html.twig', [
            'properties' => $propertiesList,
            'types' => $propertyTypes,
            'current_page' => $page,
            'prev_page' => $prevPageLink,
            'next_page' => $nextPageLink
        ]);
    }

    /**
     * Retrieves properties based on search criteria.
     * @param int $page The page number of the search results.
     * @param bool $count Indicates whether to include the count of properties in the result.
     * @param Request $request The HTTP request object.
     * @param PropertyRepository $propertyRepository The repository for accessing property data.
     * @return array|int Returns an array of properties if $count is false, otherwise returns the count of properties.
     */
    private function retrieveProperties(int $page, bool $count, Request $request, PropertyRepository $propertyRepository): array|int
    {
        $keyword    = $request->query->get("keyword");
		$type       = $request->query->get("type");
		$lieu       = $request->query->get("lieu");
        $max_price  = preg_replace('/[^0-9.]/', '', urldecode($request->query->get("max_price")));

        // Fetch properties
        try {
            return $propertyRepository->findBySearch($keyword, $type, $lieu, (float)$max_price, $page, $this->maxResults, $count);
        } catch (ORMException $e) {
            // TODO: Log exception
            return [];
        }
    }
}
