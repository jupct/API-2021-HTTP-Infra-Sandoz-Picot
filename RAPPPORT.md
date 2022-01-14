# API-2021-HTTP-Infra-Sandoz-Picot

## Step 1: Static HTTP server with apache httpd

Pour la première étape nous allons configuré un serveur statique apache. Nous utilisons une image docker pour le server, l'image php trouvé sur docker hub [php](https://hub.docker.com/_/php "lien à docker hub") .

Pour lancer le serveur il faut commencer par créer l'image docker. Il faut exécuter la commande suivant dans le dossier *docker-images/apache-php-image*.

`docker build -t api/apache-php-image .`

Puis lancer l'application à l'aide de la commande suivante.

`docker run -p 8080:80 api/apache-php-image`

si dans un navigateur vous vous connecter à `localhost:8080`, vous serez accueilli par cette page:
![serveur apache](images-rapport/accueil_site_static_apache.PNG "image serveur apache")

### Configuration

dans le dossier docker-images/apache-php-image, il y a deux éléments
![contenu dossier](images-rapport/contenu_dossier_apache-php-image.PNG)

le dossier content contient tous les éléments pour l'affichage du serveur. Le modèle du serveur est disponible [içi](https://startbootstrap.com/theme/grayscale)

le fichier Dockerfile permet de générer une image docker. Son contenu est assez court, juste deux lignes.
`FROM php:7.2-apache` qui permet de préciser quelle version de apache nous utilisons.
`COPY content/ /var/www/html/` qui permet de copier les composants du site dans /var/html/html/ qui est le chemin que le serveur va utilisé pour afficher le site.


## Step 2: Dynamic HTTP server with express.js

Nous allons ensuite lancer un serveur dynamic qui retournera du contenu JSON, celui-ci sera une liste d'adresse.

Depuis le dossier courant *docker-images/express-image*, exécuter dans une console de commande

`docker build -t api/express-image .`

Puis lancer l'application à l'aide de la commande suivante.

`docker run -p 9000:3000 api/express-image`

Il est important de noter que ce container docker est de base à l'écoute sur le port 3000.
