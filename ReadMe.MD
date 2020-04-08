# I - Description
Mission : Développement d'un blog de bien être ; conseils, actualités, articles ...

Ce Blog comprend les services suivants:
- Ajout d'un nouveau article,
- Modification d'un article,
- Suppression d'un article,
- Commenter un article,
- Répondre à un commentaire,
- Supprimer un commentaire,
- Envoyer un email via le formulaire de contact,
- Se connecter entant qu'Admin,
- Changement de mot de passe, etc..

Ce blog est implémenté en langage de programmation PHP avec le Framewok Symfony 5.
La couche persistance utilisee le SGBD MySQL.


# II - Lancement

## 1. Prérequis
- Installer les dépendences du projet en utilisant la commande suivante :
    - composer install
    
- Créer la base de données MySQL en utilisant les commandes suivantes :
	- php bin/console doctrine:database:create
	- php bin/console doctrine:schema:create
	- php bin/console doctrine:schema:update --force
	- php bin/console doctrine:fixtures:load --group=PostCommentFixtures --no-interaction

- Compiler assets et générer le dossier build en utilisant la commande suivante :
    -  yarn encore dev


## 2. Exécution du service
Le service se lance et tourne sur le port 8080 en utilisant la commande suivante :  php -S 127.0.0.1:8000 -t public


## III - Captures
Liste des services :
- ![Homepage](docs/images/homepage.png)

Liste des services visiteur :
- ![About Us](docs/images/aboutUs.png)

Test services admin:
- ![Post](docs/images/postCRUD.png)

