<?php

namespace App\Controller;

use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{


    /**
     *  Affiche la page d'accueil du site
     * @param TricksRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TricksRepository $repository)
    {
        $tricks = $repository->findLastTricks();
        return  $this->render('view/home.html.twig', array('tricks'=>$tricks,'current_menu'=>''));
    }

}
