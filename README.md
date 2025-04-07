# README - Mediatekformation

**Lien vers le dépôt du projet** : https://github.com/CNED-SLAM/mediatekformation
<br>Ce lien vous emmènes vers le dépôt d'origine qui contient, dans le readme, la présentation de l'application d'origine.</br>

## Présentation
Mediatekformation est un site développé avec **Symfony 6.4**, permettant d'accéder aux vidéos d'auto-formation proposées par une chaîne de médiathèques, également disponibles sur YouTube.  
Ce site web inclut plusieurs fonctionnalités globales décrites ci-dessous. Voici le lien vers l'application en ligne : [Application](https://mediatek-formation.go.yj.fr/mediatekformation/public/)

## Les différentes pages
Le site comprend 11 pages correspondant à différents cas d’utilisation, mais je vais vous présenter seulement les pages ayant subi des modifications :

### Page 1 : L'authentification
- Demande de renseigner l'ID dans le premier champ.
- Demande de renseigner le mot de passe dans le second champ.
![Authentification](https://github.com/user-attachments/assets/d92d5026-92be-4d51-9d42-c44e6f36783b)

### Page 2 : Les formations
- Contient une nouvelle colonne "Action" permettant d'ajouter, de modifier ou de supprimer une formation.
- Contient le bouton de déconnexion en bas à droite de la page.
![Formations](https://github.com/user-attachments/assets/bffac3c6-09e8-4742-9d6d-9d44b5e5d421)

### Page 3 : Ajout et modification d'une formation
- Accessible uniquement en cliquant sur le bouton "Ajouter" dans la colonne "Actions".
- Contenu :
  - Titre : Obligation de remplir ce champ.
  - Description de la formation : Non obligatoire.
  - Date de publication : Obligation de remplir ce champ.
  - Playlist associée à la formation : Champ pré-rempli et possibilité de choisir la playlist voulue.
  - Catégorie : Non obligatoire.
  - Bouton de déconnexion en bas à droite de la page.
![Ajout formation](https://github.com/user-attachments/assets/e3f13913-c233-4dce-a3a5-f855cfb05d6e)
- Accessible uniquement en cliquant sur le bouton "Modifier" dans la colonne "Actions".
![Modifications formation](https://github.com/user-attachments/assets/feb278b6-b6b3-4aff-8558-e9d55ff80dc6)
- Si le bouton "Supprimer" est pressé, un message de confirmation sera demandé. Si validé, la formation sera supprimée de la page et de la base de données.

### Page 4 : Les playlists
- Contient une nouvelle colonne "Nombre de formations", permettant d'afficher le nombre de formations reliées à chaque playlist.
- Contient un système de tri par ordre croissant et décroissant du nombre de formations.
- Contient une nouvelle colonne "Action" permettant d'ajouter, de modifier ou de supprimer une playlist.
- Contient le bouton de déconnexion en bas à droite de la page.
![Playlists](https://github.com/user-attachments/assets/ec03dd65-b03d-4a8a-b9e7-cb07336b18f2)

### Page 5 : Détail d'une playlist
- Accessible uniquement via le bouton "Voir détail" depuis la page des playlists.
- Contenu :
  - Partie gauche : Nombre de formations liées à la playlist.
  - En bas à droite : Bouton de déconnexion.
![Playlist](https://github.com/user-attachments/assets/d336648c-f79d-47e3-8529-3cfdd06230f6)

### Page 6 : Ajout et modification d'une playlist
- Accessible uniquement en cliquant sur le bouton "Ajouter" dans la colonne "Actions".
- Contenu :
  - Nom : Obligation de remplir ce champ.
  - Description de la formation : Non obligatoire.
  - Bouton de déconnexion en bas à droite de la page.
![Ajout Playlist](https://github.com/user-attachments/assets/2137c0b3-7c6a-47df-af43-a2cfd1db7848)
- Accessible uniquement en cliquant sur le bouton "Modifier" dans la colonne "Actions".
- Liste avec les miniatures des formations associées à la playlist.
![Modification Playlist](https://github.com/user-attachments/assets/8d3232e6-ff24-4a95-8da7-3a015497dde0)
- Si le bouton "Supprimer" est pressé, un message de confirmation sera demandé.
- Si la playlist est utilisée dans une formation, et que le message de confirmation de suppression est validé, un message d'erreur apparaîtra et la playlist ne sera pas supprimée.

### Page 7 : Les catégories
- Contient une liste des catégories.
- Contient une colonne "Action" permettant d'ajouter ou de supprimer une catégorie.
- Contient le bouton de déconnexion en bas à droite de la page.
![Catégories](https://github.com/user-attachments/assets/d027ce66-c78f-4667-9748-869e01eb0947)

### Page 8 : Ajout d'une catégorie
- Accessible uniquement en cliquant sur le bouton "Ajouter" dans la colonne "Actions".
- Contenu :
  - Nom : Obligation de remplir ce champ.
  - Bouton de déconnexion en bas à droite de la page.
![Ajout Catégorie](https://github.com/user-attachments/assets/09479faf-cd8f-4a23-8b6a-992fa4ea5932)
- Si le bouton "Supprimer" est pressé, un message de confirmation sera demandé.
- Si la catégorie est utilisée dans une formation, et que le message de confirmation de suppression est validé, un message d'erreur apparaîtra et la catégorie ne sera pas supprimée.

## Base de données
Le site exploite une base de données au format **MySQL**, contenant les informations relatives aux formations, playlists et catégories.

## Conclusion
Mediatekformation offre une interface intuitive pour explorer des vidéos d'auto-formation, avec des fonctionnalités interactives facilitant la navigation et la recherche.


