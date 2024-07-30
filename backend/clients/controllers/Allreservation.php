<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

$Msg = '';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['id'])) {
    // Récupérer l'ID de l'utilisateur connecté
    $userId = $_SESSION['id'];

    // Requête pour récupérer les maisons réservées par l'utilisateur avec la première image
    $query = $conn->prepare('SELECT houses.*, medias.images,reservations.created_at
                             FROM houses
                             INNER JOIN reservations ON houses.id_house = reservations.id_house
                             INNER JOIN (
                                 SELECT id_house, MIN(id_media) AS first_media
                                 FROM medias
                                 GROUP BY id_house
                             ) AS m ON m.id_house = houses.id_house
                             INNER JOIN medias ON medias.id_media = m.first_media
                             WHERE reservations.id_user = ?');
    $query->execute(array($userId));

    // Vérifier si des résultats ont été trouvés
    if ($query->rowCount() > 0) {
        $houses = $query->fetchAll(); // Récupérer toutes les maisons réservées
    } else {
        $Msg = "Vous n'avez aucune réservation trouvée";
    }
} else {
    $Msg = "Utilisateur non connecté.";
}