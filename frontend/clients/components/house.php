<style>
/* Animation pour l'icône */
@keyframes bounce {

    0%,
    20%,
    50%,
    80%,
    100% {
        transform: translateY(0);
    }

    40% {
        transform: translateY(-10px);
    }

    60% {
        transform: translateY(-5px);
    }
}

/* Appliquer l'animation à l'icône */
.fa-circle-info {
    animation: bounce 2s infinite;
    cursor: pointer;
}
</style>
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <div class="d-flex align-items-center justify-content-between">
                        <h1 class="fw-bolder mb-1"><?= $city ?>, <?= $district ?></h1>
                        <p class="fw-bold"><i class="fa-solid fa-star"></i> <small class="fs-5">5,67</small></p>
                    </div>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2"><?= $adress ?></div>
                    <!-- Post categories-->
                    <div class="d-flex justify-content-md-between">
                        <div>
                            <a class="badge text-decoration-none link-light" href="#!"><i
                                    class="fa-regular fa-comments"></i> 35
                                Commentaires</a>
                            <a class="badge text-decoration-none link-light" href="#!"><i
                                    class="fa-regular fa-heart"></i> 34
                                likes</a>
                            <a class="badge  text-decoration-none link-light" href="#!">
                                <i class="fa-solid fa-person"></i>
                                0/<?= $personne ?> personnes</a>
                        </div>
                        <a href="" class="  text-decoration-none "><i class="fa-regular fa-bookmark"></i>
                            Enregistrer</a>
                    </div>


                </header>
                <!-- Preview image figure-->
                <figure class="mb-4">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade">
                        <div class="carousel-inner">
                            <?php while ($img = $row->fetch()) { ?>
                            <div class="carousel-item active">
                                <img src="<?= $img['images'] ?>" class="d-block w-100" alt="...">
                            </div>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon prev" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon prev" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </figure>
                <hr>
                <!-- Post content-->
                <section class="mb-5">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="container text-center">
                                <div class="row justify-content-start">
                                    <div class="col-4 fs-3">
                                        <i class="fa-sharp fa-solid fa-bed"></i> <?= $bedroom ?> chambres
                                    </div>
                                    <div class="col-4 fs-3">
                                        <i class="fa-sharp fa-solid fa-ruler-combined"></i> <?= $surface ?> m2
                                    </div>
                                    <div class="col-4 fs-3">
                                        <i class="fa-sharp fa-solid fa-person"></i> <?= $personne ?> personnes
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h2 class="fw-bolder mb-4 mt-5">Ce que propose se logement</h2>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <?php while ($ags = $stmt->fetch()) { ?>
                                        <li><i class="fa-sharp fa-solid fa-hand-point-right"></i> <?= $ags['tag'] ?>
                                        </li>

                                        <?php } ?>

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </section>
            </article>
            <!-- Comments section-->
            <section class="mb-5">
                <div class="card bg-light">
                    <div class="card-body">
                        <?php
                        if (isset($e)) { ?>
                        <p class="text-danger"><?= $e ?></p>
                        <?php } elseif (isset($success)) {  ?>
                        <p class="text-success"><?= $success ?></p>
                        <?php } ?>
                        <!-- Comment form-->
                        <?php if (isset($_SESSION['auth'])) { ?>
                        <form class="mb-4" method="post">
                            <input type="text" name="iduser"
                                value="<?= $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?>" hidden>

                            <input type="text" name="idhouse" value="<?= $Id ?>" hidden>
                            <input type="text" name="idowner" value="<?= $idUser ?>" hidden>

                            <textarea class="form-control" name="quote" id="commentText" rows="3"
                                placeholder="Laissez un commentaire !"></textarea>
                            <button type="submit" name="comment" class="btn badge mt-1 p-1">Commenter <i
                                    class="fa-sharp fa-solid fa-paper-plane"></i></button>
                        </form>
                        <?php } else { ?>
                        <form class="mb-4" method="post">
                            <textarea class="form-control" name="quote" id="commentText" rows="3"
                                placeholder="Laissez un commentaire !"></textarea>
                            <a href="../forms/Signin.php" name="comment" class="btn badge mt-1 p-1">Commenter <i
                                    class="fa-sharp fa-solid fa-paper-plane"></i></a>
                        </form>
                        <?php } ?>

                        <!-- Comment with nested comments-->
                        <?php while ($com = $AllComment->fetch()) { ?>
                        <div class="d-flex mb-4">
                            <!-- Parent comment-->
                            <div class="flex-shrink-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg"
                                    alt="..." />
                            </div>
                            <div class="ms-3">
                                <div class="fw-bold">
                                    <?= $com['id_user'] ?>
                                    <?php if($com['id_user'] == $_SESSION['id']){ ?>
                                        <i class="fa-sharp fa-solid fa-ellipsis-vertical mr-4"></i>
                                   <?php } ?>
                                </div>
                                <?= $com['comment'] ?>
                            </div>
                        </div>
                        <?php } ?>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4 position-sticky" style="top: 2rem;">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Loyer</div>
                <div class="card-body ">
                    <div class="input-group mb-4">
                        <h4><?= number_format($rent, 0, '', ' '); ?> DH / mois</h4>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos, ipsa!
                    </div>
                </div>
                <div class="card-header">
                    Occupation <i class="fa-solid fa-circle-info text-primary" data-bs-toggle="modal"
                        data-bs-target="#exampleModal"></i>

                </div>
            </div>

            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Détails</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!" data-bs-toggle="tooltip" data-bs-title="Another one here too">Loyer</a>
                                </li>
                                <li><a href="#!">Caution</a></li>
                                <li><a href="#!">Frais ménage</a></li>
                                <li><a href="#!">Frais service etando</a></li>

                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!"><?= number_format($rent, 0, '', ' '); ?> DH</a></li>
                                <li><a href="#!"><?= number_format($guaranteed, 0, '', ' '); ?> DH</a></li>
                                <li><a href="#!"><?= number_format($menage, 0, '', ' '); ?> DH</a></li>
                                <li><a href="#!">500 DH</a></li>

                            </ul>
                        </div>
                        <?php if (isset($_SESSION['auth'])) { ?>
                        <a href="checkout.php?id=<?= $Id ?>" class="btn badge mt-3 btn-lg">Réserver</a>
                        <?php } else { ?>
                        <!--<a href="../forms/Signin.php" class="btn btn-danger mt-3">Réserver</a>-->
                            <form action="../forms/Signin.php" method="get">
                                <input type="hidden" name="link" id="link" value="<?= $Id ?>">
                                <div>
                                    <button type="submit" class="btn btn-danger mt-3">Crée un Compte</button>
                                </div>
                            </form>

                        <?php } ?>
                    </div>

                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Informations hôte</div>
                <div class="flex-shrink-0 text-center badge ">
                    <img class="rounded-circle p-4"
                        src="https://www.communedour.be/medias/images/photos-du-personnel/avatar.png/@@images/image.png"
                        alt="..." width="150" />

                    <h4><?= $fname ?> <?= $lanme ?> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            fill="currentColor" class="bi bi-patch-check-fill" viewBox="0 0 16 16">
                            <path
                                d="M10.067.87a2.89 2.89 0 0 0-4.134 0l-.622.638-.89-.011a2.89 2.89 0 0 0-2.924 2.924l.01.89-.636.622a2.89 2.89 0 0 0 0 4.134l.637.622-.011.89a2.89 2.89 0 0 0 2.924 2.924l.89-.01.622.636a2.89 2.89 0 0 0 4.134 0l.622-.637.89.011a2.89 2.89 0 0 0 2.924-2.924l-.01-.89.636-.622a2.89 2.89 0 0 0 0-4.134l-.637-.622.011-.89a2.89 2.89 0 0 0-2.924-2.924l-.89.01-.622-.636zm.287 5.984-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7 8.793l2.646-2.647a.5.5 0 0 1 .708.708z" />
                        </svg></h4>

                </div>
                <div class="card-body">
                    <p class="fst-italic">
                        <?php
                        $year;

                        $startDate = new DateTime($year);
                        $endDate = new DateTime(); // Date actuelle

                        $interval = $startDate->diff($endDate);

                        if ($interval->y > 0) {
                            echo "Membre depuis : " . $interval->y . " an" . ($interval->y > 1 ? "s" : "");
                        } elseif ($interval->m > 0) {
                            echo "Membre depuis : " . $interval->m . " mois";
                        } elseif ($interval->d > 0) {
                            echo "Membre depuis : " . $interval->d . " jour" . ($interval->d > 1 ? "s" : "");
                        } else {
                            echo "Membre depuis moins d'un jour";
                        }
                        ?>
                    </p>

                    <p>You can put anything you want inside of these side widgets. They are easy to
                        use, and feature the Bootstrap 5 card component!</p>
                    <a class="btn badge" href="write.php?id=<?= $idUser ?>">Envoyer message <i
                            class="fa-regular fa-message"></i></a>
                </div>

            </div>
        </div>
        <!-- Modal Occupation -->
        <?php include("modal.php") ?>
    </div>
</div>
<script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')

if (toastTrigger) {
    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
    toastTrigger.addEventListener('click', () => {
        toastBootstrap.show()
    })
}
</script>