<?php
namespace App\Controller\Post;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostType;
use App\Entity\Post;

class CreateController extends AbstractController
{
    /**
     * @Route("/form/new")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $article = new Post();
        $article->setTitle('Citation');
        $article->setContent('Je gagne mes batailles avec le rêve de mes soldats.');
        $article->setAuthor('Napoléon Bonaparte');

        $form = $this->createForm(PostType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($article);
        }

        return $this->render('post/createPost.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}