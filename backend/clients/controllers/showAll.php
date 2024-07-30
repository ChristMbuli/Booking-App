<?php
$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

//Afficher toutes les maisons, afficher aussi la premiere images de chaque maison dans la table medias

$req = $conn->prepare("
    SELECT houses.id_house, houses.city, houses.district, houses.rent, npersonn, houses.id_user, created_at, media.images
    FROM houses
    JOIN (
        SELECT id_house, images, ROW_NUMBER() OVER(PARTITION BY id_house ORDER BY id_media) AS row_number
        FROM medias
    ) AS media ON houses.id_house = media.id_house
    WHERE media.row_number = 1 ORDER BY id_house DESC
  ");
$req->execute();