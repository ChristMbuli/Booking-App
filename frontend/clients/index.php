<?php

session_start();
require("../../backend/auth/Logout.php");
require("../../backend/clients/controllers/showAll.php");



?>
<!DOCTYPE html>
<html lang="en">
<?php include("components/head.php") ?>

<body>
    <!-- Search et NavBar -->
    <?php include("components/search.php") ?>

    <!-- ---Card-- -->
    <?php include("components/cards.php") ?>



</body>

</html>