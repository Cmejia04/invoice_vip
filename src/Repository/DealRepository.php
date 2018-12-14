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
        $query = $this->createQueryBuilder('d')
            ->innerJoin('d.dealInvoice', 'di')
            ->innerJoin('di.dealCompany', 'dc')
            ->innerJoin('dc.dealCompanyType', 'dct')
            ->innerJoin('d.dealStatus', 'ds')
            ->where("1 = 1")
        ;

        if ( !empty($filter['keyword']) ) {
            $query
                ->andWhere('dc.name LIKE \':keyword\' OR dct.name LIKE \':keyword\' OR ds.name LIKE \':keyword\'')
                ->setParameter('keyword', "%" . $filter['keyword'] . "%");
        }

        if ( !empty($filter['distributor']) ) {
            $query
                ->andWhere('dc.id = :distributor')
                ->setParameter('distributor', $filter['distributor']);
        }

        return $query->getQuery()->getResult();
    }
}
