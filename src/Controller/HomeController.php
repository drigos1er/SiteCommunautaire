<?php


namespace App\Controller;
use App\Entity\AuthenticatedUser;
use App\Entity\Figures;
use App\Entity\MediaImage;
use App\Form\FiguresType;
use App\Form\RegistrationType;
use App\Repository\FiguresRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class HomeController extends AbstractController
{
    public function index(FiguresRepository $repository)
    {


        $figures = $repository->findLastFigures();
        return  $this->render('view/home.html.twig', array('figures'=>$figures));
    }



    public function createfigure(Request $request, ObjectManager $manager)
    {
        $figure= new Figures();
        $form= $this->createForm(FiguresType::class, $figure);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $datecreate = new \Datetime();


            $manager->flush();
            $this->addFlash('success','Compte crée avec succès');
            return $this->redirectToRoute('security_login');
        }
        return $this->render('view/createfigure.html.twig', array('form'=>$form->createView()));
    }







    public function listfigures(FiguresRepository $repository,PaginatorInterface $paginator, Request $request)
    {


        $listfigures = $paginator->paginate($repository->findAllFiguresQuery(), $request->query->getInt('page', 1),
        15);
        return  $this->render('view/listfigures.html.twig', array('listfigures'=>$listfigures));
    }
}