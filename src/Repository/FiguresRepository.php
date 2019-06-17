<?php

namespace App\Repository;

use App\Entity\Figures;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Figures|null find($id, $lockMode = null, $lockVersion = null)
 * @method Figures|null findOneBy(array $criteria, array $orderBy = null)
 * @method Figures[]    findAll()
 * @method Figures[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FiguresRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Figures::class);
    }

    public function findLastFigures()
    {
        return $this->findBy([], ['updatedate' => 'DESC'], 15,
            0 );
    }

    public function findAllFiguresQuery(): Query
    {
        return $this->findFiguresQuery()
            ->getQuery() ;
    }



       private function findFiguresQuery(): ? QueryBuilder
       {
           return $this->createQueryBuilder('f')
               ->orderBy('f.updatedate', 'DESC')


           ;
       }



    // /**
    //  * @return Figures[] Returns an array of Figures objects
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
    public function findOneBySomeField($value): ?Figures
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
