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
                                <a href="myAccount.php" class="btn badge me-3">Mon mompte </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">
                                        <?= $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?= $_SESSION['contact'] ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">null</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Mobile</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">null</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">null</p>
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