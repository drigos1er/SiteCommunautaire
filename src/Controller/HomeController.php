<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class HomeController
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     *  Affiche la page d'accueil du site
     * @param TricksRepository $repository
     * @return Response
     */
    public function index(TricksRepository $repository)
    {
        $tricks = $repository->findLastTricks();
        return  $this->render('view/home.html.twig', array('tricks'=>$tricks,'current_menu'=>''));
    }


    /**
     * Formulaire de Contact permettant aux utilisateurs d'envoi des messages à la plateforme
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return RedirectResponse|Response
     */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        // Générer le formulaire de contact
        $contact = new Contact();
        $form= $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $message = (new \Swift_Message('Contactez nous'))
                ->setSubject('Confirmation de la reception de votre message')
                ->setFrom($contact->getEmail())
                ->setTo('drigos1er@yahoo.fr')
                ->setBody(
                    $this->renderView(
                        // le template du mail de confirmation
                        'view/emailconfirm.html.twig',
                        ['contact' => $contact]
                    ),
                    'text/html'
                )
            ;
            //Envoi du message
            $mailer->send($message);

            $this->addFlash('success', ' Votre message a bien été envoyé avec succès');
            return $this->redirectToRoute('sitecom_contactpage');
        }



        return $this->render('view/contact.html.twig', array('form' => $form->createView(), 'current_menu'=>'contact'));
    }
}
