<?php

require("../../backend/security.php");
require("../../backend/auth/Logout.php");
require("../../backend/clients/chat/chatbox.php");
require("../../backend/clients/chat/writemsg.php");
require("../../backend/clients/chat/Showmsg.php");

?>
<!DOCTYPE html>
<html lang="en">
<?php include("components/head.php") ?>

<body>
    <!-- Search et NavBar -->
    <?php include("components/search.php") ?>

    <!-- ---Message-- -->
    <?= include('components/box-msg.php') ?>


</body>

</html>