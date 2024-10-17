<?php

namespace App\Repository;

use App\Entity\ClientEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ClientEntity>
 */
class ClientEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ClientEntity::class);
    }

    //    /**
    //     * @return ClientEntity[] Returns an array of ClientEntity objects
    //     */
       public function paginateClients(int $page, int $limit): Paginator
       {
           $query = $this->createQueryBuilder('c')
               ->setFirstResult(($page - 1) * $limit)
               ->setMaxResults($limit)
               ->orderBy('c.id', 'ASC')
               ->getQuery();
           return new Paginator($query);
       }

    //    public function findOneBySomeField($value): ?ClientEntity
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
