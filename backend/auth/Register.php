<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$route = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

if (isset($_POST['signup'])) {
    if (
        !empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email'])
        && !empty($_POST['mdp'])
    ) {

        $userFname = htmlspecialchars($_POST['fname']);
        $userLname = htmlspecialchars($_POST['lname']);
        $userMdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
        $userEmail = htmlspecialchars($_POST['email']);
        $created = date('Y-m-d H:i:s');

        $ifUserExists = $conn->prepare('SELECT email FROM users WHERE email = ?');
        $ifUserExists->execute(array($userEmail));

        if ($ifUserExists->rowCount() == 0) {
            $insertUser = $conn->prepare('INSERT INTO users(fname , lname, email, mdp, created_at) VALUES (?, ?, ?, ?, ?)');
            $insertUser->execute(array($userFname, $userLname, $userEmail, $userMdp, $created));

            $reqUserInfos = $conn->prepare('SELECT id_user, fname, lname, email, profil FROM users WHERE fname = ? AND email = ? ');
            $reqUserInfos->execute(array($userFname, $userEmail));
            $sessionUserInfos =  $reqUserInfos->fetch();

            $_SESSION['auth'] = true;
            $_SESSION['id'] = $sessionUserInfos['id_user'];
            $_SESSION['firstname'] = $sessionUserInfos['fname'];
            $_SESSION['lastname'] = $sessionUserInfos['lname'];
            $_SESSION['contact'] = $sessionUserInfos['email'];
            $_SESSION['photo'] = $sessionUserInfos['profil'];

            header('Location: Signin.php');
            exit;
        } else {
            $msgError = "Vous avez déjà un compte";
        }
    } else {
        $msgError = "Complétez tous les champs...";
    }
}
