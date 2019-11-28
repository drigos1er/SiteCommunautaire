<?php

namespace App\Controller;

use App\Entity\AuthenticatedUser;
use App\Entity\UpdatePwd;
use App\Form\ProfileType;
use App\Form\RegistrationType;
use App\Form\UpdatePwdType;
use App\Repository\TasksRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class SecurityController extends AbstractController
{


    /**
     * Page de création d'un utillisateur
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
       $useraut= new AuthenticatedUser();
       $form= $this->createForm(RegistrationType::class, $useraut);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $hashpwd=$encoder->encodePassword($useraut, $useraut->getPassword());

            $useraut->setPassword($hashpwd);


            $manager->persist($useraut);
            $manager->flush();
     $this->addFlash('success','Compte crée avec succès');
            return $this->redirectToRoute('security_login');
        }
       return $this->render('security/registration.html.twig', array('form'=>$form->createView(), 'current_menu'=>'register'));
    }


    /**
     * Page de Connexion
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        return $this->render('security/login.html.twig', [
            'error' =>$authenticationUtils->getLastAuthenticationError(),
            'last_username' =>$authenticationUtils->getLastUsername(),
            'current_menu'=>'login'

        ]);
    }


    /**
     * Page de Déconnexion
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function logout()
    {

        return $this->render('security/login.html.twig');
    }



    public function profile(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $userprofile= $this->getUser();
        $form= $this->createForm(ProfileType::class, $userprofile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {



            $manager->persist($userprofile);
            $manager->flush();
            $this->addFlash('success','Compte crée avec succès');
            return $this->redirectToRoute('sitecom_profilepage', array('id'=>$userprofile->getId()));
        }
        return $this->render('security/profile.html.twig', array('form'=>$form->createView(), 'current_menu'=>'profile'));
    }




    public function updatepwd(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $user=$this->getUser();
        $pwdupdate= new UpdatePwd();
        $form= $this->createForm(UpdatePwdType::class, $pwdupdate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            if(!password_verify($pwdupdate->getOldpwd(), $user->getPassword())){

                $form->get('oldpwd')->addError(new FormError("Ce mot de passe ne correspond pas à votre mot de passe actuel"));

            }else{

                $newpwd=$encoder->encodePassword($user, $pwdupdate->getNewpwd());

                $user->setPassword($newpwd);


                $manager->persist($user);
                $manager->flush();
                $this->addFlash('success','Mot de passe modifié avec succès');
                return $this->redirectToRoute('security_login');
            }


        }
        return $this->render('security/updatepwd.html.twig', array('form'=>$form->createView(), 'current_menu'=>'updatepwd'));
    }






}
