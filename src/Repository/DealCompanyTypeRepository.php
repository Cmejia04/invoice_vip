<?php

namespace App\Repository;

use App\Entity\DealCompanyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DealCompanyType|null find($id, $lockMode = null, $lockVersion = null)
 * @method DealCompanyType|null findOneBy(array $criteria, array $orderBy = null)
 * @method DealCompanyType[]    findAll()
 * @method DealCompanyType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealCompanyTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DealCompanyType::class);
    }

//    /**
//     * @return DealCompanyType[] Returns an array of DealCompanyType objects
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
    public function findOneBySomeField($value): ?DealCompanyType
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
