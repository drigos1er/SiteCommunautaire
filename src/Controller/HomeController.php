<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\TricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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



    public function contact(Request $request, \Swift_Mailer $mailer)
    {
        $contact = new Contact();
        $form= $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $message = (new \Swift_Message('Hello Email'))
                ->setSubject('Confirmation de la reception de votre message')
                ->setFrom($contact->getEmail())
                ->setTo('drigos1er@gmail.com')
                ->setBody(
                    $this->renderView(
                    // templates/emails/registration.html.twig
                        'view/emailconfirm.html.twig',
                        ['contact' => $contact]
                    ),
                    'text/html'
                )


            ;

            $mailer->send($message);

            $this->addFlash('success',' Votre message a bien été envoyé avec succès');
            return $this->redirectToRoute('sitecom_contactpage');
        }



return $this->render('view/contact.html.twig', array('form' => $form->createView(),'current_menu'=>'contact'));


    }


}
