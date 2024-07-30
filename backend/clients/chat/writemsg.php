<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

// Vérifier si l'id est passé en paramètre dans l'URL
if (isset($_GET['id']) and !empty($_GET['id'])) {

    // Stocker cet id dans une variable
    $getId = $_GET['id'];


    // Requête pour récupérer les informations de l'utilisateur correspondant à l'id
    $ReqInfos = $conn->prepare('SELECT fname, lname, profil FROM users WHERE id_user = ?');
    $ReqInfos->execute(array($getId));

    // Vérifier si l'utilisateur existe dans la base de données
    if ($ReqInfos->rowCount() > 0) {

        // Vérifier si le formulaire a été soumis
        if (isset($_POST['chat'])) {

            // Récupérer le message soumis dans le formulaire
            $messages = nl2br(htmlspecialchars($_POST['msg']));
            $date_chat = date('Y-m-d H:i:s');

            // Requête pour insérer le message dans la table
            $insertReq = $conn->prepare('INSERT INTO messages (id_user, id_owner, msg, created_at) VALUES (?, ?, ?, ?)');
            $insertReq->execute(array($_SESSION['id'], $getId, $messages, $date_chat));
        }
    } else {
        echo "Aucun utilisateur trouvé";
    }
} else {
    $error = "Erreur Recommencé";
}