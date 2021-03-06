<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Service\CommentSubmitter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->redirectToRoute('wellness_post', [
            'id' => $id,
        ]);
    }

    /**
     * @Route("get/post/{id}/comment/{comment_id}/supprimer", name="supprimer_comment")
     */
    public function supprimerComment(string $id, string $comment_id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        // // rendre le commentaire non rendu, mais toujours stocké dans le BDD
        $comment = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->find($comment_id)
            ->setIsVisible(0);
        // rendre les réponses au commentaire non rendu aussi
        $subcomments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findAllSubcomments($comment_id);
        for ($i = 0; $i < count($subcomments); $i++) {
            $comment = $this->getDoctrine()
                ->getRepository(Comment::class)
                ->find($subcomments[$i]->id)
                ->setIsVisible(0);
        };
        $entityManager->flush();
        return $this->redirectToRoute('admin_modify_post', [
            'id' => $id,
        ]);
    }
}
