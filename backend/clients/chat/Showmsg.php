<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

// Récupérez l'ID de l'utilisateur à partir de l'URL
$getId = $_GET['id'];

$ReqMessages = $conn->prepare('SELECT * FROM messages WHERE (id_user = ? AND id_owner = ?) OR (id_owner = ? AND id_user = ?)');
$ReqMessages->execute(array($_SESSION['id'], $getId, $_SESSION['id'], $getId));

$messages = [];

if ($ReqMessages->rowCount() > 0) {
    while ($row = $ReqMessages->fetch(PDO::FETCH_ASSOC)) {
        $user = $conn->prepare('SELECT fname, lname, profil FROM users WHERE id_user = :idowner');
        $user->bindValue(':idowner', ($row['id_owner'] == $getId) ? $getId : $_SESSION['id'], PDO::PARAM_INT);
        $user->execute();
        $reqUser = $user->fetch(PDO::FETCH_ASSOC);

        $name = ($row['id_owner'] == $getId) ? $reqUser['fname'] . ' ' . $reqUser['lname'] : $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
        @$photo = ($row['id_owner'] == $getId) ? $reqUser['profil'] : $_SESSION['profil'];
        $date = $row['created_at'];

        $messages[] = [
            'name' => $name,
            'photo' => $photo,
            'msg' => $row['msg'],
            'id_owner' => $row['id_owner']
        ];
    }
} else {
    $msg = "Aucun messages avec cet utilisateur";
}
