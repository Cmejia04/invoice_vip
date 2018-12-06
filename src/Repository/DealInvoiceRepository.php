<?php

namespace App\Repository;

use App\Entity\DealInvoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DealInvoice|null find($id, $lockMode = null, $lockVersion = null)
 * @method DealInvoice|null findOneBy(array $criteria, array $orderBy = null)
 * @method DealInvoice[]    findAll()
 * @method DealInvoice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealInvoiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DealInvoice::class);
    }

//    /**
//     * @return DealInvoice[] Returns an array of DealInvoice objects
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
    public function findOneBySomeField($value): ?DealInvoice
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
