<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>README - Mediatekformation</title>
</head>
<body>
    <h1>README - Mediatekformation</h1>

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
        ![Authentification](https://github.com/user-attachments/assets/480ee42b-6499-4047-b011-669fe6fa880a)
    </ul>

<h3>Page 2 : Les formations</h3>
    <ul>
        <li>Contient une nouvelle colonne "Action" permettant d'Ajouter, de Modifier ou de Supprimer une formation.</li>
        <li>Contient le bouton de déconnexion en bas à droite de la page.</li>
        ![Formations](https://github.com/user-attachments/assets/3ac2dbc0-02af-40cf-b632-309d88a5a95a)
    </ul>

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
                <li>Bouton de déconnexion en bas à droite de la page</li>
            </ul>
        </li>
        ![Ajout formation](https://github.com/user-attachments/assets/e3f13913-c233-4dce-a3a5-f855cfb05d6e)
        <li>Pour la modification d'une formation, la page est la même mais son contenu est prérempli en fonction des informations de la formation à modifier.</li>
        ![Modifs formation](https://github.com/user-attachments/assets/feb278b6-b6b3-4aff-8558-e9d55ff80dc6)
        <li>Si le bouton supprimer est pressé, un message de confirmation sera demandé. Si validation, la formation sera supprimer de la page et de la Base de données</li>
    </ul>

<h3>Page 4 : Les playlists</h3>
    <ul>
        <li>Affichage d'un tableau listant les playlists disponibles.</li>
        <li>Colonnes du tableau :
            <ul>
                <li><strong>Playlist :</strong> Nom de chaque playlist.</li>
                <li><strong>Catégories :</strong> Catégories concernées.</li>
                <li><strong>Bouton :</strong> Lien vers la page de détail de la playlist.</li>
            </ul>
        </li>
        <li>Fonctionnalités interactives :
            <ul>
                <li>Tri par ordre croissant ou décroissant sur la colonne Playlist.</li>
                <li>Filtrage par texte sur la colonne Playlist.</li>
                <li>Filtrage par catégorie via un menu déroulant.</li>
            </ul>
        </li>
        <li>Tri par défaut : ordre alphabétique de la playlist.</li>
        <li>Cliquer sur "voir détail" mène à la page de détail de la playlist.</li>
    </ul>

<h3>Page 5 : Détail d'une playlist</h3>
    <ul>
        <li>Accessible uniquement via le bouton "voir détail" depuis la page des playlists.</li>
        <li>Contenu :
            <ul>
                <li>Partie gauche : Informations sur la playlist (titre, catégories, description).</li>
                <li>Partie droite : Liste des formations associées (miniature et titre, cliquables pour accéder à leur détail).</li>
            </ul>
        </li>
    </ul>

<h2>Base de données</h2>
    <p>Le site exploite une base de données au format <strong>MySQL</strong>, contenant les informations relatives aux formations, playlists et catégories.</p>

<h2>Conclusion</h2>
    <p>Mediatekformation offre une interface intuitive pour explorer des vidéos d'auto-formation, avec des fonctionnalités interactives facilitant la navigation et la recherche.</p>
</body>
</html>

