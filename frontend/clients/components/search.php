<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-between py-3 mb-4 border-bottom">
        <div class="col-12 col-md-auto mb-2 mb-md-0">
            <a href="index.php" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="../images/logo2.png" alt="" width="60">
            </a>
        </div>

        <div class="col-12 col-md-5 mb-2 mb-md-0 text-center search">
            <form class="d-flex justify-content-center justify-content-md-between">

                <div class="container p-2">
                    <a class="text-decoration-none link-dark " href="find.php">
                        <div class="row">
                            <div class="col-md city" style="border-right: 1px solid;">
                                Ville
                            </div>
                            <div class="col-md" style="border-right: 1px solid;">
                                Quartier
                            </div>
                            <div class="col-md">
                                Chambres
                            </div>
                        </div>
                    </a>
                </div>
                <button class="btn-search" style="background-color: #D8B74B;"><i
                        class="fa-solid fa-magnifying-glass icone"></i></button>
            </form>
        </div>

        <div class="col-12 col-md-3 text-end d-none d-md-block ">
            <div class=" dropdown">

                <!-- Profil user -->
                <?php
                if (!isset ($_SESSION['photo']) || $_SESSION['photo'] === null) {
                    $defaultImage = "https://www.communedour.be/medias/images/photos-du-personnel/avatar.png/@@images/image.png"; // Utilisation d'une lettre par défaut en cas de valeur manquante
                    $imageAlt = "Default";

                    if (isset ($_SESSION['firstname']) && $_SESSION['firstname'] !== null) {
                        $defaultImage = "https://via.placeholder.com/40?text=" . strtoupper(substr($_SESSION['firstname'], 0, 1));
                        $imageAlt = $_SESSION['firstname'];
                    }

                    $imageSource = (!empty ($_SESSION['photo'])) ? $_SESSION['photo'] : $defaultImage;
                    ?>
                    <a href="#" class="link-body-emphasis text-decoration-none" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="<?= $imageSource ?>" alt="<?= $imageAlt ?>" width="40" height="40" class="rounded-circle"
                            id="profile-img">
                    </a>
                <?php } else { ?>
                    <a href="#" class="link-body-emphasis text-decoration-none" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="<?= $_SESSION['photo'] ?>" alt="<?= $_SESSION['firstname'] ?>" width="40" height="40"
                            class="rounded-circle" id="profile-img">
                    </a>
                <?php } ?>
                <!-- Fin Profil user -->

                <ul class="dropdown-menu">
                    <?php if (isset ($_SESSION['auth'])) { ?>
                        <li><a class="dropdown-item" href="profil.php">Profil</a></li>
                        <li><a class="dropdown-item" href="myAccount.php">Compte</a></li>
                        <li><a class="dropdown-item" href="message.php">Messages</a></li>
                        <li><a class="dropdown-item" href="planning.php">Réservation</a></li>

                    <?php } else { ?>
                        <li><a class="dropdown-item fw-bold" href="../forms/Signin.php">Connexion</a></li>
                        <li><a class="dropdown-item" href="../forms/Signup.php">Incription</a></li>
                    <?php } ?>
                    <li>
                        <hr>
                    </li>
                    <?php if (isset ($_SESSION['auth'])) { ?>
                        <li><a class="dropdown-item" href="../admin/">Mode hôte</a></li>
                        <li><a class="dropdown-item" href="../admin/">Favoris</a></li>
                    <?php } else { ?>
                        <li><a class="dropdown-item" href="../admin/">Mettre son logement sur airbnb</a></li>
                    <?php } ?>
                    <li><a class="dropdown-item" href="#">Centre d'aide</a></li>
                    <li><a class="dropdown-item" href="#">Confidentialité et Sécurité</a></li>
                    <li>
                        <hr>
                    </li>
                    <li><a class="dropdown-item" href="#">Langues</a></li>
                    <li><a class="dropdown-item" href="#">Voyages</a></li>
                    <?php if (isset ($_SESSION['auth'])) { ?>
                        <li>
                            <form action="" method="post">
                                <button class="dropdown-item text-danger" name="logout">Déconnexion</button>
                            </form>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </header>
</div>