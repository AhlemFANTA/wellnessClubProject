<?php

namespace App\Controller;
use Swift_Mailer;
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
                ->setFrom($contactFormData['from'])
                ->setSubject($contactFormData['subject'])
                ->setTo('benkhadajmiaga2020@gmail.com')
                ->setBody(
                    $contactFormData['message'],
                    'text/plain'
                )
            ;

            $mailer->send($message);

            $this->addFlash('success', 'Message was send');
            
            return $this->redirectToRoute('contact');

        }

        return $this->render('contact\index.html.twig', [
            'email_form' => $form->createView(),
        ]);
    }
}
