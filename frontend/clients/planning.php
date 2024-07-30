<?php
require("../../backend/security.php");
require("../../backend/auth/Logout.php");
require("../../backend/clients/controllers/Allreservation.php");

?>
<!DOCTYPE html>
<html lang="en">
<?php include("components/head.php") ?>

<body>
    <!-- Search et NavBar -->
    <?php include("components/search.php") ?>

    <section class=" text-center container">
        <div class="row py-lg-3">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Vos Réservation</h1>
            </div>
        </div>
    </section>

    <div class="album py-5">
        <div class="container">
            <!-- Msg Pas de réservation -->
            <div>
                <?php if (!empty($Msg)) { ?>
                <p><?= $Msg ?></p>
                <?php } ?>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($houses as $house) { ?>
                <div class="col">
                    <a class="text-decoration-none link-dark " href="single.php?id=<?= $house['id_house'] ?>">
                        <div class="card shadow-sm">
                            <img src="<?= $house['images'] ?>" alt="">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group gap-1">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">En
                                            attente ...</button>
                                        <button type="button" class="btn btn-sm btn-outline-danger">Annuler</button>
                                    </div>
                                    <small class="text-body-secondary fs-6">
                                        <?php
                                            $startDate = new DateTime($house['created_at']);
                                            $endDate = new DateTime(); // Date actuelle

                                            $interval = $startDate->diff($endDate);

                                            if ($interval->y > 0) {
                                                echo "Réservé : " . $interval->y . " an" . ($interval->y > 1 ? "s" : "");
                                            } elseif ($interval->m > 0) {
                                                echo "Réservé : " . $interval->m . " mois";
                                            } elseif ($interval->d > 0) {
                                                echo "Réservé : " . $interval->d . " jour" . ($interval->d > 1 ? "s" : "");
                                            } else {
                                                echo "Réservé";
                                            }
                                            ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

</body>

</html>