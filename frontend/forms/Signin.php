<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("../../backend/auth/Login.php");
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Airbnb || Clone</title>
    <link rel="stylesheet" href="./assets/signin.css">
    <link rel="stylesheet" href="./assets/signin.sass">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
#button {
    background-color: #D8B74B;
    color: white;
}
</style>

<body>
    <main class="form-signin m-auto">
        <form class="row g-3" method="post">
            <div class="text-center">
                <a href="../clients/index.php">
                    <img class="mb-4" src="../images/logo4.png" alt="logo" width="72" height="72">
                </a>
            </div>
            <h1 class="h3 mb-3 fw-normal text-center fw-medium titre">Connexion</h1>
            <!-- Message d'erreur -->
            <?php if (isset($msgError)) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $msgError .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            } ?>
            <!-- Fin Message d'erreur -->
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="mdp" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Mot de passe</label>
            </div>

            <div class=" my-3 links-flex">
                <a href="" class="fs-6">Mot de passe oublié ?</a>
                <a href="Signup.php" class="fs-6">Vous n'avez pas de compte ?</a>
            </div>
            <button class="btn w-100 py-2" name="signin" type="submit" id="button">Connexion</button>
        </form>
    </main>
    <?php include("Footer.php") ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>