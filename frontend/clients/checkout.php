<?php

session_start();
require("../../backend/auth/Logout.php");
require("../../backend/clients/controllers/singleHouse.php");
require("../../backend/clients/controllers/reservation.php");


?>
<!DOCTYPE html>
<html lang="en">
<?php include("components/head.php") ?>

<body>
    <!-- Search et NavBar -->
    <?php include("components/search.php") ?>

    <!-- ---Check out-- -->
    <?php include("components/Items.php") ?>


</body>

</html>