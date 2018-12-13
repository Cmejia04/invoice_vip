<?php

namespace App\Repository;

use App\Entity\Deal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Deal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deal[]    findAll()
 * @method Deal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Deal::class);
    }

    public function findUsedFilters($filter)
    {
        return $this->createQueryBuilder('d')
            ->innerJoin('d.dealInvoice', 'di')
            ->innerJoin('di.dealCompany', 'dc')
            ->innerJoin('dc.dealCompanyType', 'dct')
            ->innerJoin('d.dealStatus', 'ds')
            ->where('dc.name LIKE "%:keyword%" OR dct.name LIKE "%:keyword%" OR ds.name LIKE "%:keyword%"')
            ->andWhere('dc.id = :distributor')
            ->setParameters([
                'keyword' => $filter['keyword'],
                'distributor' => $filter['distributor']
            ])
            ->getQuery()
            ->getResult()
        ;
    }
}
