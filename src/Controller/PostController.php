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

        return $this->render('post/getPosts.html.twig', array('articles' => $articles));
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

        $comment = new Comment();
        $comment->setArticleId($id);
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // soumettre form data à BDD
            $commentData = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commentData);
            $entityManager->flush();
        };
        // get all comments
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findAllFromArticle($id);

        return $this->render('post/getPost.html.twig', array('article' => $article,
        'comments'=>$comments,
        'submitForm'=>$form->createView(),
        'id'=>$id,
        'replying'=>'0'));
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
        $repondre = new Comment();
        $repondre->setParentId($comment_id);
        $repondre->setArticleId($id);
        $form = $this->createForm(CommentType::class, $repondre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // submit form data to database
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
        // get all comments from that article
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findAllFromArticle($id);


        return $this->render('post/getPost.html.twig', array('article' => $article,
        'comments'=>$comments,
        'repondreForm'=>$form->createView(),
        'id'=>$id,
        'replying'=>'1',
        'comment_id'=>$comment_id));
    }
}
