<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$route = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;
// Section pour gérer la déconnexion
if (isset($_POST['logout'])) {
    // Vérifier si le visiteur est connecté
    if (isset($_SESSION['auth'])) {
        // Mettre à jour la colonne "online" à 0 pour indiquer que le user est hors ligne
        $updateOnlineStatus = $conn->prepare('UPDATE users SET online_statut = 0 WHERE id_user = :userId');
        $updateOnlineStatus->execute(array('userId' => $_SESSION['id']));

        // Détruire la session
        session_destroy();

        // Rediriger vers la page de connexion
        header('Location: ../clients/');
    }
}