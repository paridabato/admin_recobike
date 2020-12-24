<?php

namespace App\Repository;

use App\Entity\CommandesLignes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommandesLignes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommandesLignes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommandesLignes[]    findAll()
 * @method CommandesLignes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandesLignesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommandesLignes::class);
    }

    // /**
    //  * @return CommandesLignes[] Returns an array of CommandesLignes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommandesLignes
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
