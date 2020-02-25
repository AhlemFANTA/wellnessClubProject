<?php


namespace App\Controller\Post;

use App\Entity\Post;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PostController extends AbstractController
{
    /**
     * @Route("/show/feed", name= "wellness_link_list")
     */
    public function showPost(): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $articles = $entityManager->getRepository(Post::class)->findAll();

        return $this->render('post/postLink.html.twig', array ('articles'=>$articles));
    }

    /**
     * @Route("links/create", name= "wellness_link_create")
     * @param Request $request
     * @return Response
     */
    public function createPost(Request $request) : Response
    {
        $link = new Link();
        $form = $this->createFormBuilder($link)
            ->add('name', TextType::class)
            ->add('path', UrlType::class)
            ->add('description', TextType::class)
            ->add('save', SubmitButton::class)
            ->getForm()
        ;
        if ($form->isSubmitted()){
            dd($form);
        }
        return $this->render(':post:createPost.html.twig',[
            'form' =>$form->createView()
        ]);
    }

}