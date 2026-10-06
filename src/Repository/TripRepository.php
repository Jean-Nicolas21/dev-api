<?php

namespace App\Repository;

use App\Entity\City;
use App\Entity\Trip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Trip>
 */
class TripRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Trip::class);
    }


    /** @return Trip[]
     * @throws \DateMalformedStringException
     */
    public function search(City $origin, City $destination, \DateTimeImmutable $day): array
    {
        $start = $day->setTime(0, 0);
        $end = $start->modify('+1 day');

        return $this->createQueryBuilder('trip')
            ->andWhere('trip.origin = :origin')
            ->andWhere('trip.destination = :destination')
            ->andWhere('trip.departureAt >= :start')
            ->andWhere('trip.departureAt < :end')
            ->setParameter('origin', $origin)
            ->setParameter('destination', $destination)
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->orderBy('trip.departureAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

//    /**
//     * @return Trip[] Returns an array of Trip objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Trip
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
