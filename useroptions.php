<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Options</title>
    <link rel="stylesheet" href="style.css">
    <style>
    #sem{
        margin: 10px;
        width: 40%;
    }
    .sem{
        width: 100%;
        display: flex;
        justify-content: center;
        text-align: center;
    }
    body{
        overflow: auto;
    }
    </style>
</head>
<body>
<?php
    session_start();
    require("config.php");
    require("frontend_lib.php");
    require("class_lib.php");
    if(isset($_POST['course']))
    {
    $_SESSION['current_course_name']=$_POST['course'];
    $current_course_name=$_SESSION['current_course_name'];
    $selected_course="SELECT course_id FROM courses WHERE course_name='$current_course_name'";
    $selected_course_run=mysqli_query($conn,$selected_course);
    $selected_course_result=mysqli_fetch_assoc($selected_course_run);
    $_SESSION['current_course_id']=$selected_course_result['course_id'];
    }
$valid=new validate();
$valid->conf_logged_in();
$obj=new head();
$obj->displayheader();
$obj->dispmenu(3,["home.php","index.php","developers.php"],["glyphicon glyphicon-home","glyphicon glyphicon-log-out","glyphicon glyphicon-info-sign"],["Home","Log Out","About Us"]);
$dashboard=new dashboard();
$dashboard->display($_SESSION['operator_name'],["Change Password","Sign Out"],["change_password.php","index.php"],"Contact Super Admin");
?>
<div class="cr_container">
<div class="tcaption">
Please select a choice:</div>
</div>
<?php
$options=new useroptions();
$options->display($conn);
$options->check_opt();
?>

<?php
        $obj=new footer();
        $obj->disp_footer();
    ?>
</body>
</html>
