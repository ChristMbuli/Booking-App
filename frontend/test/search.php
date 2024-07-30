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

//Faire le filtre
if (isset($_GET['filter'])) {
$appartm = isset($_GET['appartm']) ? $_GET['appartm'] : '';
$appartv = isset($_GET['appartv']) ? $_GET['appartv'] : '';
$studionv = isset($_GET['studionv']) ? $_GET['studionv'] : '';
$studiom = isset($_GET['studiom']) ? $_GET['studiom'] : '';
$chambrem = isset($_GET['chambrem']) ? $_GET['chambrem'] : '';
$bedromm = isset($_GET['bedromm']) ? $_GET['bedromm'] : '';
$rent = isset($_GET['rent']) ? $_GET['rent'] : '';
$caution = isset($_GET['caution']) ? $_GET['caution'] : '';

$query = 'SELECT houses.id_house, houses.city, houses.district, houses.rent, houses.npersonn, houses.id_user, houses.created_at,
        (SELECT medias.images FROM medias WHERE medias.id_house = houses.id_house LIMIT 1) AS house_image
        FROM houses
        INNER JOIN house_tags ON houses.id_house = house_tags.id_house
        WHERE 1 = 1';

$conditions = array();

if (!empty($appartm)) {
    $conditions[] = "house_tags.tag = 'Appartement meublé'";
}
if (!empty($appartv)) {
    $conditions[] = "house_tags.tag = 'Appartement vide'";
}
// ... (ajoutez d'autres conditions pour les autres variables de filtrage) ...

if (!empty($conditions)) {
    $query .= ' AND ' . implode(' AND ', $conditions);
}

$request = array($appartm, $appartv, $studionv, $studiom,);
?>
<section>
    <div class="container">
        <!-- Faire une Recherche -->
    <div class="search">
        <form method="get">
            <input type="text" name="city" placeholder="ville" value="<?= isset($_GET['city']) ? htmlspecialchars($_GET['city']) : '' ?>">
            <input type="text" name="district" placeholder="quartier" value="<?= isset($_GET['district']) ? htmlspecialchars($_GET['district']) : '' ?>">
            <button type="submit" name="search">Recherche</button>
        </form>
    </div>
        <!-- Faire un filtre -->
        <form action="" method="get">
            <div class="filter">
                <label><input type="checkbox" class="icheck" name="appartm"> Appartement meublé</label>

                <label><input type="checkbox" class="icheck" name="appartv"> Appartement Vide</label>

                <label><input type="checkbox" class="icheck" name="studionv"> Studio Vide</label>

                <label><input type="checkbox" class="icheck" name="studiom"> Studio Meublé</label>

                <label><input type="checkbox" class="icheck" name="bedromm"> Chambre Meublé</label>
                <!-- Afficher maisons commençant à 900 pas moins de 900 -->
                <label><input type="number > 900" class="icheck" name="rent"> Loyer</label>
                <!-- Afficher les cautions des maisons commençant à 900 pas moins de 900 -->
                <label><input type="number > 900" class="icheck" name="caution"> Caution</label>

                <button type="submit" value="filter">45 résultat <!-- afficher le nombre de bien trouvé --></button>
            </div>
        </form>
    </div>

    <!-- Affichage le resultat de la recherche (par ville ou quartier) ou Affichage les recultat du filtre -->
        <div class="row">
            <!-- Erreur search -->
            <?php echo $searchMessage; ?>
            <!-- Afficher les résultats de la recherche -->

            <?php if (count($searchResults) > 0) {
                foreach ($searchResults as $row) { ?>
                    <a href="">
                        <img src="<?= $row['house_image'] ?>" alt="">
                        <p><?= $row['city'] . ' ' . $row['district'] ?></p>
                        <small><?= $row['rent'] ?></small>
                    </a>
                <?php }
            }
            ?>


        </div>
    </div>
</section>
/////////////////////


