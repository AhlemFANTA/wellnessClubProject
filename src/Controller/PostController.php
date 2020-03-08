<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

    /**
     * @Route("/show/posts", name= "wellness_post_list")
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
    public function getPost($id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Post::class)->find($id);

        return $this->render('post/getPost.html.twig', array('article' => $article));
    }


}