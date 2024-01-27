# Minecraft Recipes

## Hébergement

//TODO: héberger le projet sur le serveur de l'IUT

## Repo git

Tous les projets ont été créés sur le même repo git dont voici le lien: https://github.com/G1-Minecraft/minecraft-recipes

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

//TODO: description du projet front

## MyAvatar

//TODO: description du projet MyAvatar

## Investissement

- Hugo du Peloux: architecture globale, dockerisation, base de données et API
- Hugo Siliveri: 
- Alexandre Machu: 
- Lucas Jalbaud: 
- Benjamin Cayroche: 

## Identifiants

//TODO: créer un jeu de données et l'exporter en .sql puis ajouter les identifiants.

## Utiliser l'application en local

Le projet étants entièrement dockerisé par un système de docker compose, il suffit juste de mettre à jour les valeurs (principalement les mots de passe) dans le fichier `docker-compose.yml` (ou de créer un `docker-compose.override.yml`) et d'exécuter la commande `docker compose up -d` pour démarrer l'ensemble des applications.
Par défaut, les images de production seront utilisées, mais il est possible en changeant les valeurs des images dans le `docker-compose.yml` (ou le `.override.yml`) d'utiliser les images de dev qui montent un volume sur les projets pour pouvoir tester les changements en direct.
