<?php


namespace App\Controller;
use App\Entity\AuthenticatedUser;
use App\Entity\Comments;
use App\Entity\Tricks;
use App\Entity\Image;
use App\Form\CommentsType;
use App\Form\TricksType;
use App\Form\ImageType;
use App\Form\RegistrationType;
use App\Repository\AuthenticatedUserRepository;
use App\Repository\TricksRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;



class TrickController extends AbstractController
{


    /**
     * Création  d'une figure
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @IsGranted("ROLE_USERAUT")
     */
    public function addtrick(Request $request, ObjectManager $manager, AuthenticationUtils $authenticationUtils, AuthenticatedUserRepository $usert)
    {
        $trick= new Tricks();
        $form= $this->createForm(TricksType::class, $trick);


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Ajout de collections d'images
            foreach ($trick->getImage() as $image){

                $image->setTricks($trick);
                $manager->persist($image);
            }

            // Ajout de collections de vidéos
            foreach ($trick->getVideo() as $video){

                $video->setTricks($trick);
                $manager->persist($video);
            }

            $trick->setAuthenticateduser($this->getUser());

            $manager->persist($trick);

            $manager->flush();
            $this->addFlash('success',' la figure crée avec succès');
            return $this->redirectToRoute('sitecom_listtrick', array('id'=>$trick->getId()));
        }
        return $this->render('view/addtrick.html.twig', array('form'=>$form->createView()));
    }

    /**
     * Edition de Figure
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function edittrick(Tricks $trick, Request $request, ObjectManager $manager)
    {
        $form= $this->createForm(TricksType::class, $trick);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($trick->getImage() as $image){

                $image->setTricks($trick);
                $manager->persist($image);
            }
            foreach ($trick->getVideo() as $video){

                $video->setTricks($trick);
                $manager->persist($video);
            }

            $datecreate = new \Datetime();



            $trick->setUpdatedate($datecreate);

            $trick->setAuthenticateduser($this->getUser());


            $manager->persist($trick);



            $manager->flush();
            $this->addFlash('success','figure Modifiée avec succès');
            return $this->redirectToRoute('sitecom_listtrick', array('id'=>$trick->getId()));
        }





        return $this->render('view/edittrick.html.twig', array('form'=>$form->createView()));
    }


    /**
     * Affichage d'une seule annonce en fonction de l'id
     * @param $id
     * @param TricksRepository $trick
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showtrick($id, TricksRepository $trick)
    {

        $comments= new Comments();

        $form= $this->createForm(CommentsType::class, $comments);

        //recupération de la figure en fonction de l'id
        $shtrick= $trick->findOneById($id);
        return $this->render('view/showtrick.html.twig', array('shtrick'=>$shtrick,'form'=>$form->createView()));
    }


    /**
     * Affichage de la liste de figures
     * @param TricksRepository $repo
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listtrick(TricksRepository $repo, PaginatorInterface $paginator, Request $request)
    {


        $listtricks = $paginator->paginate($repo->findAllTricksQuery(), $request->query->getInt('page', 1),
        10);
        return  $this->render('view/listtrick.html.twig', array('listtricks'=>$listtricks));
    }


    /**
     * Suppression d'une figure
     * @param Tricks $repo
     * @param ObjectManager $manager
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Security("is_granted('ROLE_USERAUT') and user==trick.getAuthenticateduser()" ,message="Vou n'êtes pas autoriser à éffectuer cette opération")
     */
    public function deletetrick(Tricks $trick, ObjectManager $manager, Request $request)
    {
          $manager->remove($trick);


        $manager->flush();
        $this->addFlash('success',"la figure {$trick->getName()}a été  supprimée avec succès");
        return $this->redirectToRoute('sitecom_listtrick', array('id'=>$trick->getId()));

    }

}