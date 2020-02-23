<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostType;
use App\Entity\Post;

class FormController extends AbstractController
{
    /**
     * @Route("/form/new")
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

        return $this->render('form/new_post.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}