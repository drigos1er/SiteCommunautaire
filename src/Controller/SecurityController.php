<?php

namespace App\Controller;

use App\Entity\AuthenticatedUser;
use App\Form\RegistrationType;
use App\Repository\FiguresRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{


    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
       $useraut= new AuthenticatedUser();
       $form= $this->createForm(RegistrationType::class, $useraut);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hashpwd=$encoder->encodePassword($useraut, $useraut->getPassword());
            $datecreate = new \Datetime();
            $useraut->setPassword($hashpwd);
            $useraut->setCreatedate($datecreate);
            $useraut->setUpdatedate($datecreate);

            $manager->persist($useraut);
            $manager->flush();
     $this->addFlash('success','Compte crée avec succès');
            return $this->redirectToRoute('security_login');
        }
       return $this->render('security/registration.html.twig', array('form'=>$form->createView()));
    }



    public function login( AuthenticationUtils $authenticationUtils)
    {

        return $this->render('security/login.html.twig', [
            'error' =>$authenticationUtils->getLastAuthenticationError(),
            'last_username' =>$authenticationUtils->getLastUsername()
        ]);
    }








    public function logout()
    {

        return $this->render('security/login.html.twig');
    }

}
