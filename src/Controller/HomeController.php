<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController {

    /**
     * @Route("/", name="wellness_homepage")
     */
    public function homepage(){
        return new Response('<html><body>Hi, welcome to wellnessClub.fr!</body></html>');
    }

    /**
     * @Route("/salut/{toi}")
     */
    public function hello($toi) {
        return new Response('<html><body>Hello '.$toi.'</body></html>');
    }


}