<?php

namespace App\DataFixtures;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($count = 0; $count < 20; $count++) {
            $comment = new Post();
            $comment->setPrenom("Jane". $count);
            $comment->setNom("Doe");
            $comment->setEmail("email@exemple.fr");
            $comment->setContent("Je deteste cet article.");

            $manager->persist($comment);
        }
        $manager->flush();
    }
}
