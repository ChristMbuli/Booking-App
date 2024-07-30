<?php
$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

//Inserer un Commentaires
if (isset($_POST['comment'])) {
    if (!empty($_POST['quote']) && !empty($_POST['idowner']) && !empty($_POST['iduser']) && !empty($_POST['idhouse'])) {

        $quote = htmlspecialchars($_POST['quote']);
        $idowner = htmlspecialchars($_POST['idowner']);
        $iduser = htmlspecialchars($_POST['iduser']);
        $idhouse = htmlspecialchars($_POST['idhouse']);

        $created = date('Y-m-d H:i:s');

        // Utilisation de requêtes préparées avec des paramètres
        $insert = $conn->prepare("INSERT INTO comments (id_user, id_owner, id_house, comment, created_at) VALUES (?, ?, ?, ?, ?)");
        $insert->execute(array($iduser, $idowner, $idhouse, $quote, $created));

        $success = "Commentaire ajouté avec succès !";
    } else {
        $e = "Veuillez entrer un commentaire !";
    }
}

//Afficher les Commentaires

$AllComment = $conn->prepare('SELECT * FROM comments WHERE id_house = ? ORDER BY id_com DESC');
$AllComment->execute(array($Id));