<?php


namespace App\Controller;
use App\Repository\FiguresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class HomeController extends AbstractController
{
    public function index(FiguresRepository $repository)
    {
        $figures = $repository->findLastFigures();
        return  $this->render('view/home.html.twig', array('figures'=>$figures));
    }



}