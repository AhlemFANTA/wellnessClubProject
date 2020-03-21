<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\CommentType;
use App\Form\RepondreType;
use App\Entity\Comment;
use App\Service\CommentSubmitter;

class CommentController extends AbstractController
{

    /**
     * @Route("get/post/{id}/comment/{comment_id}/like")
     */
    public function likeComment(string $id, string $comment_id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $entityManager->getRepository(Comment::class)->find($comment_id);
        $likes = $comment->getLikes();
        $comment->setLikes($likes + 1);
        $entityManager->flush();
        return $this->redirectToRoute('wellness_post',
        ['id' => $id, 'comment_id'=>$comment_id]);
    }

    /**
     * @Route("get/post/{id}/comment/{comment_id}/supprimer")
     */
    public function supprimerComment(string $id, string $comment_id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->find($comment_id)
            ->setIsVisible(0);
        $entityManager->flush();
        return $this->redirectToRoute('wellness_post',
        ['id' => $id, 'comment_id'=>$comment_id]);
    }
}
