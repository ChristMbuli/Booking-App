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
<?php include("components/Navleft.php") ?>

<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    <!-- header -->
    <?php include("components/header.php") ?>

    <!-- Cards -->
    <div class="container">
        <?php include("components/box-msg.php") ?>
    </div>
</div>


<!-- CoreUI and necessary plugins-->
<script src="vendors/@coreui/coreui/js/coreui.bundle.min.js"></script>
<script src="vendors/simplebar/js/simplebar.min.js"></script>
<!-- Plugins and scripts required by this view-->
<script src="vendors/chart.js/js/chart.min.js"></script>
<script src="vendors/@coreui/chartjs/js/coreui-chartjs.js"></script>
<script src="vendors/@coreui/utils/js/coreui-utils.js"></script>
<script src="js/main.js"></script>

</body>

</html>