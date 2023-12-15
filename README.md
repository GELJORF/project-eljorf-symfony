# Projet Symfony

Nous avons repris, afin de réaliser ce projet, l'idée du projet PHP auparavant présenté, à savoir un site didactique d'apprentissage de langues. L'objectif est de tenter de reproduire les mêmes fonctionnalités, mais cette fois avec un framework Symfony.  
Bien que nous avions commencé avec la dernière version de Symfony (7.0), des problèmes d'affichage du contenu nous ont contraint à reprendre la version (5.4.33) pour concevoir le site.

## Intoduction

Nous avons opté pour une mise en forme avec des fiches personnalisées CSS, donc sans faire appel à des librairies comme Bootstrap ou Tailwind. Force est de constater que ce n'était pas une bonne décision ; générer ses propres fichiers css peut s'avérer long, sans parler des nombreuses difficultés rencontrées pour afficher correctement ces styles, bien que nous avonis bien respecté les chemins et l'inclusion des fichiers, et régulièrement vidé le cache (en utilisant la commande `php bin/console cache:clear`). Il a fallu, parfois, supprimer le fichier Css et le créer de nouveau, avec exactement le même chemin (en utilisant `asset`) : le nom du dossier dans le répertoire `public` puis le nom du fichier, pour que cela fonctionne, sans pouvoir en expliquer la raison. Donc, nous ne manquerons pas, pour les prochains travaux, d'utiliser une librairie pour styliser notre site.

Ensuite, certaines pages, informatives, de notre site PHP ont été délaissées, faute de temps et au profit des fonctionnalités principales du framework Symfony.  
Ainsi, notre site comprend les pages suivantes: Accueil, À propos (vide), cours, Newsletter, Contact, inscription et connexion.  
Ces pages ont été créées en utilisant des controllers. Le menu, lui, a été créé avec la fonction privée `getMenu` qui retourne un tableau associatif responsable de générer (avec `generateUrl`) les liens des pages.  
Il en va de soi pour le footer avec la fonction privée `getFooter` qui retourne un tableau contenant le nom des onglets du menu footer, mais sans les liens, car nous n'avons pas créé des controllers pour le footer.

## Fonctionnalités du site

### Les données de test (fixtures)

Le fichier `AppFixtures.php` permet de créer de créer un contenu de cours (fictif) et de l'intégrer à la base de données, le cours (fictif) sera affiché dans la rubrique "Cours" du site. Évidemment, une entité indépendante (à nommer "Lesson" ou "Cours") devra être créee afin d'afficher, dans l'onglet dédié "Cours", la liste des cours déjà disponiblées et à laquelle les nouveaux inscrits peuvent avoir accès.  
Le fichier `UserFixture.php` permet d'essayer la fonctionnalité de connexion d'un nouvel utilisateur.

### Contacter le site

Un formulaire de contact a été créé, ainsi que deux méthodes dans le chemin `templates\contact\`, à savoir `index.html.tiwg` pour le formulaire de contact utilisé par le visiteur du site, et `confirmation.html.twig` qui permet d'afficher un message de confirmation de la bonne réception du message envoyé.

### Newsletter

Un formulaire d'inscription au bulletin d'information du site a été créé, qui utilise l'enttié `NewsletterSubscription` ainsi que deux méthode : `templates\newsletter\index.html.twig` pour le formulaire de contact, et `templates\newsletter\emails\confirmation.html.twig` pour l'envoi du message de confirmation de l'inscription.

### Inscription

Le contrôleur d'inscription utilise l'entité `User` afin de créer un nouvel utilisateur `new User`, que l'on va "persister" et "flusher", ainsi qu'un formulaire d'inscription. Le mot de passe est haché avec `hashPassword` ; l'inscription réussie est accompagnée par un message "Flash" `success` avant que l'utilisateur ne soit redirigé vers la page d'accueil.

### Connexion

Elle est gérée par `LoginFormAuthenticator` qui gère le processus d'authentification pour les utilisateurs qui se connectent via un formulaire de connexion. `LoginFormAuthenticator` traite les informations de connexion, gère les succès et échecs d'authentification, et redirige les utilisateurs en fonction de ces événements.  
La connexion ne fonctionne pas encore correctement dans notre application, car lors de la soumission du formulaire, un message "invalid credentials" est affiché.