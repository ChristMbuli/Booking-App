<?php $route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

$showForm = true; // Par défaut, afficher le formulaire

if (isset($_POST['checkout'])) {
    if (!empty($_POST['iduser']) && !empty($_POST['ownerid']) && !empty($_POST['houseid'])) {

        $userid = htmlspecialchars($_POST['iduser']);
        $ownerId = htmlspecialchars($_POST['ownerid']);
        $house = htmlspecialchars($_POST['houseid']);

        // Vérification de l'existence d'une réservation
        $checkReservation = $conn->prepare("SELECT * FROM reservations WHERE id_user = ? AND id_house = ?");
        $checkReservation->execute(array($userid, $house));
        $existingReservation = $checkReservation->fetch();

        if ($existingReservation) {
            $showForm = false;
            $ErrorMsg = "Vous avez déjà une réservation pour cette maison avec ce propriétaire.";
        } else {
            // Insertion des données s'il n'y a pas de réservation existante
            $created = date('Y-m-d H:i:s');
            $insert = $conn->prepare("INSERT INTO reservations(id_house, id_user, id_owner, created_at) VALUES(?, ?, ?, ?)");
            $insert->execute(array($house, $userid, $ownerId, $created));
            $SuccessMsg = "Votre Réservation est envoyée avec succès";
            $showForm = false;
        }
    }
}