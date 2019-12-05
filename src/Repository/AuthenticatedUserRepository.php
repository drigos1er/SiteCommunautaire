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
    /**
     * AuthenticatedUserRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AuthenticatedUser::class);
    }
}
