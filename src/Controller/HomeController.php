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
        return $this->render('home/home.html.twig');
    }

    /**
     * @Route("/salut/{toi}")
     */
    public function hello($toi) {
        return new Response('<html><body>Hello '.$toi.'</body></html>');
    }


}