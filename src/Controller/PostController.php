<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

    /**
     * @Route("/show/posts", name= "wellness_posts")
     */
    public function showPost(): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $articles = $entityManager->getRepository(Post::class)->findAll();
        $comment_counts = [];
        // trouver le nombre de commentaires pour chaque article
        for ($i=0; $i<count($articles); $i++) {
          $comments = $this->getDoctrine()
              ->getRepository(Comment::class)
              ->findAllActiveFromArticle($articles[$i]->id);
          array_push($comment_counts, count($comments));
        }
        return $this->render('post/getPosts.html.twig', array(
          'articles' => $articles,
          'comment_counts' => $comment_counts,
        ));
    }

    /**
     * @Route("/get/post/{id}", name= "wellness_post")
     * @param $id
     * @return Response
     */

    public function getPost($id, Request $request): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Post::class)->find($id);
        // creér un formuliare pour soumettre un nouveau commentaire à le BDD
        $comment = new Comment();
        $comment->setArticleId($id);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentData = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentData);
            $entityManager->flush();
            //return $this->redirectToRoute('wellness_post_list');
        };
        // récupérer les commentaires de cet article
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findAllFromArticle($id);
        // vue d'article avec les commentaires
        return $this->render('post/getPost.html.twig', array(
          'article' => $article,
          'comments'=>$comments,
          'submitForm'=>$form->createView(),
          'id'=>$id,
          'replying'=>'0'
        ));
    }

    /**
     * @Route("/get/post/{id}/comment/{comment_id}/repondre", name= "post_reply")
     * @param $id
     * @param $comment_id
     * @return Response
     */
    public function getPostReply($id, Request $request, string $comment_id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Post::class)->find($id);
        // creér un formuliare pour soumettre un commentaire (réponse) à le BDD
        $repondre = new Comment();
        $repondre->setParentId($comment_id);
        $repondre->setArticleId($id);
        $form = $this->createForm(CommentType::class, $repondre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentData = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentData);
            $entityManager->flush();
            unset($form);
            $comments = $this->getDoctrine()
                ->getRepository(Comment::class)
                ->findAllFromArticle($id);
            return $this->redirectToRoute('wellness_post', ['id'=>$id]);
        };
        // récupérer les commentaires de cet article
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findAllFromArticle($id);
        // vue d'article avec l'abilité de répondre à un certain commentaire
        return $this->render('post/getPost.html.twig', array(
          'article' => $article,
          'comments'=>$comments,
          'repondreForm'=>$form->createView(),
          'id'=>$id,
          'replying'=>'1',
          'comment_id'=>$comment_id
        ));
    }
}
