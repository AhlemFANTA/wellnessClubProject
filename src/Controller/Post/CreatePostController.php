<?php
namespace App\Controller\Post;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostType;
use App\Entity\Post;

class CreatePostController extends AbstractController
{
    /**
     * @Route("/new/post")
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


}