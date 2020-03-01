<?php

namespace App\Controller\Comment;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CommentType;
use App\Entity\Comment;
use App\Service\CommentSubmitter;

class CommentController extends AbstractController
{
  /**
   * @Route("/article/{id}", name= "get_comments")
   */
  public function getComments(string $id, Request $request, CommentSubmitter $commentSubmitter): Response {
    $comment = new Comment();
    $form = $this->createForm(CommentType::class, $comment);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      // submit form data to database
      $commentData = $form->getData();

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($commentData);
      $entityManager->flush();
    };
    return $this->render('comment/commentBlock.html.twig',
    array('id'=>$id, 'form'=>$form->createView()));
  }
}
