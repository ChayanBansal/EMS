<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Details</title>
    <style>
        .list{
            padding: 20px;
        }
        table tr td,th{
            text-align: center !important;
            font-size: 16px;
        }
        table th{
            font-weight: bold;
        }
        table .noborder{
            border: none;
            background: transparent;
            width: 100%;
            height: 100%;
        }
        .filter{
            margin: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
        }
        .form-group{
            width: 50%;
        }
    </style>
</head>
<body>
<?php
    session_start();
    require("config.php");
    require("frontend_lib.php");
    require("class_lib.php");
    $authorize=new validate();
    $authorize->conf_logged_in();
    $obj=new head();
    $obj->displayheader();
    $obj->dispmenu(4,["home.php","index.php","useroptions.php","developers.php"],["glyphicon glyphicon-home","glyphicon glyphicon-log-out",'glyphicon glyphicon-th',"glyphicon glyphicon-info-sign"],["Home","Log Out","Options","About Us"]);
    $dashboard=new dashboard();
    $dashboard->display($_SESSION['operator_name'],["Change Password","Sign Out"],["change_password.php","index.php"],"Contact Super Admin");
    $student_disp=new students();
    $student_disp->gotofeed($conn);   
    $student_disp->display($conn);
        
   ?>
   
    <?php

        $obj=new footer();
        $obj->disp_footer();
    ?>
</body>
</html>