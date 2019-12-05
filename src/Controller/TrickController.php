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
use App\Service\Paginator;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class TrickController extends AbstractController
{


    /**
     * Création  d'une figure
     * @param Request $request
     * @param ObjectManager $manager
     * @return RedirectResponse|Response
     * @throws \Exception
     * @IsGranted("ROLE_USERAUT")
     */
    public function addtrick(Request $request, ObjectManager $manager)
    {
        // Générer le formulaire de création de la figure
        $trick= new Tricks();
        $form= $this->createForm(TricksType::class, $trick);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Ajout de collections d'images
            foreach ($trick->getImage() as $image) {
                $image->setTricks($trick);
                $manager->persist($image);
            }
            // Ajout de collections de vidéos
            foreach ($trick->getVideo() as $video) {
                $video->setTricks($trick);
                $manager->persist($video);
            }
            $trick->setAuthenticateduser($this->getUser());
            $manager->persist($trick);
            $manager->flush();
            $this->addFlash('success', ' la figure crée avec succès');
            return $this->redirectToRoute('sitecom_listtrick', array('page'=>1));
        }
        return $this->render('view/addtrick.html.twig', array('form'=>$form->createView(),'current_menu'=>'addtrick'));
    }

    /**
     * Edition de Figure
     * @param Request $request
     * @param ObjectManager $manager
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function edittrick(Tricks $trick, Request $request, ObjectManager $manager)
    {

        // Formulaire d'édition de figure
        $form= $this->createForm(TricksType::class, $trick);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Parcourir er ajouter d'eventuelle images et videos
            foreach ($trick->getImage() as $image) {
                $image->setTricks($trick);
                $manager->persist($image);
            }
            foreach ($trick->getVideo() as $video) {
                $video->setTricks($trick);
                $manager->persist($video);
            }
            // Enregistrement de la modification

            $manager->persist($trick);
            $manager->flush();
            $this->addFlash('success', 'figure Modifiée avec succès');
            return $this->redirectToRoute('sitecom_showtrick', array('id'=>$trick->getId()));
        }
        return $this->render(
            'view/edittrick.html.twig',
            array('form'=>$form->createView(), 'current_menu'=>'edittrick', 'trick'=>$trick)
        );
    }


    /**
     * Affichage d'une seule annonce en fonction de l'id
     * @param $id
     * @param TricksRepository $trick
     * @return Response
     */
    public function showtrick($id, TricksRepository $trick, Request $request, ObjectManager $manager)
    {
        $comments= new Comments();
        $form= $this->createForm(CommentsType::class, $comments);
        //recupération de la figure en fonction de l'id
        $shtrick= $trick->findOneById($id);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $comments->setTricks($shtrick);
            $comments->setAuthenticateduser($this->getUser());
            $manager->persist($comments);
            $manager->flush();
            $this->addFlash('success', 'Commentaire ajoutée avec succès');
        }
            return $this->render(
                'view/showtrick.html.twig',
                array('shtrick'=>$shtrick, 'form'=>$form->createView(), 'current_menu'=>'showtrick')
            );
    }


    /**
     * Affichage paginé de la liste des figures
     * @param $page
     * @param Paginator $paginator
     * @return Response
     * @throws \Exception
     */
    public function listtrick($page, Paginator $paginator)
    {
        $paginator->setEntityClass(Tricks::class);
        $paginator->setCurrentPage($page);
        return  $this->render(
            'view/listtrick.html.twig',
            array('listtricks'=>$paginator->getDataPagination(),
                'current_menu'=>'listtrick', 'pages'=>$paginator->getPages(),
                'page'=>$page)
        );
    }


    /**
     * Suppression d'une figure
     * @param Tricks $repo
     * @param ObjectManager $manager
     * @param Request $request
     * @return Response
     * @Security(
     *     "is_granted('ROLE_USERAUT') and user==trick.getAuthenticateduser()" ,
     *     message="Vou n'êtes pas autoriser à éffectuer cette opération")
     */
    public function deletetrick(Tricks $trick, ObjectManager $manager, Request $request)
    {
        $manager->remove($trick);
        $manager->flush();
        $this->addFlash('success', "la figure {$trick->getName()}a été  supprimée avec succès");
        return $this->redirectToRoute('sitecom_listtrick', array('page'=>1));
    }


    /**
     * Modification de commentaires
     * @param Comments $comments
     * @param Request $request
     * @param ObjectManager $manager
     * @return RedirectResponse|Response
     */
    public function editcomment(Comments $comments, Request $request, ObjectManager $manager)
    {
        //Formulaire d'édition de commentaires
        $form= $this->createForm(CommentsType::class, $comments);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Sauvegarde de la modification
            $manager->persist($comments);
            $manager->flush();
            $this->addFlash('success', 'Commentaire Modifiée avec succès');
            return $this->redirectToRoute('sitecom_showtrick', array('id'=>$comments->getTricks()->getId()));
        }
        return $this->render(
            'view/editcomment.html.twig',
            array('form'=>$form->createView(), 'current_menu'=>'editcomment')
        );
    }


    /**
     * Supprimer un commentaire
     * @param Comments $comments
     * @param ObjectManager $manager
     * @param Request $request
     * @return RedirectResponse
     */
    public function deletecomment(Comments $comments, ObjectManager $manager, Request $request)
    {
        $manager->remove($comments);
        $manager->flush();
        $this->addFlash('success', "le commentaire a été  supprimé avec succès");
        return $this->redirectToRoute('sitecom_showtrick', array('id'=>$comments->getTricks()->getId()));
    }
}
