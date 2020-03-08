<?php

namespace App\DataFixtures;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 20; $count++) {
            $article = new Post();
            $article->setTitle("Titre". $count);
            $article->setAuthor("wellnessClub Team");
            $article->setContent("Je gagne mes batailles avec le rêve de mes soldats.");
            $article->setDate(new \DateTime('now'));

            $manager->persist($article);
        }
        $manager->flush();
    }
}
