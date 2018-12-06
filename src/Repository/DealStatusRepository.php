<?php

namespace App\Repository;

use App\Entity\DealStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DealStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method DealStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method DealStatus[]    findAll()
 * @method DealStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealStatusRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DealStatus::class);
    }

//    /**
//     * @return DealStatus[] Returns an array of DealStatus objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DealStatus
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
