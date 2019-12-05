<?php

namespace App\Repository;

use App\Entity\Tricks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tricks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tricks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tricks[]    findAll()
 * @method Tricks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TricksRepository extends ServiceEntityRepository
{
    /**
     * TricksRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tricks::class);
    }

    /**
     * @return Tricks[]
     */
    public function findLastTricks()
    {
        return $this->findBy([], ['updatedate' => 'DESC'], 15, 0);
    }

    /**
     * @return Query
     */
    public function findAllTricksQuery(): Query
    {
        return $this->findTricksQuery()
            ->getQuery() ;
    }


    /**
     * @return QueryBuilder|null
     */
    private function findTricksQuery(): ? QueryBuilder
    {
           return $this->createQueryBuilder('f')
               ->orderBy('f.updatedate', 'DESC');
    }
}
