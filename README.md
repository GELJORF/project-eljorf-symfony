# Projet Symfony

Nous avons repris, afin de réaliser ce projet, l'idée du projet PHP auparavant présenté, à savoir un site didactique d'apprentissage de langues (à savoir l'arabe). L'objectif est de tenter de reproduire les mêmes fonctionnalités, mais cette fois avec un framework Symfony.

## Intoduction

Nous avons opté pour une mise en forme avec des fiches personnalisées CSS, donc sans faire appel à des librairies comme Bootstrap ou Tailwind. Force est de constater que ce n'était pas une bonne décision ; générer ses propres fichiers css peut s'avérer long et pénible, sans parler des nombreuses difficultés rencontrées pour afficher correctement ces styles, bien que nous avons bien respecté les chemins et l'inclusion des fichiers. Il a fallu, parfois, supprimer le fichier css et le recréer, avec exactement le même chemin (en utilisant `asset`) : le nom du dossier dans le répertoire `public` puis le nom du fichier, pour que cela fonctionne. Donc, nous ne manquerons pas, pour les prochains travaux, d'utiliser une librairie pour styliser notre site.

Ensuite, certaines pages, informatives, de notre site PHP ont été délaissées, faute de temps et au profit des fonctionnalités principales du framework Symfony.  
Ainsi, notre site comprend les pages suivantes: Accueil, À propos (vide), cours, Newsletter, Contact, inscription et connexion.  
Ces pages ont été créées en utilisant des controllers. Le menu, lui, a été créé avec la fonction privée `getMenu` qui retourne un tableau associatif responsable de générer (avec `generateUrl`) les liens des pages.  
Il en va de soi pour le footer avec la fonction privée `getFooter` qui retourne un tableau contenant le nom des onglets du menu footer, mais sans les liens, car nous n'avons pas créé des controllers pour le footer.

## Fonctionnalités du site