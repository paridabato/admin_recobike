<?php

namespace App\Repository;

use App\Entity\Marquages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Marquages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Marquages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Marquages[]    findAll()
 * @method Marquages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MarquagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marquages::class);
    }

    // /**
    //  * @return Enregistrer[] Returns an array of Enregistrer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Enregistrer
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

}
