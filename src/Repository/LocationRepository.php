<?php

namespace App\Repository;

use App\Entity\Location;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Location>
 *
 * @method Location|null find($id, $lockMode = null, $lockVersion = null)
 * @method Location|null findOneBy(array $criteria, array $orderBy = null)
 * @method Location[]    findAll()
 * @method Location[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LocationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Location::class);
    }

    /**
     * Finds locations by name.
     *
     * @param string $name The name to search for. The search is case-insensitive.
     * @return Location[] The array of locations matching the name.
     */
    public function findByName(string $name): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('LOWER(l.city) LIKE LOWER(:name)')
            ->setParameter('name', "%{$name}%")
            ->orderBy('l.city', 'ASC')
            ->setMaxResults(25)
            ->getQuery()
            ->getResult();
    }

    /**
     * Finds locations by postal code.
     *
     * @param string $postalCode The postal code to search for.
     * @return Location[] An array of locations matching the postal code.
     */
    public function findByPostalCode(string $postalCode): array
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.postalCode LIKE :postal_code')
            ->setParameter('postal_code', "%{$postalCode}%")
            ->orderBy('l.postalCode', 'ASC')
            ->setMaxResults(25)
            ->getQuery()
            ->getResult();
    }
}
