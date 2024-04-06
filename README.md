# Projet_WEB_PHP

Projet_WEB_PHP_S2

## Gestionnaire de la base :

Pour la première connection il faut setup la base de donnée en hébérgant le projet puis en passant par ce liens
http://localhost/Projet_WEB_PHP/Base_donnee/index.php

si vous voulez voir votre nouvelle base de donnée allez ici : http://localhost/phpMyAdmin/index.php?route=/database/structure&server=1&db=jreuttus_projet_web

### Setup parseur si /vendor composer.json et composer.lock non crée

il faut dans un premier temps intaller composer : https://getcomposer.org/download/

Ensuite il faut rentrer dans le terminal les commandes suivantes : 

```bash
composer
```

si le fichier composer.json ne se crée pas il faut le crée est y mettre les lignes suivantes :

```json
{
    "require": {
        "smalot/pdfparser": "^2.9"
    }
}
```

et ensuite rentrer la commande suivante :

```bash
composer install
```

#### Accéder à l'accès Administrateur

Il suffit de se connecter normalement comme tout utilisateur en rentrant les codes suivants :

```py
admin.admin@student.junia.com
```

Mot de passe :

```py
admin
```

#### Accéder à l'accès Administrateur

Code de confirmation mot de passe et confirmation de compte:
12345

##### Crée des graphiques ( en développement )

Pour pouvour crée des graphique il faut aller dans php.ini est ajouter la ligne suivante :

```py
extension=gd
```

###### Assistance

Pour trouver nos informations de contact il vous suffit de vous rendre dans les mentions légales


Pour la partie serveur j'ai rentrée ses commandes dans le terminal :

```bash
npm list
npm i express
npm i express-session
npm i mysql
npm i cookie-parser
```