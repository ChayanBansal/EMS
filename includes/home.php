<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="/ems/css/style.css">
    <style>
    .c_ug_pg{
        margin-bottom: 100px;
    }
    </style>
</head>
<body>
<?php
    session_start();
    require("config.php");
    require("frontend_lib.php");
    require("class_lib.php");
    $validate=new validate();
    $validate->conf_logged_in();
    $obj=new head();
    $obj->displayheader();
    $obj->dispmenu(3,["/ems/includes/home.php","/ems/includes/logout.php","/ems/includes/developers.php"],["glyphicon glyphicon-home","glyphicon glyphicon-log-out","glyphicon glyphicon-info-sign"],["Home","Log Out","About Us"]);
    $dashboard=new dashboard();
    $dashboard->display($_SESSION['operator_name'],["Change Password","Sign Out"],["change_password.php","index.php"],"Contact Super Admin");
    $ai=new course();
    $ai->display($conn);
    
    ?>

    <?php
        $obj=new footer();
        $obj->disp_footer();
        $logout_modal=new modals();
    $logout_modal->display_logout_modal();
    ?>
          
</body>
</html>