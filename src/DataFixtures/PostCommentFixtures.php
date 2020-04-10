<?php

namespace App\DataFixtures;
use Faker\Factory;
use App\Entity\Post;
use App\Entity\User;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PostCommentFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');
        //Nous gérons les utilisateurs
        $users = [];
        for($i=1;$i<=10;$i++)
        {
            $user = new User();
            $hash = $this->encoder->encodePassword($user,'password');
            $user->setFirstName($faker->firstname)
                 ->setLastName($faker->lastname)
                 ->setEmail($faker->email)
                // ->setInstroduction($faker->sentence())
                 ->setHash($hash);
            //on demande au manger de sauvegarde
            $manager->persist($user); 
            $users[] = $user;    
        }

        /*
        for ($count = 1; $count < 3; $count++) {
            $article = new Post();
            $article->setTitle("Titre"." ". $count);
            $article->setAuthor("Napoléon Bonaparte");
            $article->setContent("Je gagne mes batailles avec le rêve de mes soldats.");
            $article->setDate(new \DateTime('now'));
        }*/
        $article1 = new post();
        $article1->setTitre("Manger des insectes n’est pas sans risque");
        $article1->setAuteur("Ahlem");
        $article1->setContenu("Selon l'ANSES, les insectes peuvent contenir des substances chimiques (venins, facteurs antinutritionnels, médicaments vétérinaires utilisés dans les élevages d’insectes, pesticides ou polluants organiques présents dans l’environnement ou l’alimentation des insectes, etc.) dangereuses pour notre santé. Dans certaines régions du monde comme l’Asie, la consommation d’insectes fait partie de la culture alimentaire traditionnelle. En Europe et notamment en France, cette pratique compte déjà de nombreux adeptes mais ne bénéficie d’aucune réglementation. C’est pourquoi l’ANSES publie ce jour un avis dans lequel elle dresse un état des lieux des risques liés à la consommation d’insectes, ainsi qu’une liste de recommandations ayant pour objectif “la mise en place de normes spécifiques et un encadrement adapté“.DES CONDITIONS D'ÉLEVAGE QUI RESTENT FLOUES Certes les insectes sont très intéressants d'un point de vue  nutritionnel, économique et écologique, mais les manger nous expose aussi à des risques sanitaires. Ces petites bêtes peuvent contenir des substances chimiques (venins, facteurs antinutritionnels, médicaments vétérinaires utilisés dans les élevages d’insectes, pesticides ou polluants organiques présents dans l’environnement ou l’alimentation des insectes, etc.) dangereuses pour notre santé. Dans son avis, l’ANSES explique que le danger sanitaire peut ainsi provenir des conditions d’élevage et de production d’insectes qui ne bénéficient pas, pour l’heure, d’un encadrement spécifique. Et comme pour n’importe quel aliment d’origine animale ou végétale, une conservation non adaptée d’insectes peut les rendre impropres à la consommation humaine.GARE AUX ALLERGIES ET AUX VIRUS TRANSMIS PAR LES INSECTES ! Aussi, chez les personnes présentant des prédispositions aux allergies, la consommation  d’insectes présentant les mêmes allergènes que de nombreux arthropodes (acariens, crustacés, mollusques, etc.) est risquée. Enfin, les insectes sont parfois porteurs de virus, bactéries, parasites ou encore de champignons qu’ils peuvent transmettre à l’homme. ÉTABLIR UNE LISTE DES ESPÈCES POUVANT OU NON ÊTRE CONSOMMÉES Face à ce manque de connaissances sur les risques liés à la consommation d’insectes, l’Agence recommande : d’établir une liste des espèces pouvant ou non être consommées d’encadrer les conditions d’élevage et de production d’insectes d’alerter les consommateurs  sur le risque allergique lié à la consommation d’insectes de mener plus de recherches sur les sources de dangers potentielles d’étudier la question du bien-être animal pour les insectes Selon les données actuelles, les insectes consommés le plus couramment sont les coléoptères, les chenilles, les abeilles, les guêpes et les fourmis. Viennent ensuite les sauterelles, les criquets et les grillons, les cigales, les cochenilles et les hémiptères, les termites, les libellules et les mouches.");
        $article1->setDate(new \DateTime('now'));
        $manager->persist($article1);
        $manager->flush();

        $article2 = new post();
        $article2->setTitre("Comment l’entraînement vous rend heureux");
        $article2->setAuteur("Ahlem");
        $article2->setContenu("Beaucoup d’entre vous l’ont probablement déjà remarqué. Cela peut provenir du sentiment de pure satisfaction après une séance terminée ou de la joyeuse anticipation de celle qui va suivre – ou juste de la confiance croissante en vos propres capacités. Les responsables sont des processus biochimiques qui libèrent dans l’organisme ce que l’on appelle l’hormone du bonheur. Les plus connues sont les endorphines, la dopamine et la sérotonine. Performance sportives d’excellence avec le dopamine Vingt minutes de running léger sont suffisantes pour augmenter de manière significative le niveau de dopamine. Dans les sports à haute intensité comme Freeletics, votre cerveau commence à libérer de la dopamine après quelques minutes. Cette libération vous rend plus alerte, plus centré et elle améliore votre concentration. Et pour couronner le tout, elle rend l’entraînement plus amusant ! Comme vous cherchez à atteindre cet état de bonheur à nouveau dès que possible, parfois il peut vous être difficile d’attendre votre prochaine séance d’entraînement. Plus vous vous entraînez, plus la production de dopamine sera grande. La dopamine est la principale raison pour laquelle vous vous sentez bien pendant l’exercice. La raison pour laquelle vous êtes capable de terminer votre séance d’entraînement, même si votre corps et votre esprit ont envie d’abandonner. Elle vous pousse au sommet de vos performances et vous permet de battre vos PBs. Après l’entraînement, le niveau de dopamine diminue alors que le niveau de sérotonine augmente. La sérotonine est un antagoniste hormonal de la dopamine et possède de nombreuses fonctions: Entre autres choses, elle est impliquée dans la régulation du cycle veille-sommeil et de la température corporelle ; elle contrôle l’appétit et diminue la sensibilité à la douleur. Elle est surtout connue comme une hormone de bien-être parce que sa libération procure un sentiment de satisfaction intérieure. Ainsi, une séance intense de Freeletics peut se traduire simplement par du bonheur ! Plus hereux à long terme! L’effet de ces hormones du bonheur n’est pas uniquement limité au moment de l’entraînement. Dans le cadre d’un effort physique réel, le cerveau ne libère de la dopamine et de la sérotonine que dans certaines régions. Mais si vous vous entraînez régulièrement, la concentration d’hormone augmente continuellement dans de nombreuses régions du cerveau. Une amélioration durable de la concentration et une augmentation de la sensation de bonheur et de satisfaction seront alors des effets secondaires agréables. Des séances d’exercices intenses et courts comme Freeletics aident aussi à réduire le niveau l’hormone de stress, le cortisol, même à long terme. Ainsi, votre résilience au stress augmente – que le stress soit d’origine physique ou mentale. Néanmoins, vous devez rester prudent. Trop d’exercice peut également avoir l’effet inverse et augmentez votre niveau de cortisol. Votre corps perçoit le surentraînement comme une forme de stress négatif. Par conséquent, vous devriez écouter votre corps ! Avec tous les petites sensations de succès accumulées après une séance d’entraînement, votre confiance en vous augmente jour après jour – et cela, vous pousse vers le haut pour atteindre des performances toujours meilleures. Ainsi n’êtes pas uniquement en meilleure forme et plus athlètique mais vous êtes également plus optimiste, confiant, satisfait, plein d’energie – et plus heureux !");
        $article2->setDate(new \DateTime('now'));
        $manager->persist($article2);
        $manager->flush();

        for ($count = 1; $count < 4; $count++) {
            $comment = new Comment();
            $comment->setPrenom("Jane". " ". $count);
            $comment->setNom("Doe");
            $comment->setEmail("email@exemple.fr");
            $comment->setContent("Merci pour cet article très utile, bon courage pour la suite ");
            $comment->setLikes(1);
            $comment->setArticleId(1);
            $manager->persist($comment);
        }
        $manager->flush();
    }
}