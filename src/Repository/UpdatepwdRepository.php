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
    /**
     * UpdatepwdRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Updatepwd::class);
    }
}
