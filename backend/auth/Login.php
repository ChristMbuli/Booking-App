<?php
session_start();
$route = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;
// Section pour valider le formulaire de connexion
if (isset($_POST['signin'])) {

    //Verifier si le visiteur à remplis tous les champs du formulaire
    if (!empty($_POST['email']) && !empty($_POST['mdp'])) {

        //Stocker les donnée entrée dans les variable
        $userEmail = htmlspecialchars($_POST['email']);
        $userMdp = htmlspecialchars($_POST['mdp']);

        //Verifier si l'email de existe
        $checkIfUser = $conn->prepare('SELECT * FROM users WHERE email = ?');
        $checkIfUser->execute(array($userEmail));

        if ($checkIfUser->rowCount() > 0) { // la méthode rowcount nous permet de compter les nombre des donnée entré par l'utilisateur

            $userInfos = $checkIfUser->fetch(); //recuperer toutes les infos  est stocker dans un tabelau

            //Section pour verifier si le mot de passe entrer par le visiteur correspond à celui de la BD
            if (password_verify($userMdp, $userInfos['mdp'])) {

                // Vérifier si l'administrateur est déjà connecté
                if (!isset($_SESSION['auth'])) {
                    // Mettre à jour la colonne "online" à 1 pour indiquer qu'il est en ligne
                    $updateOnlineStatus = $conn->prepare('UPDATE users SET online_statut = 1 WHERE id_user = :usrId');
                    $updateOnlineStatus->execute(array('usrId' => $userInfos['id_user']));


                    //Section pour authentifier l'admin sur la plateforme avec les session
                    $_SESSION['auth'] = true;
                    $_SESSION['id'] = $userInfos['id_user'];
                    $_SESSION['firstname'] = $userInfos['fname'];
                    $_SESSION['lastname'] = $userInfos['lname'];
                    $_SESSION['contact'] = $userInfos['email'];
                    $_SESSION['photo'] = $userInfos['profil'];
                }

                // Rediriger vers différentes pages en fonction des paramètres
               // if (isset($_SESSION['auth'])) {
                //    if (isset($_GET['url'])) {
                  //      header('Location: ' . $_GET['url']);
                 //   } elseif (isset($_GET['link'])) {
                 //       header('Location: ' . $_GET['link']);
                 //   } else {
                        // Redirection par défaut, ici vers message.php
                  //      header('Location: ../clients/index.php');
                   // }
                  //  exit;
               // }
                header('Location: ../clients/index.php');
                exit;
            } else {
                $msgError = "votre mot de passe est incorrect";
            }
        } else {
            $msgError = "Compte introuvable";
        }
    } else {
        $msgError = "Completez tous les champs";
    }
}