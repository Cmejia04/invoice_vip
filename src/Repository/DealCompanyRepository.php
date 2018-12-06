<?php

namespace App\Repository;

use App\Entity\DealCompany;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DealCompany|null find($id, $lockMode = null, $lockVersion = null)
 * @method DealCompany|null findOneBy(array $criteria, array $orderBy = null)
 * @method DealCompany[]    findAll()
 * @method DealCompany[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealCompanyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DealCompany::class);
    }

//    /**
//     * @return DealCompany[] Returns an array of DealCompany objects
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
    public function findOneBySomeField($value): ?DealCompany
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
