<?php

namespace App\Repository;

use App\Entity\Updatepwd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Updatepwd|null find($id, $lockMode = null, $lockVersion = null)
 * @method Updatepwd|null findOneBy(array $criteria, array $orderBy = null)
 * @method Updatepwd[]    findAll()
 * @method Updatepwd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UpdatepwdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Updatepwd::class);
    }

    // /**
    //  * @return Updatepwd[] Returns an array of Updatepwd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Updatepwd
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
