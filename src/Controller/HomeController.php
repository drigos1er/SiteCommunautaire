<?php


namespace App\Controller;
use App\Repository\FiguresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class HomeController extends AbstractController
{
    public function index(FiguresRepository $repository)
    {


        $figures = $repository->findLastFigures();
        return  $this->render('view/home.html.twig', array('figures'=>$figures));
    }


    public function listfigures(FiguresRepository $repository,PaginatorInterface $paginator, Request $request)
    {


        $listfigures = $paginator->paginate($repository->findAllFiguresQuery(), $request->query->getInt('page', 1),
        15);
        return  $this->render('view/listfigures.html.twig', array('listfigures'=>$listfigures));
    }
}