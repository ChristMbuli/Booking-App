<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

// Récupérer l'id du user connecté
$idConnected = $_SESSION['id'];

// Requête pour afficher uniquement les users avec qui la session connecter a échangé des messages (afficher le fname et le lname des uers)
$ReqUsers = $conn->prepare('SELECT users.id_user, users.fname, users.lname, users.profil, MAX(messages.created_at) AS last_message_date
                           FROM users
                           INNER JOIN messages ON users.id_user = messages.id_owner
                           WHERE messages.id_user = :userId
                           GROUP BY users.id_user, users.fname, users.lname, users.profil');
$ReqUsers->bindParam(':userId', $idConnected);
$ReqUsers->execute();

//Afficher me message si vous n'avais aucun message
$msg = "Vous n'avez aucun message";