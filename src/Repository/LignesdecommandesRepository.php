<?php

namespace App\Repository;

use App\Entity\Lignesdecommandes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lignesdecommandes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lignesdecommandes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lignesdecommandes[]    findAll()
 * @method Lignesdecommandes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignesdecommandesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lignesdecommandes::class);
    }

    // /**
    //  * @return Lignesdecommandes[] Returns an array of Lignesdecommandes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lignesdecommandes
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
