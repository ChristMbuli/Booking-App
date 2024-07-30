<?php

require("../../backend/security.php");
require("../../backend/auth/Logout.php");
require("../../backend/clients/controllers/showAll.php");
require("../../backend/clients/chat/chatbox.php");

?>
<!DOCTYPE html>
<html lang="en">
<?php include("components/head.php") ?>

<body>
    <!-- Search et NavBar -->
    <?php include("components/search.php") ?>

    <!-- ---Message-- -->
    <?php include("components/box.php") ?>



</body>

</html>