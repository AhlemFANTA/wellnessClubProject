<?php

namespace App\Controller;

use Exception;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostType;
use App\Entity\Post;

class PostController extends AbstractController
{
    /**
     * @Route("/new/post",name= "wellness_post_new")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function createPost(Request $request)
    {
        $post = new Post();
        $post->setDate(new \DateTime('now'));
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $this->addFlash('success', 'Article Created! Knowledge is power!');

        }
        return $this->render('post/createPost.html.twig', array(
            'form' => $form->createView(),
        ));
    }

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