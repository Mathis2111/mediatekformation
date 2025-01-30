<body>
    <h1>README - Mediatekformation</h1>
<p>Lien vers le dépôt du projet : https://github.com/Mathis2111/mediatekformation</p>
<h2>Présentation</h2>
    <p>
        Mediatekformation est un site développé avec <strong>Symfony 6.4</strong>, permettant d'accéder aux vidéos d'auto-formation proposées par une chaîne de médiathèques, également disponibles sur YouTube.
    </p>
    <p>
        Ce site web inclut plusieurs fonctionnalités globales décrites ci-dessous.
    </p>

<h2>Les différentes pages</h2>
    <p>Le site comprend 11 pages correspondant à différents cas d’utilisation, je vais vous présenter que les pages ayant subits des modifications :</p>
<h3>Page 1 : L'authentification</h3>
    <ul>
        <li>Demande de renseigner l'ID dans le premier label.</li>
        <li>Demande de renseigner le Mot de Passe dans le second label.</li>
    </ul>
    ![Authentification](https://github.com/user-attachments/assets/d92d5026-92be-4d51-9d42-c44e6f36783b)


<h3>Page 2 : Les formations</h3>
    <ul>
        <li>Contient une nouvelle colonne "Action" permettant d'Ajouter, de Modifier ou de Supprimer une formation.</li>
        <li>Contient le bouton de déconnexion en bas à droite de la page.</li>
    </ul>
    ![Formations](https://github.com/user-attachments/assets/bffac3c6-09e8-4742-9d6d-9d44b5e5d421)


<h3>Page 3 : Ajout et modification d'une formation</h3>
    <ul>
        <li>Accessible uniquement en cliquant sur le bouton ajouter dans la colonne Actions.</li>
        <li>Contenu :
            <ul>
                <li>Titre : Obligation de remplir ce champ.</li>
                <li>Description de la formation : Non obligatoire.</li>
                <li>Date de publication : Obligation de remplir ce champ.</li>
                <li>Titre : Obligation de remplir ce champ.</li>
                <li>Playlist associé à la formation : Champ prérempli et possibilité de choisi la playlist voulu.</li>
                <li>Catégorie : Non obligatoire.</li>
                <li>Bouton de déconnexion en bas à droite de la page.</li>
            </ul>
        </li>
        ![Ajout formation](https://github.com/user-attachments/assets/e3f13913-c233-4dce-a3a5-f855cfb05d6e)
        <li>Accessible uniquement en cliquant sur le bouton modifier dans la colonne Actions.</li>
        ![Modifs formation](https://github.com/user-attachments/assets/feb278b6-b6b3-4aff-8558-e9d55ff80dc6)
        <li>Si le bouton supprimer est pressé, un message de confirmation sera demandé. Si validation, la formation sera supprimer de la page et de la Base de données.</li>
    </ul>

<h3>Page 4 : Les playlists</h3>
    <ul>
        <li>Contient une nouvelle colonne Nombre de formations, permettant d'afficher le nombre de formations reliées à chaques playlists.</li>
        <li>Contient un système de tris par ordre croissant et décroissant du nombre de formations.</li>
        <li>Contient une nouvelle colonne "Action" permettant d'Ajouter, de Modifier ou de Supprimer une playlist.</li>
        <li>Contient le bouton de déconnexion en bas à droite de la page.</li>
    </ul>
    ![Playlists](https://github.com/user-attachments/assets/ec03dd65-b03d-4a8a-b9e7-cb07336b18f2)

<h3>Page 5 : Détail d'une playlist</h3>
    <ul>
        <li>Accessible uniquement via le bouton "voir détail" depuis la page des playlists.</li>
        <li>Contenu :
            <ul>
                <li>Partie gauche : Nombre de formations liées à la playlist.</li>
                <li>En bas à droite : Bouton de déconnexion.</li>
            </ul>
        </li>
    </ul>
    ![Playlist](https://github.com/user-attachments/assets/d336648c-f79d-47e3-8529-3cfdd06230f6)

<h3>Page 6 : Ajout et modification d'une playlist</h3>
    <ul>
        <li>Accessible uniquement en cliquant sur le bouton ajouter dans la colonne Actions.</li>
        <li>Contenu :
            <ul>
                <li>Nom : Obligation de remplir ce champ.</li>
                <li>Description de la formation : Non obligatoire.</li>
                <li>Bouton de déconnexion en bas à droite de la page.</li>
            </ul>
        </li>
        ![AjoutPlaylist](https://github.com/user-attachments/assets/2137c0b3-7c6a-47df-af43-a2cfd1db7848)
        <li>Accessible uniquement en cliquant sur le bouton modifier dans la colonne Actions.</li>
        <li>Liste avec les miniatures des formations associées à la playlist.</li>
        ![ModificationPlaylist](https://github.com/user-attachments/assets/8d3232e6-ff24-4a95-8da7-3a015497dde0)
        <li>Si le bouton supprimer est pressé, un message de confirmation sera demandé.</li>
        <li>Si la playlist est utilisé dans une formation, et que le message de confirmation de suppression et validé, un message d'erreur apparait et la playlist ne sera pas supprimer.</li> 
    </ul>

<h3>Page 7 : Les catégories</h3>
    <ul>
        <li>Contient une liste des catégories.</li>
        <li>Contient une colonne "Action" permettant d'Ajouter ou de Supprimer une catégorie.</li>
        <li>Contient le bouton de déconnexion en bas à droite de la page.</li>
    </ul>
    ![Catégories](https://github.com/user-attachments/assets/d027ce66-c78f-4667-9748-869e01eb0947)

<h3>Page 8 : Ajout d'une catégorie</h3>
    <ul>
        <li>Accessible uniquement en cliquant sur le bouton ajouter dans la colonne Actions.</li>
        <li>Contenu :
            <ul>
                <li>Nom : Obligation de remplir ce champ.</li>
                <li>Bouton de déconnexion en bas à droite de la page.</li>
            </ul>
        </li>
        ![AjoutCatégorie](https://github.com/user-attachments/assets/09479faf-cd8f-4a23-8b6a-992fa4ea5932)
        <li>Si le bouton supprimer est pressé, un message de confirmation sera demandé.</li>
        <li>Si la catégorie est utilisé dans une formation, et que le message de confirmation de suppression et validé, un message d'erreur apparait et la catégorie ne sera pas supprimer.</li> 
    </ul>

<h2>Base de données</h2>
    <p>Le site exploite une base de données au format <strong>MySQL</strong>, contenant les informations relatives aux formations, playlists et catégories.</p>

<h2>Conclusion</h2>
    <p>Mediatekformation offre une interface intuitive pour explorer des vidéos d'auto-formation, avec des fonctionnalités interactives facilitant la navigation et la recherche.</p>
</body>
</html>

