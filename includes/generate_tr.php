<?php
session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
if (isset($_POST['tr_submit'])) {
    $_SESSION['from_year'] = $_POST['tr_from_year'];
    $_SESSION['course_id'] = $_POST['tr_course'];
    $get_course_name_qry = "SELECT course_name from courses where course_id=" . $_SESSION['course_id'];
    $get_course_name_qry_run = mysqli_query($conn, $get_course_name_qry);
    if ($get_course_name_qry_run) {
        $res = mysqli_fetch_assoc($get_course_name_qry_run);
        $_SESSION['course_name'] = $res['course_name'];
    }
}
?><!DOCTYPE html>
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
    .subtitle{
        padding: 10px;
        font-family: 'Open Sans';
        text-transform: uppercase;
        border-bottom: 1px dotted black;
        
    }
    </style>
</head>
<body>
<?php

$obj = new head();
$obj->displayheader();
$obj->dispmenu(3, ["/ems/includes/home.php", "/ems/includes/index.php", "/ems/includes/developers.php"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
$dashboard = new dashboard();
$dashboard->display_super_dashboard($_SESSION['super_admin_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "");
$input_btn = new input_button();
?>
 <div class="display">
        <div class="subtitle">
           Showing results for: <?= $_SESSION['course_name'] ?>
            </div>
        </div>
<?php
$get_current_sem_qry = "SELECT current_semester FROM academic_sessions WHERE from_year=" . $_SESSION['from_year'] . " AND course_id=" . $_SESSION['course_id'];
$get_current_sem_qry_run = mysqli_query($conn, $get_current_sem_qry);
if ($get_current_sem_qry_run) {
    while ($semester = mysqli_fetch_assoc($get_current_sem_qry_run)) {
        $sem = $semester['current_semester'];
        echo ('
        <table class="table table-responsive table-striped table-bordered">
        <caption><div class="name col-lg-6 col-md-6">' . $_SESSION['course_name'] . '</div>  
        <div class="col-lg-3 col-md-3">
        SEMESTER ' . $sem . '
        </div>
        <div class="bar col-lg-3 col-md-3">
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
');
        $get_comp_qry = "SELECT component_name from component";
        $get_comp_qry_run = mysqli_query($conn, $get_comp_qry);
        if ($get_comp_qry_run) {
            while ($comp = mysqli_fetch_assoc($get_comp_qry_run)) {
                echo ('
                <td>'.$comp['component_name'].'</td>
                    ');
            }
        }else{
            echo("Abye ae!");
        }
        echo('</tr>
        </thead>
        <tbody>');
        $get_sub_qry = "SELECT * from subjects WHERE course_id=" . $_SESSION['course_id'] . " AND semester=" . $sem;
        $get_sub_qry_run = mysqli_query($conn, $get_sub_qry);
        if ($get_sub_qry_run) {
            while ($sub = mysqli_fetch_assoc($get_sub_qry_run)) {
                echo(' <tr><td>'.$sub['sub_name'].'</td>');
                $get_subcomp_qry="SELECT distinct(component_id) from component_distribution where sub_id IN(SELECT sub_id FROM sub_distribution WHERE sub_code='".$sub['sub_code']."') ORDER BY component_id";
                    $get_subcomp_qry_run=mysqli_query($conn,$get_subcomp_qry);
                    $comp_id=1;
                    $component_count=0;
                    while($subcomp=mysqli_fetch_assoc($get_subcomp_qry_run)){
                        comp_check:
                        if($comp_id==$subcomp['component_id']){
                            $check_auditing_qry="SELECT check_id FROM auditing WHERE component_id=".$comp_id." AND semester=".$sem." AND course_id=".$_SESSION['course_id']." AND from_year=".$_SESSION['from_year']." AND sub_code='".$sub['sub_code']."'";
                            $check_auditing_qry_run=mysqli_query($conn,$check_auditing_qry);
                            $check_id=mysqli_fetch_assoc($check_auditing_qry_run);
                            if(is_null($check_id)){
                                echo(' <td><i class="glyphicon glyphicon-remove" style="color: #CD331D"></i></td>');
                            }
                            else{
                                echo(' <td><i class="glyphicon glyphicon-ok" style="color:#30A21C"></i></td>
                                ');
                                $component_count++;
                            }
                            $comp_id++;
                        }
                        else{
                            echo('<td><i class="glyphicon glyphicon-minus-sign"></i></td>');
                            $comp_id++;
                            goto comp_check;
                        }
                    }
                    echo('</tr>');
            }
        }
        echo('</tbody>
        <caption align="bottom">');
            $input_btn->display_btn("", "btn btn-default", "submit", "", "", ' Generate TR < i class =
                    "glyphicon glyphicon-circle-arrow-right" > < / i >');
            echo('
        </caption>
    </table>
    <hr>');

    }
}
?>


<?php
$obj = new footer();
$obj->disp_footer();
?>
</body>
</html>