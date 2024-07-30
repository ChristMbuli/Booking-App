<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$route = dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'connexion.php';
include $route;

$searchResults = []; // Initialiser le tableau des résultats de la recherche
$searchMessage = ''; // Initialiser le message de recherche

// Faire la recherche
if (isset($_GET['search'])) {
    $city = isset($_GET['city']) ? $_GET['city'] : '';
    $district = isset($_GET['district']) ? $_GET['district'] : '';

    // Initialiser la requête SQL de base sans conditions & récuperer une image de la maison dans la table medias

    $query = 'SELECT houses.id_house, houses.city, houses.district, houses.rent, houses.npersonn, houses.id_user,houses.created_at,
            (SELECT medias.images FROM medias WHERE medias.id_house = houses.id_house LIMIT 1) AS house_image
          FROM houses 
          WHERE 1 = 1';
    $conditions = array();

    // Construire dynamiquement la requête en fonction des paramètres du formulaire
    if (!empty($city)) {
        $conditions[] = "city LIKE :city";
    }

    if (!empty($district)) {
        $conditions[] = "district LIKE :district";
    }

    if (!empty($conditions)) {
        $query .= ' AND ' . implode(' AND ', $conditions);
    }

    $query .= ' ORDER BY id_house DESC';

    // Préparer la requête
    $searchQuery = $conn->prepare($query);

    // Associer les valeurs aux paramètres
    if (!empty($city)) {
        $searchQuery->bindValue(':city', "%$city%");
    }

    if (!empty($district)) {
        $searchQuery->bindValue(':district', "%$district%");
    }

    // Exécuter la requête
    $searchQuery->execute();

    // Récupérer les résultats
    $searchResults = $searchQuery->fetchAll();

    // Vérifier s'il y a des résultats
    if (count($searchResults) === 0) {
        $searchMessage = "<div class='alert alert-danger alert-dismissible fade show w-100' role='alert'>
                            Aucune maison correspondante n'a été trouvée.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                          </div>";
        // Nouvelle requête pour sélectionner aléatoirement des maisons
        $randomHousesQuery = $conn->query("SELECT houses.id_house, houses.city, houses.district, houses.rent, houses.npersonn, houses.id_user, houses.created_at,
    (SELECT medias.images FROM medias WHERE medias.id_house = houses.id_house LIMIT 1) AS house_image
    FROM houses
    ORDER BY RAND()
    LIMIT 10"); // Changez ce nombre selon le nombre de maisons que vous souhaitez afficher aléatoirement

        $searchResults = $randomHousesQuery->fetchAll();
    }
}