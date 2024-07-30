<section class="py-2">
    <div class="container px-5 my-5">
        <div class="row gx-5">
            <?php while ($res = $req->fetch()) { ?>
            <div class="col-lg-4 mb-5">
                <div class="card h-100 shadow border-0">
                    <img class="card-img-top" src="<?= $res['images'] ?>" alt="..." />
                    <div class="card-body p-2">
                        <?php
                            // Date actuelle
                            $currentDate = time(); // Timestamp actuel en secondes

                            // Date dans $res['created_at']
                            $createdAt = strtotime($res['created_at']); // Timestamp de la date $res['created_at']

                            // Différence en secondes entre les deux dates
                            $difference = $currentDate - $createdAt;
                            $differenceInDays = $difference / (60 * 60 * 24); // Convertir la différence en jours

                            // Vérifier si la différence est inférieure à 5 jours pour afficher le badge
                            if ($differenceInDays < 5) { ?>
                        <div class="badge bg-gradient rounded-pill mb-2">Nouveau</div>
                        <?php } ?>

                        <a class="text-decoration-none link-dark stretched-link"
                            href="single.php?id=<?= $res['id_house'] ?>">
                            <h5 class="card-title mb-3 fs-6 fw-bold"><?= $res['city'] ?>, <?= $res['district'] ?></h5>
                        </a>
                        <p class="card-text mb-0"><i class="fa-solid fa-person"></i> 0/<?= $res['npersonn'] ?>
                            (personnes)</p>
                    </div>
                    <div class="card-footer p-2 pt-0 bg-transparent border-top-0">
                        <div class="align-items-end">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="small">
                                    <div class="fw-bold fs-4"><?= number_format($res['rent'], 0, '', ' '); ?> DH </div>
                                </div>
                                <div class="small">
                                    <div class="fw-bold fs-5"><i class="fa-solid fa-star fs-5"></i> 5,56</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>