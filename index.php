# Devoir MVC

Votre projet doit être réalisé en PHP Orienté Objet, en utilisant un modèle MVC

## Consignes

Réaliser un micro `back-office` permettant à l'internaute :
- [C] d'`ajouter` des produits,
- [R] d'`afficher` la liste des produits,
- [U] de `mettre à jour` des produits,
- [D] de `supprimer` des produits.

Chaque produit doit posséder les données suivantes :
- `nom`,
- `description`,
- `quantité`,
- `prix`.

Améliorer le `back-office` avec une gestion de catégories.

Vous devrez permettre à l'internaute :
- [C] d'`ajouter` des catégories,
- [R] d'`afficher` la liste des produits de la catégorie,
- [U] de `mettre à jour` des catégories,
- [D] de `supprimer` des catégories.

Mettre en place un système de gestion des utilisateurs.
On doit pouvoir :
- s'inscrire (avec un rôle utilisateur par défaut),
- se connecter (demander l'email et le mot de passe).

L'un des utilisateurs doit posséder le role `Admin` et :
- doit pouvoir modifier les droits des autres utilisateurs,
- seul lui doit pouvoir utiliser le CRUD des produits et catégories. Les autres utilisateurs ne doivent pas avoir accès à ces pages.

## Exemples de requêtes

### Récupération de données
`SELECT [colonnes] FROM [table] WHERE [condition];`

### Ajout de données
`INSERT INTO [table] ([colonne1], [colonne2], ...) VALUES ([valeur1], [valeur2], ...);`

### Mise à jour de données
`UPDATE [table] SET [colonne1] = [valeur1], [colonne2] = [valeur2], etc WHERE [condition];`

### Suppression de données
`DELETE FROM [table] WHERE [condition];`

## Rendus

Vous devez me rendre votre projet sur `github` avec un export de votre `base de données`.

__Deadline :__ dimanche 13 novembre 2022, à 23h59 au plus tard.