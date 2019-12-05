<?php

namespace App\Controller;

use App\Entity\AuthenticatedUser;
use App\Entity\ResetPwd;
use App\Entity\UpdatePwd;
use App\Form\ProfileType;
use App\Form\RegistrationType;
use App\Form\ResetPwdType;
use App\Form\ResettingType;
use App\Form\UpdatePwdType;
use App\Repository\AuthenticatedUserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{


    /**
     * Page de création d'un utillisateur
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        $useraut= new AuthenticatedUser();
        $form= $this->createForm(RegistrationType::class, $useraut);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Verification si une image a été ajoutée
            if ($form['picture']->getData() == "") {
                //Encodage du Mot de passe
                $hashpwd=$encoder->encodePassword($useraut, $useraut->getPassword());
                $useraut->setPassword($hashpwd);
                $manager->persist($useraut);
                $manager->flush();
                $this->addFlash('success', 'Compte crée avec succès');
                return $this->redirectToRoute('security_login');
            } else {
                    // Recuperation de l'image et changement de nom de l'image
                    $picture= $useraut->getPicture();
                    $picturename= md5(uniqid()).'.'.$picture->guessExtension();
                    $extensionsAutorisees = array('jpg', 'JPG', 'jpeg', 'JPEG');

                    // recuperation de la taille de l'image et verification de la taille et de l'extension
                    $picturesize = $picture->getClientSize();
                if (!in_array($picture->guessExtension(), $extensionsAutorisees)) {
                         $form->get('picture')->addError(
                             newFormError(
                                 "Extension  du fichier incorrect. Votre image doit être au format(
                                 \"jpg\", \"JPG\",\"jpeg\", \"JPEG\") !"
                             )
                         );
                } elseif ($picturesize > 500000) {
                        $form->get('picture')->addError(
                            new FormError(
                                "La taille de votre photo doit être inferieure à 500 Ko"
                            )
                        );
                } else {
                    //téléchargement de l'image et enregistrement de l'utilisateur
                        $picture->move($this->getParameter('upload_destination'), $picturename);
                        $hashpwd=$encoder->encodePassword($useraut, $useraut->getPassword());
                        $useraut->setPassword($hashpwd);
                        $useraut->setPicture($picturename);
                        $manager->persist($useraut);
                        $manager->flush();
                        $this->addFlash('success', 'Compte crée avec succès');
                        return $this->redirectToRoute('security_login');
                }
            }
        }
        return $this->render(
            'security/registration.html.twig',
            array(
                'form'=>$form->createView(),
                'current_menu'=>'register'
            )
        );
    }


    /**
     * Page de Connexion
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
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
     * @return Response
     */
    public function logout()
    {
        return $this->redirectToRoute('security_login');
    }


    /**
     * Page d'affichage et de modification du profil
     * @param Request $request
     * @param $id
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return RedirectResponse|Response
     */
    public function profile(Request $request, $id, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        // Sauvegarde de l'image de l'utilisateur courant
        $usercc= $this->getUser()->getPicture();

        //Formulaire de profil de l'utilisateur
        $userprofile= $this->getUser();
        $form= $this->createForm(ProfileType::class, $userprofile);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Vérifie si aucune image n'est envoyer
            if ($form['picture']->getData() == "") {
                //On sauvegarde l'utilisateur
                $picturename= $usercc;
                $userprofile->setPicture($picturename);
                $manager->persist($userprofile);
                $manager->flush();
                $this->addFlash('success', 'Profil modifiée avec succès');
                return $this->redirectToRoute('sitecom_profilepage', array('id'=>$userprofile->getId()));
            } else {
                //On recupère l'image
                $picture= $userprofile->getPicture();
                // On recupère l'extenseion et la taille de l'image
                $picturename= md5(uniqid()).'.'.$picture->guessExtension();
                $extensionsAutorisees = array('jpg', 'JPG', 'jpeg', 'JPEG');
                $picturesize = $picture->getClientSize();

                // on met des restrictions sur la taille et l'extension
                if (!in_array($picture->guessExtension(), $extensionsAutorisees)) {
                    $form->get('picture')->addError(
                        new FormError("Extension  du fichier incorrect. 
                        Votre image doit être au format(\"jpg\", \"JPG\",\"jpeg\", \"JPEG\") !")
                    );
                } elseif ($picturesize > 500000) {
                    $form->get('picture')->addError(
                        new FormError("La taille de votre photo doit être inferieure à 500 Ko")
                    );
                } else {
                    //on telecharge l'image et on sauvegarde l'utilisateur
                    $picture->move($this->getParameter('upload_destination'), $picturename);
                    $userprofile->setPicture($picturename);
                    $manager->persist($userprofile);
                    $manager->flush();
                    $this->addFlash('success', 'Profil modifiée avec succès');
                    return $this->redirectToRoute('sitecom_profilepage', array('id'=>$userprofile->getId()));
                }
            }
        }
        return $this->render(
            'security/profile.html.twig',
            array('form'=>$form->createView(), 'current_menu'=>'profile')
        );
    }


    /**
     * Page de modificatrion du mot de Passe
     * @param Request $request
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @return RedirectResponse|Response
     */
    public function updatepwd(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        // Recuperation de l'utilisateur courant
        $user=$this->getUser();
        //Formulaire de modification de mot de passe
        $pwdupdate= new UpdatePwd();
        $form= $this->createForm(UpdatePwdType::class, $pwdupdate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if (!password_verify($pwdupdate->getOldpwd(), $user->getPassword())) {
                $form->get('oldpwd')->addError(
                    new FormError("Ce mot de passe ne correspond pas à votre mot de passe actuel")
                );
            } else {
                //Recuperation du nouveau mot de passe, encodage et enregistrement
                $newpwd=$encoder->encodePassword($user, $pwdupdate->getNewpwd());
                $user->setPassword($newpwd);
                $manager->persist($user);
                $manager->flush();
                $this->addFlash('success', 'Mot de passe modifié avec succès');
                return $this->redirectToRoute('security_logout');
            }
        }
        return $this->render(
            'security/updatepwd.html.twig',
            array('form'=>$form->createView(), 'current_menu'=>'updatepwd')
        );
    }


    /**
     * formulaire  et Envoi de mail de réinitialisation
     * @param Request $request
     * @param ObjectManager $manager
     * @param TokenGeneratorInterface $tokenGenerator
     * @param AuthenticatedUserRepository $userrepo
     * @param \Swift_Mailer $mailer
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function resetpwd(
        Request $request,
        ObjectManager $manager,
        TokenGeneratorInterface $tokenGenerator,
        AuthenticatedUserRepository $userrepo,
        \Swift_Mailer $mailer
    ) {
       // création du formulaire de réinitialisation
        $pwdreset= new ResetPwd();
        $form= $this->createForm(ResetPwdType::class, $pwdreset);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userreset=$userrepo->findOneByUsername($pwdreset->getUsername());
            if (!$userreset) {
                $form->get('username')->addError(new FormError("Ce nom d'utilisateur n'existe pas !"));
            } else {
                // Génération et enregistrement du du token
                $userreset->setToken($tokenGenerator->generateToken());

                // enregistrement de la date de création du token
                $userreset->setPwdtokendat(new \Datetime());
                $manager->persist($userreset);
                $manager->flush();
                $message = (new \Swift_Message('Réinitialisation de Mot de passe'))
                    ->setSubject('Réinitialisation de Mot de passe')
                    ->setFrom('info@snowtrick.com')
                    ->setTo($userreset->getEmail())
                    ->setBody(
                        $this->renderView(
                            'security/resetmail.html.twig',
                            ['userreset' => $userreset]
                        ),
                        'text/html'
                    );
                $mailer->send($message);
                $this->addFlash(
                    'success',
                    ' Un mail  de renouvellement de  votre mot de passe a été envoyé. Le lien est valide  30min.'
                );
                return $this->redirectToRoute('sitecom_resetpwd');
            }
        }
        return $this->render(
            'security/resetpwd.html.twig',
            array('form'=>$form->createView(),
                'current_menu'=>'resetpwd')
        );
    }


    /**
     * Formulaire et enregistrement de la  réinitialisation du mot de passe
     * @param Request $request
     * @param $token
     * @param ObjectManager $manager
     * @param UserPasswordEncoderInterface $encoder
     * @param AuthenticatedUser $userreset
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function resetting(
        Request $request,
        $token,
        ObjectManager $manager,
        UserPasswordEncoderInterface $encoder,
        AuthenticatedUser $userreset
    ) {
        // Calcul de la durée du token
        $now = new \DateTime();
        $datetoken=$userreset->getPwdtokendat();
        $delai = $now->getTimestamp() - $datetoken->getTimestamp();
        $timemax= 60 * 30;

        // Accès refusé si le token est null, token différent de celui de la base et  date de token >= 30min:
        if ($userreset->getToken() === null || $token !== $userreset->getToken() || $delai > $timemax) {
            throw new AccessDeniedHttpException("Ce lien n'est plus valide");
        }
        // Formulaire de rénitialisation
        $form= $this->createForm(ResettingType::class, $userreset);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Encodage du password
            $password = $encoder->encodePassword($userreset, $userreset->getPassword());
            $userreset->setPassword($password);

            // réinitialisation du token et de sa date à null
            $userreset->setToken(null);
            $userreset->setPwdtokendat(null);
            $manager->persist($userreset);
            $manager->flush();
            $this->addFlash('success', 'Mot de passe réinitialisé avec succès');
            return $this->redirectToRoute('security_login');
        }
        return $this->render(
            'security/resetting.html.twig',
            array('form'=>$form->createView(),
                'current_menu'=>'resetting')
        );
    }
}
