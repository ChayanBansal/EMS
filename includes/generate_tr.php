<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate TR</title>
    <style>
    table{
        font-family: 'Open Sans';
        font-size: 1.6rem;
    }
    table tr td{
       vertical-align: middle !important;
       text-align: center;
    }
    table caption{
        width: 100%;
        padding: 1rem;
        background: #2D79E9;
        color: white;
        text-align: center;
    }
    .bar{
        float: right;
    }
    .name{
        float: left;
    }
    .progress{
        margin-bottom: 0px !important;
    }
    hr{
        border: 2px solid red !important;
    }
    </style>
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
$input_btn=new input_button();
?>
<table class="table table-responsive table-striped table-bordered">
    <caption><div class="name col-lg-6 col-md-6">B.Tech CSIT</div>  
    <div class="bar col-lg-6 col-md-6">
        <div class="progress" style="font-size: 1.6rem">
    <div class="progress-bar progress-bar-success progress-bar-striped " role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
      1/n subjects completed
    </div>
  </div></div> 
</caption>
    <thead>
        <tr>
            <td rowspan="2">Subject Name</td>
            <td colspan="6">Components</td>
        </tr>
        <tr>
            <td>CAT</td>
            <td>End Sem Theory</td>
            <td>CAP</td>
            <td>End Sem Practical</td>
            <td>IA</td>
            <td>Internal Examination</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Adv Software Engg.</td>
            <td><i class="glyphicon glyphicon-ok" style="color:#30A21C"></i></td>
            <td><i class="glyphicon glyphicon-remove" style="color: #CD331D"></i></td>
            <td><i class="glyphicon glyphicon-minus-sign"></i></td>
            <td><i class="glyphicon glyphicon-minus-sign"></i></td>
            <td><i class="glyphicon glyphicon-minus-sign"></i></td>
            <td><i class="glyphicon glyphicon-minus-sign"></i></td>
        </tr>
    </tbody>
    <caption align="bottom">
        <?php
        $input_btn->display_btn("","btn btn-default","submit","","",'Generate TR <i class="glyphicon glyphicon-circle-arrow-right"></i>');
        ?>
    </caption>
</table>
<hr>
<?php
$obj = new footer();
$obj->disp_footer();
?>
</body>
</html>