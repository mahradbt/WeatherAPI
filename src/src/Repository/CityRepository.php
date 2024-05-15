<?php

namespace App\Repository;

use App\Entity\City;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<City>
 *
 * @method City|null find($id, $lockMode = null, $lockVersion = null)
 * @method City|null findOneBy(array $criteria, array $orderBy = null)
 * @method City[]    findAll()
 * @method City[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, City::class);
    }

        public function checkCity($name): ?City
        {
            return $this->createQueryBuilder('city')
                ->andWhere('city.name = :name')
                ->setParameter('name', $name)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }

    public function getAll(): mixed
    {
        $records = $this->createQueryBuilder('city')
            ->getQuery()
            ->getResult();
        $result = [];
        foreach ($records as $record) {
            $result[] = [
                'id' => $record->getId(),
                'name' => $record->getName(),
                'lat' => $record->getLat(),
                'lng' => $record->getLng(),
            ];
        }
        return $result;
    }
}
