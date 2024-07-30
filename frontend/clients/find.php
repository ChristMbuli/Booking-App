<?php

session_start();
require("../../backend/auth/Logout.php");
require("../../backend/clients/controllers/FindAll.php");



?>
<!DOCTYPE html>
<html lang="en">
<?php include("components/head.php") ?>
<link rel="stylesheet" href="assets/find.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

<body>
    <!-- Search et NavBar -->
    <?php include("components/search.php") ?>

    <!-- ---Card-- -->

    <div class="container">
        <div class="row">
            <!-- BEGIN SEARCH RESULT -->
            <div class="col-md-12">
                <div class="grid search">
                    <div class="grid-body">
                        <div class="row">
                            <!-- BEGIN FILTERS -->
                            <div class="col-md-3">
                                <h2 class="grid-title"><i class="fa fa-filter"></i> Filters</h2>
                                <hr>

                                <!-- BEGIN FILTER BY CATEGORY -->
                                <h4>Categories:</h4>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> Appartement meublé</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> Appartement Vide</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> Studio Vide</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> Studio Meublé</label>
                                </div>
                                <div class="checkbox">
                                    <label><input type="checkbox" class="icheck"> Chambre Meublé</label>
                                </div>
                                <!-- END FILTER BY CATEGORY -->

                                <div class="padding"></div>

                                <!-- BEGIN FILTER BY DATE -->
                                <hr>
                                <h4>Lieux & Autres</h4>

                                <div class="input-group date form_date mb-3">
                                    <input type="text" class="form-control" placeholder="Entrer le nom d'un lieux">
                                </div>

                                <div class="input-group date form_date">
                                    <input type="text" class="form-control" placeholder="Nombre Chambre">
                                </div>
                                <input type="hidden" id="dtp_input2" value="">
                                <!-- END FILTER BY DATE -->

                                <div class="padding"></div>

                                <!-- BEGIN FILTER BY PRICE -->
                                <hr>
                                <h4>Loyer & Caution</h4>
                                <div class="slider-primary">
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Loyer"
                                            aria-label="Username">
                                        <span class="input-group-text">&</span>
                                        <input type="number" class="form-control" placeholder="Caution"
                                            aria-label="Server">
                                    </div>
                                </div>
                                <!-- END FILTER BY PRICE -->
                            </div>
                            <!-- END FILTERS -->
                            <!-- BEGIN RESULT -->
                            <div class="col-md-9">
                                <h2><i class="fa-solid fa-magnifying-glass"></i> Recherche</h2>
                                <hr>
                                <!-- BEGIN SEARCH INPUT -->

                                <form method="get" class="input-group">
                                    <input type="text" class="form-control" name="city" placeholder="ville"
                                        value="<?= isset($_GET['city']) ? htmlspecialchars($_GET['city']) : '' ?>">
                                    <input type="text" class="form-control" name="district" placeholder="quartier"
                                        value="<?= isset($_GET['district']) ? htmlspecialchars($_GET['district']) : '' ?>">

                                    <button class="btn-search" type="submit" name="search"
                                        style="background-color: #D8B74B;"><i
                                            class="fa-solid fa-magnifying-glass icone"></i></button>
                                </form>



                                <!-- BEGIN TABLE RESULT -->
                                <div class="container px-3 my-5">
                                    <div class="row gx-3">
                                        <!-- Erreur search -->
                                        <?php echo $searchMessage; ?>
                                        <!-- Fin search erreur -->
                                        <?php if (count($searchResults) > 0) {
                                            foreach ($searchResults as $row) { ?>
                                        <div class="col-lg-4 mb-5">
                                            <div class="card h-100 shadow border-0">
                                                <img class="card-img-top" src="<?= $row['house_image'] ?>" alt="..." />
                                                <div class="card-body p-2">
                                                    <?php
                                                            // Date actuelle
                                                            $currentDate = time(); // Timestamp actuel en secondes

                                                            // Date dans $res['created_at']
                                                            $createdAt = strtotime($row['created_at']); // Timestamp de la date $res['created_at']

                                                            // Différence en secondes entre les deux dates
                                                            $difference = $currentDate - $createdAt;
                                                            $differenceInDays = $difference / (60 * 60 * 24); // Convertir la différence en jours

                                                            // Vérifier si la différence est inférieure à 5 jours pour afficher le badge
                                                            if ($differenceInDays < 5) { ?>
                                                    <div class="badge bg-gradient rounded-pill mb-2">Nouveau</div>
                                                    <?php } ?>

                                                    <a class="text-decoration-none link-dark stretched-link"
                                                        href="single.php?id=<?= $row['id_house'] ?>">
                                                        <h5 class="card-title mb-3 fs-6 fw-bold"><?= $row['city'] ?>,
                                                            <?= $row['district'] ?></h5>
                                                    </a>
                                                    <p class="card-text mb-0"><i class="fa-solid fa-person"></i>
                                                        0/<?= $row['npersonn'] ?>
                                                        (personnes)</p>
                                                </div>
                                                <div class="card-footer p-2 pt-0 bg-transparent border-top-0">
                                                    <div class="align-items-end">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="small">
                                                                <div class="fw-bold fs-5">
                                                                    <?= number_format($row['rent'], 0, '', ' '); ?> DH
                                                                </div>
                                                            </div>
                                                            <div class="small">
                                                                <div class="fw-bold fs-6"><i
                                                                        class="fa-solid fa-star fs-6"></i> 5,56</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }
                                        } else {
                                            foreach ($searchResults as $randomHouse) { ?> ?>
                                        <div class="col-lg-4 mb-5">
                                            <div class="card h-100 shadow border-0">
                                                <img class="card-img-top" src="<?= $randomHouse['house_image'] ?>"
                                                    alt="..." />
                                                <div class="card-body p-2">
                                                    <?php
                                                            // Date actuelle
                                                            $currentDate = time(); // Timestamp actuel en secondes

                                                            // Date dans $res['created_at']
                                                            $createdAt = strtotime($randomHouse['created_at']); // Timestamp de la date $res['created_at']

                                                            // Différence en secondes entre les deux dates
                                                            $difference = $currentDate - $createdAt;
                                                            $differenceInDays = $difference / (60 * 60 * 24); // Convertir la différence en jours

                                                            // Vérifier si la différence est inférieure à 5 jours pour afficher le badge
                                                            if ($differenceInDays < 5) { ?>
                                                    <div class="badge bg-gradient rounded-pill mb-2">Nouveau</div>
                                                    <?php } ?>

                                                    <a class="text-decoration-none link-dark stretched-link"
                                                        href="single.php?id=<?= $row['id_house'] ?>">
                                                        <h5 class="card-title mb-3 fs-6 fw-bold">
                                                            <?= $randomHouse['city'] ?>,
                                                            <?= $randomHouse['district'] ?></h5>
                                                    </a>
                                                    <p class="card-text mb-0"><i class="fa-solid fa-person"></i>
                                                        0/<?= $randomHouse['npersonn'] ?>
                                                        (personnes)</p>
                                                </div>
                                                <div class="card-footer p-2 pt-0 bg-transparent border-top-0">
                                                    <div class="align-items-end">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <div class="small">
                                                                <div class="fw-bold fs-5">
                                                                    <?= number_format($randomHouse['rent'], 0, '', ' '); ?>
                                                                    DH
                                                                </div>
                                                            </div>
                                                            <div class="small">
                                                                <div class="fw-bold fs-6"><i
                                                                        class="fa-solid fa-star fs-6"></i> 5,56</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                                <!-- END TABLE RESULT -->
                            </div>
                            <!-- END RESULT -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END SEARCH RESULT -->
        </div>
    </div>


</body>

</html>