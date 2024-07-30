<?php

$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;


function generateRandomString($length = 25)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_POST['ajouter'])) {
    if (
        isset($_POST['city']) && isset($_POST['district']) && isset($_POST['rent']) && isset($_POST['etage'])
        && isset($_POST['adress']) && isset($_POST['surface']) && isset($_POST['bedroom']) && isset($_POST['personne'])
        && isset($_POST['menage']) && isset($_POST['tags']) && isset($_POST['guaranted']) && isset($_FILES['images']['name'])
    ) {
        $city = htmlspecialchars($_POST['city']);
        $district = htmlspecialchars($_POST['district']);
        $rent = htmlspecialchars($_POST['rent']);
        $guaranted = htmlspecialchars($_POST['guaranted']);
        $etage = htmlspecialchars($_POST['etage']);
        $adress = htmlspecialchars($_POST['adress']);
        $surface = htmlspecialchars($_POST['surface']);
        $bedroom = htmlspecialchars($_POST['bedroom']);
        $personne = htmlspecialchars($_POST['personne']);
        $menage = htmlspecialchars($_POST['menage']);
        $tags = $_POST['tags'];

        $created = date('Y-m-d H:i:s');
        $idUser = $_SESSION['id'];

        //Stocker les images dans un dossier
        $image_paths = array();
        foreach ($_FILES['images']['name'] as $key => $image) {
            $image_tmp = $_FILES['images']['tmp_name'][$key];
            $image_name = generateRandomString(25) . '.' . pathinfo($image, PATHINFO_EXTENSION) . '.jpg';
            $image_path = '../uploads/' . $image_name;
            move_uploaded_file($image_tmp, $image_path);
            $image_paths[] = $image_path;
        }

        // Insertion de la maison dans la table 'houses'
        $req = $conn->prepare("INSERT INTO houses(city, district, bedroom, surface, guaranteed, rent, npersonn,menage, 
                                address, id_user, created_at) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $req->execute(array($city, $district, $bedroom, $surface, $guaranted, $rent, $personne, $menage, $adress, $idUser, $created));
        $house_id = $conn->lastInsertId(); // Obtenir l'ID de la maison nouvellement créée

        // Insertion des images dans la table 'media'
        if (!empty($image_paths)) {
            foreach ($image_paths as $image_path) {
                $req = $conn->prepare("INSERT INTO medias(id_house, id_user, images) VALUES(?, ?, ?)");
                $req->execute(array($house_id, $idUser, $image_path));
            }
        } else {
            $msgError = "Sélectionnez une image";
        }

        // Insertion des tags sélectionnés
        if (is_array($tags) && !empty($tags)) {
            foreach ($tags as $tag) {
                $insertTag = $conn->prepare('INSERT INTO house_tags(id_house, tag) VALUES(?, ?)');
                $insertTag->execute(array($house_id, $tag));
            }
        } else {
            $msgError = "Sélectionnez un tag";
        }

        $msgSuccess =  "Bien ajouté avec succès";
    } else {
        $error = "Complétez tous les champs";
    }
}