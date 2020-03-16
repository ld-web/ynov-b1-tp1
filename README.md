# YNOV - B1 - TP1

Vous allez réaliser un système permettant d'enregistrer des voitures dans une base de données et de les administrer.

## Mode de rendu

Lien vers votre dépôt Git, que je pourrai clôner.

## Critères d'évaluation

- Utilisation de l'inclusion de fichiers
- Séparation de templates
- Création de fonctions pour mieux séparer / organiser / réutiliser votre code
- Utilisation de PDO pour effectuer des requêtes (préparées ou non) vers la base de données

## Fonctionnalités attendues

L'application web devra permettre de :

- Consulter les voitures **visibles** sur la page d'accueil
- Rechercher une voiture par nom
- Remplir un formulaire de saisie d'une nouvelle voiture
- Estimer automatiquement le prix d'une voiture **en fonction de plusieurs paramètres**
- Consulter toutes les voitures sur une page d'administration
- Filtrer dans cette page d'administration de liste de voitures par voiture visible / non visible
- Modifier une voiture
- **Bonus** : Supprimer une voiture

> Pour le moment nous n'avons pas vu les sessions, donc la page d'administration ne sera pas protégée derrière une authentification. Réalisez les pages d'"administration" comme des pages publiques

## Pages

- Accueil (liste des voitures visibles avec un formulaire de recherche par nom)
- Enregistrement d'une nouvelle voiture (formulaire de saisie d'une voiture)
- Administration : liste de toutes les voitures avec un filtre visible / non visible
- Modification d'une voiture : formulaire de saisie dont les champs contiendront les informations de la voiture en cours de modification
- **Bonus** : Suppression d'une voiture

## Apparence de l'application

Vous utiliserez Bootstrap pour réaliser l'interface de l'application.
Vous réaliserez un layout avec cette structure :

- Header
- Navigation (menu)
- Contenu
- Footer

> Le layout sera le même pour les pages "publiques" et les pages d'administration

## Structure de la base de données

Vous créerez une table `voiture` dans une base de données, contenant les champs suivants :

| Champ | Type | Commentaire |
|---|---|---|
| ID | INT | PRIMARY KEY, AUTO INCREMENT |
| nom | VARCHAR(255) |
| annee_sortie | INT | Il s'agit de l'année à laquelle la voiture est sortie |
| nb_km | INT | Le nombre de kilomètres de la voiture |
| prix | FLOAT | L'estimation du prix de la voiture |
| visible | TINYINT | Indique si la voiture doit être visible sur la partie publique ou non |

## Note sur les formulaires

### ***Vous êtes libres pour la définition de la cible de chaque formulaire de l'application : la page elle-même, ou bien une page séparée. Le seul cas "évident" où vous aurez la cible sur la même page se trouve dans le formulaire de recherche d'une voiture, sur la page d'accueil***

## Page d'accueil

La page d'accueil du site affichera toute les voitures visibles. A partir d'un formulaire de recherche, on pourra saisir un nom, puis valider. La page se mettra donc à jour avec la liste des voitures correspondantes.

> Attention, prévoyez le cas où il n'y a aucun résultat avec un simple message "Aucun résultat trouvé" par exemple !
>
> Pensez à utiliser les **requêtes préparées** pour filtrer la saisie utilisateur

## Formulaire d'enregistrement d'une nouvelle voiture

Cette page, que vous pourrez par exemple appeler `new.php`, contiendra un formulaire permettant de saisir une nouvelle voiture.

On retrouvera les champs suivants dans ce formulaire :

- Nom
- Année de sortie
- Nombre de kilomètres

> Pas besoin de mettre une case à cocher "visible", c'est une information interne que nous pourrons changer depuis notre interface d'administration

A la création d'une voiture, lorsque vous traiterez le formulaire, vous calculerez une estimation du prix de la voiture.

Pour ce faire, vous allez créer une **fonction d'estimation de prix**, qui prendra en paramètre l'année de sortie et le nombre de kilomètres. Elle retournera, en sortie, le prix estimé.

> **Vous êtes libres sur le choix de l'algorithme de calcul de prix. Ce que j'évalue ici, ce n'est pas votre capacité à calculer le prix d'une voiture sur la base de son année de sortie et son nombre de kilomètres, mais votre capacité à créer une fonction, dans un fichier séparé, puis l'utiliser ailleurs, quand vous en avez besoin**

Enfin, le prix estimé sera à inclure dans votre requête d'insertion d'une nouvelle voiture.

## Page d'administration des voitures (liste)

Cette page, qui pourra par exemple s'appeler `admin.php`, présentera par défaut la liste de toutes les voitures.

Un petit formulaire avec une case à cocher, et un bouton "Mettre à jour" à côté, permettra de filtrer les voitures visibles / non visibles.

Dans cette liste, pour chaque élément, vous aurez donc un lien "Modifier", permettant d'accéder à la page de modification d'une voiture.

> - Utilisez un paramètre `GET` contenant l'ID de la voiture pour la retrouver lorsque vous accédez à votre page de modification
>
> - Pensez à étudier les possibilités de définition et utilisation d'une fonction de récupération de voitures, pouvant être utilisée à la fois sur la page d'accueil de l'application et sur cette page d'administration

## Page de modification d'une voiture

Cette page contiendra un formulaire de modification d'une voiture.

> Vous récupérerez l'ID passé en paramètre `GET` afin de faire une requête vers votre base de données et récupérer les informations de la voiture, pour les injecter dans les champs de votre formulaire

On retrouvera donc les champs suivants :

- Nom
- Année de sortie
- Nombre de kilomètres
- Visible / non visible (car nous sommes dans la partie administration)

> La mise à jour impliquera la mise à jour de l'estimation du prix ! Si vous changez l'année et/ou le nombre de kilomètres, alors le prix estimé doit être mis à jour
>
> Utilisez une requête `UPDATE` pour mettre à jour une voiture

## BONUS : suppression d'une voiture

Pour celle/ceux qui arriveront là, ou bien celles/ceux qui veulent des points bonus et se sentent de réaliser cette petite fonctionnalité, implémentez le mécanisme de suppression d'une voiture.

Dans la liste de voiture affichée dans la page d'administration, ajoutez un lien "Supprimer", permettant de supprimer une voiture. Vous êtes libres sur la manière d'implémenter cette fonctionnalité.
