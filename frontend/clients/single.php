<?php

session_start();
require("../../backend/auth/Logout.php");
require("../../backend/clients/controllers/singleHouse.php");
require("../../backend/clients/controllers/Comment.php");


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
    <?php include("components/house.php") ?>



</body>

</html>