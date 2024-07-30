<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

if (isset($_GET['id']) and !empty($_GET['id'])) {
    $Id = $_GET['id'];

    // Afficher les articles
    $IfExist = $conn->prepare('SELECT * FROM houses WHERE id_house = ?');
    $IfExist->execute(array($Id));

    if ($IfExist->rowCount() > 0) {
        $req = $IfExist->fetch();


        $rent = $req['rent'];
        $menage = $req['menage'];
        $guaranteed = $req['guaranteed'];
        $surface = $req['surface'];
        $adress = $req['address'];
        // $etage = $req['etage'];
        $city = $req['city'];
        $personne = $req['npersonn'];
        $id_user = $req['id_user'];
        $district = $req['district'];
        $bedroom = $req['bedroom'];
    }

    //Afficher les images de la maison
    $row = $conn->prepare('SELECT images FROM medias WHERE id_house = :idMaison');
    $row->bindParam(':idMaison', $Id, PDO::PARAM_INT);
    $row->execute();

    //Afficher la premierere images de la maison avec id en url
    $reqs = $conn->prepare("
        SELECT houses.id_house, media.images
        FROM houses
        JOIN (
            SELECT id_house, images, ROW_NUMBER() OVER(PARTITION BY id_house ORDER BY id_media) AS row_number
            FROM medias
        ) AS media ON houses.id_house = media.id_house
        WHERE media.row_number = 1 AND media.id_house = ? 
    ");
    $reqs->execute(array($Id));
    if ($roww = $reqs->fetch(PDO::FETCH_ASSOC)) {
        $imagePath = $roww['images'];
    }


    //Afficher les tag de la maison
    $stmt = $conn->prepare('SELECT tags.tag FROM house_tags
                            INNER JOIN tags ON house_tags.id_tag = tags.id_tag
                            WHERE house_tags.id_house = :idMaison');
    $stmt->bindParam(':idMaison', $Id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
    } else {
        // Aucun tag trouvé, afficher un message
        $errors = 'Aucun tag trouvé pour cette maison.';
    }

    // Récupérer le profil de l'user à partir de la table "users"
    $idUser = $req['id_user'];
    $user_query = $conn->prepare('SELECT fname, lname, email, profil, created_at, online_statut FROM users WHERE id_user =?');
    $user_query->execute(array($idUser));
    $user = $user_query->fetch();

    $fname = $user['fname'];
    $lanme = $user['lname'];
    $photo = $user['profil'];
    $year = $user['created_at'];
} else {
    $msgError = 'Erreur !';
}