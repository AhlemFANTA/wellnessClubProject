<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $contactFormData = $form->getData();

            $message = (new \Swift_Message('You Got Mail from your blog !'))
                ->setSubject($contactFormData['Sujet'])
                ->setFrom($contactFormData['Email'])
                ->setTo('benkhadajmiaga2020@gmail.com')
                ->setBody(
                    $contactFormData['Message'],
                    'text/plain'
                )
            ;

            $mailer->send($message);

            $this->addFlash('success', ' Votre message est envoyé avec succès');
            
            return $this->redirectToRoute('contact');

        }

        return $this->render('home\contact.html.twig', [
            'email_form' => $form->createView(),
        ]);
    }
}
