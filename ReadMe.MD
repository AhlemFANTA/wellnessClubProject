# I - Description
### Mission : 

Développement d'un blog de bien-être administré par les modérateurs de l'entreprise **Symfeed**.

Ce blog nommé __"WellnessClub"__ est implémenté en langage de programmation PHP avec le Framewok Symfony 5   
*ORM : Doctrine  
SGBD : MySQL 8.0.18  
Test : Fixtures*

__Ce projet contient les fonctionnalités suivantes__ :
-  Gestion des articles (CRUD + affichage + Tests),
-  Gestion des commentaires et des avis (CRUD + affichage + Tests),
-  Gestion du système d'envoi de mail (avec le composant mailer de Symfony),  
-  Gestion du compte Admin (connexion, CRUD compte Admin, réinitialisation du mot de passe).  


__Le Blog comprend les services suivants:__
- Lire les articles du blog
- Commenter un ou plusieurs articles,
- Répondre à un commentaire,
- Supprimer son commentaire,
- Noter l'article de 0 à 5
- Contacter l'administrateur via le formulaire de contact,
- Se connecter entant qu'Admin, et donc avoir en plus les privilèges suivants : 
  - Ajouter un nouveau article avec image,
  - Modifier un article,
  - Supprimer un article, 
  - Ajouter  un commentaire, 
  - Répondre à un commentaire,
  - Supprimer un commentaire.



# II - Lancement

## 1. Prérequis
- Installer les dépendences du projet en utilisant la commande suivante :  
   `composer install`
    
- Créer la base de données MySQL en utilisant les commandes suivantes :
	```
      php bin/console doctrine:database:create
      php bin/console make:migration
      php bin/console doctrine:migrations:migrate --no-interaction
      php bin/console doctrine:fixtures:load --group=PostCommentFixtures --no-interaction

- Compiler assets et générer le dossier build en utilisant la commande suivante :  
     `yarn encore dev`
- Modifier le fichier .env selon votre configuration (BDD, @mail...)

## 2. Exécution du service
Le service se lance et tourne sur le port 8080 en utilisant la commande suivante : `php -S 127.0.0.1:8000 -t public`  
Pour se connecter en tant qu'administrateur du blog utiliser le mail et le mot de passe (d'initialisation) ci-dessous ;  
 PS : une fois connecté, vous pouvez créer votre propre compte.   
*Adresse mail : admin@wellnessClub.com   
Mot de passe :  password*

## III - Captures
Accueil :
![Homepage](docs/images/homepage.png)

Qui somme-nous ? :
![About Us](docs/images/aboutUs.png)

Gestion des comptes Admin :
![Post](docs/images/accountCRUD.png)

Gestion des articles :
![Post](docs/images/postCRUD.png)

Gestion des commentaires :
![Post](docs/images/commentCRUD.png)

Avis :
![Post](docs/images/avis.png)

Contact :
 ![Post](docs/images/contactUs.png)
