<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0">

                <h5 class="font-weight-bold mb-3 text-center text-lg-start">Discussion</h5>

                <div class="card">
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <?php if ($ReqUsers->rowCount() == 0) {
                                echo $msg;
                            } else {
                                while ($user = $ReqUsers->fetch()) { ?>
                            <li class="p-2 border-bottom" style="background-color: #eee;">
                                <a href="write.php?id=<?= $user['id_user'] ?>" class="d-flex justify-content-between">
                                    <div class="d-flex flex-row">
                                        <img src="https://placekitten.com/640/360" alt="avatar"
                                            class="rounded-circle d-flex align-self-center me-3 shadow-1-strong"
                                            width="60">
                                        <div class="pt-1">
                                            <p class="fw-bold mb-0"><?= $user['fname'] . ' ' . $user['lname'] ?></p>
                                        </div>
                                    </div>
                                    <div class="pt-1">
                                        <p class="small text-muted mb-1">
                                            <?php
                                                    $year = $user['last_message_date'];

                                                    $startDate = new DateTime($year);
                                                    $endDate = new DateTime(); // Date actuelle

                                                    $interval = $startDate->diff($endDate);

                                                    if ($interval->y > 0) {
                                                        echo "" . $interval->y . " an" . ($interval->y > 1 ? "s" : "");
                                                    } elseif ($interval->m > 0) {
                                                        echo "" . $interval->m . " mois";
                                                    } elseif ($interval->d > 0) {
                                                        echo "" . $interval->d . " jour" . ($interval->d > 1 ? "s" : "");
                                                    } else {
                                                        echo "aujourd'hui";
                                                    }
                                                    ?>
                                        </p>
                                    </div>
                                </a>
                            </li>
                            <?php }
                            } ?>
                        </ul>

                    </div>
                </div>

            </div>
            <div class="col-md-6 col-lg-7 col-xl-8">
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Message</h4>
                    <p>Aww yeah, you successfully read this important alert message. This example text is going to run a
                        bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                    <hr>
                    <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.
                    </p>
                </div>

            </div>

        </div>

    </div>
</section>