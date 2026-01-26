Fonctionnalités attendues
Pages front-office accessibles aux utilisateurs
Accueil
Présente une vue d'ensemble du site (bannière, quelques produits en avant, description brève).

Qui sommes-nous ?
Page statique présentant l'équipe ou le concept derrière le site.

Articles (catalogue des produits)
Affiche la liste des produits disponibles (photo, nom, prix, description courte).
Possibilité de cliquer sur un produit pour voir une fiche produit détaillée.

Inscription/Connexion
Formulaire pour créer un compte utilisateur avec validation des données (ex. email valide, mots de passe correspondants).
Formulaire de connexion pour permettre aux utilisateurs de se connecter.
Authentification sécurisée (hachage des mots de passe via password_hash).

Panier
Les utilisateurs doivent pouvoir ajouter des articles dans leur panier depuis la page articles.
Une page dédiée permettra de visualiser le contenu du panier : liste des articles avec leur quantité et leur prix total.
Option pour supprimer un article du panier ou vider complètement le panier.

Back-office (administration)
Un espace réservé aux administrateurs pour gérer le site :
Connexion (authentification admin)
Authentification via un formulaire réservé aux administrateurs.

Gestion des produits (CRUD)
Ajouter un nouvel article (avec image, nom, description, prix, stock).
Modifier les informations d'un article existant.

Supprimer un article.
Afficher la liste des articles avec leurs détails.

Gestion des utilisateurs
Visualiser la liste des utilisateurs inscrits.
Supprimer un utilisateur si nécessaire.

Contraintes techniques
Base de données SQL :
Au minimum 5 tables :
users : pour gérer les utilisateurs (id, nom, email, mot de passe, rôle).
items : pour gérer les produits (id, nom, description, prix, stock, date de publication, image).
orders : pour gérer les commandes (id, id_user, id_item).
invoice : pour gérer la facture (id, id_user, date de transaction, montant, adresse de facturation, ville, code postal)
stock : pour gérer les quantités (id, it_item, quatité item en stock)

Relation entre les tables selon le modèle relationnel (ex. clefs étrangères).

Langages et outils :
PHP pour le back-end
HTML/CSS, JS etc… pour le front-end (vous êtes plutôt libres. Vous pouvez également utiliser Bootstrap).
MySQL pour la base de données.

Hébergement local :
Utilisez un serveur local (MAMP, XAMPP etc...).

Normes :
Validation des formulaires côté serveur et côté client.
Code PHP structuré avec commentaires pour chaque fonction ou classe.

Sécurité :
Hachage des mots de passe (password_hash) et répétition du mot de passe.
Sécurisation des adresses mail et évitez les doublons.
Validation des entrées pour éviter les injections SQL (utiliser des requêtes préparées).


Organisation du projet
Équipe
Le projet sera réalisé en groupes de 2 à 3 étudiants.

Livrables
Code source complet à déposer sur Github.
La date limite de rendu est le 15 février 2026 à 23h59. Seul le dernier commit avant cette date sera pris en compte. Chaque jour de retard entrainera des réductions de points.
Préparer le dépôt Github et rédiger un fichier README.md pour expliquer comment exécuter le projet.
