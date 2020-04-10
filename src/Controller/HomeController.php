<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="wellness_homepage")
     */
    public function homepage(): Response{
        return $this->render('home/homepage.html.twig');
    }

    /**
     * @Route("/about",  name="wellness_about")
     */
    public function about(): Response{
        return $this->render('home/about.html.twig');
    }

    /**
     * @Route("/contact",  name="wellness_contact")
     */
    public function contact(): Response{
        return $this->render('home/contact.html.twig');
    }

    /**
     * @Route("/mention",  name="wellness_mention")
     */
    public function mention(): Response{
        return $this->render('home/mention.html.twig');
    }


}