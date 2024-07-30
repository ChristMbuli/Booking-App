<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

// Nombre de maisons à afficher par page
$maisonsParPage = 5;

// Récupérez le numéro de la page actuelle depuis l'URL
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Comptez le nombre total de maisons
$ReqCountHouses = $conn->prepare('SELECT COUNT(*) FROM houses WHERE id_user = ?');
$ReqCountHouses->execute(array($_SESSION['id']));
$totalMaisons = $ReqCountHouses->fetchColumn();

// Calculez le nombre total de pages
$totalPages = ceil($totalMaisons / $maisonsParPage);

// Calculez l'offset pour la requête SQL
$offset = ($page - 1) * $maisonsParPage;

// Récupérez les maisons et une image de chaque maison dans la table medias pour la page actuelle
//Récupérer les maison de user avec session_id
$ReqAllHouseAdmin = $conn->prepare('
    SELECT houses.id_house, houses.city, houses.district, media.images
    FROM houses
    JOIN (
        SELECT id_house, images, ROW_NUMBER() OVER(PARTITION BY id_house ORDER BY id_media) AS row_number
        FROM medias
    ) AS media ON houses.id_house = media.id_house
    WHERE media.row_number = 1 AND houses.id_user = ? 
    ORDER BY houses.id_house DESC LIMIT ? OFFSET ?
');
$ReqAllHouseAdmin->bindValue(1, $_SESSION['id'], PDO::PARAM_INT);
$ReqAllHouseAdmin->bindValue(2, $maisonsParPage, PDO::PARAM_INT);
$ReqAllHouseAdmin->bindValue(3, $offset, PDO::PARAM_INT);
$ReqAllHouseAdmin->execute();