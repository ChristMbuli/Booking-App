<?php

session_start();
require("../../backend/security.php");
require("../../backend/auth/Logout.php");

?>
<!DOCTYPE html>
<html lang="en">
<?php include("components/head.php") ?>
<style>
.prev {
    background-color: #D8B74B;
    border-radius: 50%;
    padding: 5px;
}
</style>

<body>
    <!-- Search et NavBar -->
    <?php include("components/search.php") ?>

    <!-- ---Card-- -->

    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="https://placebeard.it/500x500" alt="avatar" class="rounded-circle img-fluid"
                                style="width: 150px;">
                            <h5 class="my-3"><?= $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?></h5>
                            <p class="text-muted mb-4">Rdc, Kinshasa</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn badge me-3">Editer <i
                                        class="fa-solid fa-pen"></i></button>
                                <a href="profil.php" class="btn badge me-3">Profil </a>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">Vous occupé</span> cette
                                        maison
                                    </p>
                                    <div class="card">
                                        <div class="bg-image hover-overlay" data-mdb-ripple-init
                                            data-mdb-ripple-color="light">
                                            <img src="https://a0.muscache.com/im/pictures/miso/Hosting-972329329856169815/original/6545e78a-1898-4137-9444-85da7ec814db.jpeg?im_w=720"
                                                class="img-fluid" />
                                            <a href="#!">
                                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <h5 class="card-title">Casablanca, Maarif</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>