<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Subject</title>
</head>
<body>
    <?php
    session_start();
    require("config.php");
    require("frontend_lib.php");
    require("class_lib.php");
    $obj = new head();
    $obj->displayheader();
    $obj->dispmenu(3, ["/ems/includes/home.php", "/ems/includes/index.php", "/ems/includes/developers.php"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
    $dashboard = new dashboard();
    $dashboard->display_super_dashboard($_SESSION['super_admin_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "");

    ?>
    <div class="feed-container">
        
    </div>
<?php
$obj = new footer();
$obj->disp_footer();
?>
</body>
</html>