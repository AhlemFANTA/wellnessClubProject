<?php

namespace App\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostType;
use App\Entity\Post;
use App\Entity\Comment;


class AdminController extends AbstractController
{
    /**
     * @Route("/new/post/admin",name= "wellness_post_new")
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
        return $this->render('admin/createPost.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/modify/post/{id}",name= "admin_modify_post")
     * @param Request $request
     * @param string $id
     * @return Response
     */
    public function modifyPost(string $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository(Post::class)->find($id);

        if (!$article) {
          throw $this->createNotFoundException(
            'No post found for id '.$id
          );
        };

        $form = $this->createForm(PostType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setTitle($form["title"]->getData());
            $article->setContent($form["content"]->getData());
            $article->setAuthor($form["author"]->getData());
            $em->flush();
            $this->addFlash('success', 'Article was updated successfully!');
        };
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findAllFromArticle($id);

        return $this->render('admin/modifyPost.html.twig', array(
            'form' => $form->createView(),
            'article' => $article,
            'comments' => $comments,
            'id' => $id
        ));
    }

    /**
     * @Route("/admin/posts/show", name= "wellness_posts_list")
     * @return Response
     */
    public function showPostAdmin(): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $articles = $entityManager->getRepository(Post::class)->findAll();

        return $this->render('admin/getPostsAdmin.html.twig', array('articles' => $articles));
    }

    /**
     * @Route("admin/modify/post/{id}/comment/{comment_id}/supprimer")
     */
    public function supprimerComment(string $id, string $comment_id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $comment = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->find($comment_id)
            ->setIsVisible(0);
        $entityManager->flush();
        return $this->redirectToRoute('admin_modify_post',
        ['id' => $id]);
    }

}
