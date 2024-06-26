# Projet_WEB_PHP

Projet_WEB_PHP_S4
# Comment lancer notre projet sur votre ordinateur ? (suivre les étapes)
### En cas de problème, n'hésitez pas à nous contacter pour que nous puissions vous guider.
## Setup parseur si /vendor composer.json et composer.lock non crée et serveur

```bash
composer require smalot/pdfparser
```
Pour la partie serveur j'ai rentrée ses commandes dans le terminal :

```bash
npm list
npm i express
npm i express-session
npm i mysql
npm i cookie-parser
```

Pour lancer le serveur :

```bash
node server.js
```
Il ne faut pas oublier de lancer le serveur de la base de donnée

```bash
php -S localhost:8000
```

Ou aussi utiliser MAMP

## Gestionnaire de la base :

Pour la première connection il faut setup la base de donnée en hébérgant le projet puis en passant par ce liens
http://localhost/Projet_WEB_PHP_s4/Base_donnee/index.php

si vous voulez voir votre nouvelle base de donnée allez ici : http://localhost/phpMyAdmin/index.php?route=/database/structure&server=1&db=jreuttus_projet_web_s4

Si cela ne fonctionne pas il faut manuellement crée la base de donnée avec le nom suivant : jreuttus_projet_web_s4

Ensuite il faut importer le fichier sql qui se trouve dans le dossier Base_donnee et prendre la version N°10

si il y a une erreur concernant les triggers il faut retirer le code et les mettres apres l'initialisation de la base de donnée. 

## Accéder à l'accès Administrateur

Il suffit de se connecter normalement comme tout utilisateur en rentrant les codes suivants :

```py
admin.admin@student.junia.com
```

Mot de passe :

```py
admin
```

## Accéder à l'accès Administrateur

Code de confirmation mot de passe et confirmation de compte:
12345


## Assistance

Pour trouver nos informations de contact il vous suffit de vous rendre dans les mentions légales

## Utilisation

Une fois lancer si vous voulez tester notre systeme de note il vous suffit de vous connecter avec les identifiants cité dans notre contre rendu et d'ensuite ajouter des notes à des étudiants via les pds founis dans la racine du projet. Pour ne pas avoir les meme notes vous pouvez modifier les notes via la fonction de notre site web dans la page note.

Pour toute question ou problème n'hésitez pas à nous contacter nous sommes là pour vous aider et serions ravis de vous présenter notre projet en détails en présentielle ou en visioconférence.


## Fonctionnalités du site

- Inscription
- Connexion
- Déconnexion
- Modification de mot de passe
- Modification de profil
- Ajout de notes
- Modification de notes
- Filtrage de notes
- Recherche de notes
- Affichage de notes
- Affichage de moyenne
- Affichage de médiane
- Affichage de notes minimales
- Affichage de notes maximales
- Affichage de notes triées
- Affichage de notes non triées
- Affichage de notes par ordre croissant
- Affichage de notes par ordre décroissant
- Affichage de notes par matière
- Page admin
- Ajout de messages côté admin
- Suppression de messages côté admin
- Modification de messages côté admin
- Suppression des utilisateurs côté admin
- Modification des utilisateurs côté admin
- Ajout des utilisateurs côté admin
- Visualisations Graphiques des moyennes