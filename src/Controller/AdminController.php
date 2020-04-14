<?php

namespace App\Controller;

use App\Service\FileUploader;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
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
     * @param FileUploader $fileUploader
     * @return Response
     * @throws Exception
     */
    public function createPost(Request $request, FileUploader $fileUploader)
    {
        $post = new Post();
        $post->setDate(new \DateTime('now'));
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $picFile */
            $picFile = $form['image']->getData();
            if ($picFile) {
                $picFileName = $fileUploader->upload($picFile);
                $post->setPicFilename($picFileName);
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            $this->addFlash('success', 'Article crée! Knowledge is power!');
            /*return $this->redirectToRoute('wellness_posts_list');*/
        }
        return $this->render('admin/createPost.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/supprimer/post/{id}",name= "admin_supprimer_post")
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function supprimerPost(string $id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository(Post::class)->find($id);
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute('wellness_posts_list');
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
                'No post found for id ' . $id
            );
        };
        // créer un formulaire pour pouvoir modifier l'article
        $form = $this->createForm(PostType::class, $article);
        $form->handleRequest($request);
        // modifier l'article dans le BDD si le formulaire est soumis
        if ($form->isSubmitted() && $form->isValid()) {
            $article->setTitre($form["titre"]->getData());
            $article->setContenu($form["contenu"]->getData());
            $article->setAuteur($form["auteur"]->getData());
            $article->setPicFilename(
                new File($this->getParameter('pictures_directory') . '/' . $article->getPicFilename())
            );
            $em->flush();
            $this->addFlash('success', 'Article was updated successfully!');
        };
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findAllFromArticle($id);
        // encore la vue de modifier l'article
        return $this->render('admin/modifyPost.html.twig', array(
            'form' => $form->createView(),
            'article' => $article,
            'comments' => $comments,
            'id' => $id,
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
        $comment_counts = [];
        // trouver le nombre de commentaires pour chaque article
        for ($i=0; $i<count($articles); $i++) {
          $comments = $this->getDoctrine()
              ->getRepository(Comment::class)
              ->findAllActiveFromArticle($articles[$i]->id);
          array_push($comment_counts, count($comments));
        }
        return $this->render('admin/getPostsAdmin.html.twig', array(
          'articles' => $articles,
          'comment_counts'=>$comment_counts,
        ));
    }

    /**
     * @Route("admin/modify/post/{id}/comment/{comment_id}/supprimer")
     */
    public function supprimerComment(string $id, string $comment_id, Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        // // rendre le commentaire non rendu, mais toujours stocké dans le BDD
        $comment = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->find($comment_id)
            ->setIsVisible(0);
        $entityManager->flush();
        return $this->redirectToRoute('admin_modify_post', ['id' => $id]);
    }
}
