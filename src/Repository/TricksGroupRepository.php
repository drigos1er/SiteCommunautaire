<?php

namespace App\Repository;

use App\Entity\TricksGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TricksGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method TricksGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method TricksGroup[]    findAll()
 * @method TricksGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TricksGroupRepository extends ServiceEntityRepository
{
    /**
     * TricksGroupRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TricksGroup::class);
    }
}
