<?php

namespace App\Controller\Comment;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SubmitCommentController extends AbstractController
{
  /**
   * @Route("/article/{id}/success", name= "successful_submit")
   */
  public function submitted(string $id): Response {
    return $this->render('comment/submittedComment.html.twig', array('id'=>$id));
  }
}
