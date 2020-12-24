<?php

namespace App\Repository;

use App\Entity\Grossistes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Grossistes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grossistes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grossistes[]    findAll()
 * @method Grossistes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrossistesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Grossistes::class);
    }

    // /**
    //  * @return Grossistes[] Returns an array of Grossistes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Grossistes
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
