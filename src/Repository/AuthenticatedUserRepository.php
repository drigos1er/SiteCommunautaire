<?php

namespace App\Repository;

use App\Entity\AuthenticatedUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AuthenticatedUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AuthenticatedUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AuthenticatedUser[]    findAll()
 * @method AuthenticatedUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthenticatedUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AuthenticatedUser::class);
    }

    // /**
    //  * @return AuthenticatedUser[] Returns an array of AuthenticatedUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AuthenticatedUser
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
