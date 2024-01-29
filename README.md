# Minecraft Recipes

## Hébergement

Le projet est hébergé sur le serveur de l'IUT aux adresses suivants :
- API : https://webinfo.iutmontp.univ-montp2.fr/~jalbaudl/minecraft-api/api
- Front : https://webinfo.iutmontp.univ-montp2.fr/~jalbaudl/minecraft-front
- MyAvatar : https://webinfo.iutmontp.univ-montp2.fr/~jalbaudl/minecraft-avatar

Il est aussi possible de lancer le projet en local en [suivant les instructions ci-dessous](#utiliser-lapplication-en-local)

## Repo git

Tous les projets ont été créés sur le même repo git dont voici le lien: https://github.com/G1-Minecraft/minecraft-recipes

La maquette Figma du site est disponible à cette adresse:
https://www.figma.com/file/sF9B8Hfis3CBfcBSZhrRWN/Front?type=design&node-id=16%3A2&mode=design&t=YHOu9PTaeYPSuqL2-1

## Thème

Nous avons choisi le thème des recettes (crafts) de Minecraft, c'est le système permettant de creer de nouveaux items ou blocks afin de progresser dans le jeux.
Dans notre établi (crafting table), il y a une grille de 9 cases, dans chacune d'entre elle, il est possible de déposer un item.
La combinaison de ces items ainsi que leur positionnement définit le résultat existant ou non du craft.
Des exceptions existent où le positionnement n'est pas pris en compte dans le craft.

En plus de ce système de recettes, nous avons aussi décidé d'ajouter le système de cuisson et d'alchimie.
La cuisine consiste simplement à faire cuire un item avec du combustible pour en obtenir sa version fondue (le verre pour le sable) ou cuite (les viandes).
L'alchimie est un mécanisme plus avancé consistant a mélanger des ingrédients afin d'obtenir des potions ayant différents effets.

## API

Dans l'objectif d'avoir un système de recettes généralise, notre API contient plusieurs entités.

- les Items: ingrédients de bases ou résultants.
- les Crafts: entité conservant les informations sur l'item résultant ainsi que sa quantité.
- les CraftSlots: entité possédant les informations d'un item utilisé lors d'un craft ainsi que sa position dans le craft.
- les Users: notre système d'utilisateurs avec authentification et retenant les items et crafts créées.

## Front

L'application VueJS utilise l'API pour les échanges de données avec la base données et MyAvatar pour l'image de l'utilisateur.

Le front dispose :
- Une page d'accueil avec la possibilité de voir les crafts des items à partir d'une table de craft (dans le futur on rajoutera les crafts via fours et alambiques).
- Une page de connexion et inscription pour les utilisateurs
- Une page de création d'items et de crafts

## MyAvatar

Le projet My Avatar est une application Symfony server-side qui possède un système d'utilisateur classique et qui a pour fonction principale la mise à disposition d'une route permettant de requêter l'avatar d'un utilisateur.

Les avatars des utilisateurs sont stockés sur le serveur sous un nom correspondant à l'email de l'utilisateur en md5. Les formats acceptés sont jpg et png. Ces images sont automatiquement mises à jour en fonction des différentes actions réalisables par l'utilisateur sur son profil qui est modélisé de la manière suivante : 
- Adresse mail représentant son identifiant unique
- Mot de passe
- Photo de profil (avatar)

Un changement de l'adresse mail entraîne automatiquement un changement du nom de fichier de son avatar pour correspondre à sa nouvelle adresse. La suppression de compte est également gérée en supprimant dans la foulée l'image de l'utilisateur, avant de le déconnecter et de le ramener sur la page de connexion.

Pour récupérer un avatar il suffit donc d'effectuer une requête en get vers urlserveur/avatar/mailmd5 avec mailmd5 étant la valeur de l'email utilisateur actuel hash en md5.

## Investissement

- Hugo du Peloux: architecture globale, dockerisation, base de données et API
- Hugo Siliveri: Maquette du site, page d'accueil et style
- Alexandre Machu: Footer/header front
- Lucas Jalbaud: Utilisateur (en partie), création de crafts et items dans le front 
- Benjamin Cayroche: My Avatar

## Identifiants

//TODO: créer un jeu de données et l'exporter en .sql puis ajouter les identifiants.

## Utiliser l'application en local

Le projet étants entièrement dockerisé par un système de docker compose, il suffit juste de mettre à jour les valeurs (principalement les mots de passe) dans le fichier `docker-compose.yml` (ou de créer un `docker-compose.override.yml`) et d'exécuter la commande `docker compose up -d` pour démarrer l'ensemble des applications.
Par défaut, les images de production seront utilisées, mais il est possible en changeant les valeurs des images dans le `docker-compose.yml` (ou le `.override.yml`) d'utiliser les images de dev qui montent un volume sur les projets pour pouvoir tester les changements en direct.
En cas d'utilisation de l'application en mode des, il faut aussi executer la commande `php bin/console lexik:jwt:generate-keypair` afin de generer les identifiants necessaire pour la creation des tokens JWT.

voici un template de `docker-compose.override.yml`
```yml
services:
  minecraft-db:
    environment:
      - MYSQL_ROOT_PASSWORD={{ApiDatabasePassword}}
    healthcheck:
      test: "mysql -p{{ApiDatabasePassword}} -e 'SELECT 1'"

  minecraft-api:
    image: minecraft-api-dev
    build:
      dockerfile: dev.dockerfile
      args:
        - DATABASE_PASSWORD={{ApiDatabasePassword}}
    volumes:
      - ./minecraft-api:/home/minecraft-api

  minecraft-front:
    image: minecraft-front-dev
    build:
      dockerfile: dev.dockerfile
    volumes:
      - ./minecraft-front:/home/minecraft-front

  minecraft-avatar:
    image: minecraft-avatar-dev
    build:
      dockerfile: dev.dockerfile
      args:
        - DATABASE_PASSWORD={{AvatarDatabasePassword}}
    volumes:
      - ./minecraft-avatar:/home/minecraft-avatar

  minecraft-avatar-db:
    environment:
      - MYSQL_ROOT_PASSWORD={{AvatarDatabasePassword}}
    healthcheck:
      test: "mysql -p{{AvatarDatabasePassword}} -e 'SELECT 1'"
```
