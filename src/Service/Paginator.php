<?php


namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

class Paginator
{
          private $entityClass;
          private $limit=10;
          private $currentPage;
          private $manager;

    /**
     * Pagination constructor.
     * @param $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }


    /**
     * Déterminer le nombre de page
     * @return false|float
     * @throws \Exception
     */
    public function getPages()
    {
       // Affcihage d'une exception en cas de non ajout de l'entité
        if (empty($this->entityClass)) {
            throw new \Exception("Veuillez specifier l'entité sur laquelle nous devons paginer");
        }
        //Le nombre total d'enregistrement
        $totalpages= count($this->manager->getRepository($this->entityClass)->findAll());
        //Le nombre de pages (division arrondi à l'entier superieur)
        $pages= ceil($totalpages / $this->limit);
        return $pages;
    }


    public function getDataPagination()
    {
         // Affcihage d'une exception en cas de non ajout de l'entité
        if (empty($this->entityClass)) {
             throw new \Exception("Veuillez specifier l'entité sur laquelle nous devons paginer");
        }
         //1) calcul de l'Offset
         $offset= $this->currentPage*$this->limit - $this->limit;

         //2) Trouver les éléments à partir du repository
         $repo=$this->manager->getRepository($this->entityClass);
         $data=$repo->findBy([], ['updatedate' => 'DESC'], $this->limit, $offset);
         //3) Renvoyer les éléments

        return $data;
    }


    /**
     * @return mixed
     */
    public function getCurrentPage()
    {
        return $this->currentPage;
    }

    /**
     * @param mixed $currentPage
     * @return Paginator
     */
    public function setCurrentPage($currentPage)
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEntityClass()
    {
        return $this->entityClass;
    }

    /**
     * @param mixed $entityClass
     * @return Paginator
     */
    public function setEntityClass($entityClass)
    {
        $this->entityClass = $entityClass;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return Paginator
     */
    public function setLimit(int $limit): Pagination
    {
        $this->limit = $limit;
        return $this;
    }
}
