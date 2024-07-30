<!-- ------------------------------------- -->
<?php
// Date initiale
$date;
// Convertir la date en timestamp
$timestamp = strtotime($date);

// Calculer la différence de temps
$timeDiff = time() - $timestamp;

// Déterminer l'unité de temps à afficher en fonction de la différence de temps
if ($timeDiff < 60) {
    $displayTime = $timeDiff . ' seconds ago';
} elseif ($timeDiff < 3600) {
    $displayTime = floor($timeDiff / 60) . ' minutes ago';
} elseif ($timeDiff < 86400) {
    $displayTime = floor($timeDiff / 3600) . ' hours ago';
} elseif ($timeDiff < 604800) {
    $displayTime = floor($timeDiff / 86400) . ' days ago';
} elseif ($timeDiff < 2419200) {
    $displayTime = floor($timeDiff / 604800) . ' weeks ago';
} elseif ($timeDiff < 29030400) {
    $displayTime = floor($timeDiff / 2419200) . ' months ago';
} else {
    $displayTime = floor($timeDiff / 29030400) . ' years ago';
}

?>
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
                                                <img src="https://placekitten.com/640/360" alt="avatar" class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
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
                <div class="mb-3">
                    <a href="message.php"><i class="fa-solid fa-angle-left"></i> Retour </a>
                </div>
                <ul class="list-unstyled">

                    <?php if (isset($messages) && !empty($messages)) : ?>
                        <?php foreach ($messages as $message) : ?>
                            <?php if ($message['id_owner'] == $getId) : ?>
                                <li class="d-flex justify-content-between mb-4">
                                    <img src="<?= $message['photo'] ?>" alt="avatar" class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between p-3">
                                            <p class="fw-bold mb-0"><?= $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?></p>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0">
                                                <?= $message['msg'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            <?php else : ?>
                                <li class="d-flex justify-content-between mb-4">
                                    <div class="card w-100">
                                        <div class="card-header d-flex justify-content-between p-3">
                                            <p class="fw-bold mb-0"><?= $name ?></p>
                                            <p class="text-muted small mb-0"><i class="far fa-clock"></i> 13 mins ago</p>
                                        </div>
                                        <div class="card-body">
                                            <p class="mb-0">
                                                <?= $message['msg'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <img src="<?= $message['photo'] ?>" alt="avatar" class="rounded-circle d-flex align-self-start ms-3 shadow-1-strong" width="60">
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <?= $msg ?>
                    <?php endif; ?>


                    <form action="" method="post">
                        <li class="bg-white mb-3">
                            <div class="form-outline">
                                <textarea class="form-control" name="msg" id="textAreaExample2" rows="4"></textarea>
                            </div>
                        </li>
                        <button type="submit" name="chat" class="btn badge btn-rounded float-end">Envoyer <i class="fa-solid fa-paper-plane"></i></button>
                    </form>

                </ul>

            </div>

        </div>

    </div>
</section>