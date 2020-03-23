<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {

    /**
     * @Route("/", name="wellness_homepage")
     */
    public function homepage(){
        $name = 'World';
        return $this->render(
            'home/home.html.twig',
            array ('name' => $name));
    }
}