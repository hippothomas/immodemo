<?php

namespace App\Repository;

use App\Entity\Property;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Property>
 *
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * Finds entities based on search criteria.
     * @param string|null $keyword The keyword to search for in the entities title and description.
     * @param string|null $type The slug of the type to filter entities by.
     * @param string|null $lieu The identifier of the location to filter entities by.
     * @param float|null $max_price The maximum price to filter entities by.
     * @param int|null $page The page number to retrieve entities from.
     * @param int $maxResults The max results per pages.
     * @param bool $count If true, only the count of matching entities will be returned.
     * @return array|int If $count is true, the method returns the count of matching entities as an integer. If $count is false, the method returns an array of entity objects.
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function findBySearch(?string $keyword, ?string $type, ?string $lieu, ?float $max_price, ?int $page, int $maxResults = 12, bool $count = false): array|int
    {
         $qb = $this->createQueryBuilder('p');

         if ($count) {
             $qb->select('COUNT(p)');
         }

         if (!empty($keyword)) {
            $qb->andWhere('p.title LIKE :keyword')
                ->orWhere('p.description LIKE :keyword')
                ->setParameter('keyword', "%{$keyword}%");
        }

         if (!empty($type)) {
            $qb->innerJoin('p.type', 't')
                ->andWhere('t.slug = :type')
                ->setParameter('type', $type);
         }

         if (!empty($lieu)) {
            $qb->innerJoin('p.location', 'l')
                ->andWhere('l.identifier = :lieu')
                ->setParameter('lieu', $lieu);
         }

         if (!empty($max_price)) {
            $qb->andWhere('p.price <= :max_price')
                ->setParameter('max_price', $max_price);
         }

         if (!empty($page) && !$count) {
             $qb->setFirstResult(($page-1) * $maxResults)
                ->setMaxResults($maxResults);
         }

         if (!$count) {
             $qb->orderBy('p.updated', 'DESC');
         }
         $query = $qb->andWhere('p.status = 2')->getQuery();

         return $count ? $query->getSingleScalarResult() : $query->getResult();
    }
}
