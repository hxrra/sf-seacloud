<?php

namespace App\Repository;

use App\Entity\DataCenter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DataCenter|null find($id, $lockMode = null, $lockVersion = null)
 * @method DataCenter|null findOneBy(array $criteria, array $orderBy = null)
 * @method DataCenter[]    findAll()
 * @method DataCenter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DataCenterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DataCenter::class);
    }

    // /**
    //  * @return DataCenter[] Returns an array of DataCenter objects
    //  */
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
    public function findOneBySomeField($value): ?DataCenter
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
