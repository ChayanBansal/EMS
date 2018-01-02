<?php
session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$validate=new validate();
$validate->conf_logged_in_super();
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
else{
    header('location: super_home.php');
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Generate TR</title>
    <link rel="stylesheet" href="/ems/css/progress-bar.css">
     <style>
         body{
             background: white !important;
         }
    table{
        font-family: 'Open Sans';
        font-size: 1.6rem;
    }
    table tr td,table tr th{
       vertical-align: middle !important;
       text-align: center;
    }
    table tr th{
        font-weight: bolder!important;
    }
    table caption{
        width: 100%;
        padding: 1.2rem;
        background: #2D79E9;
        color: white;
        text-align: center;
    }
    .name{
        float: left;
    }
    .progress{
        margin-bottom: 0;
    }
    .progress-bar{
        display: flex;
        align-items: center;    
        width: 0%;
        animation: loadprog 1800ms ease-in-out;
    }
    @keyframes loadprog{
        0%{
            width: 0%;
        }
    }
    .progress span {
        position: absolute;
        display: block;
        width: 100%;
        color: black;
        font-size: 1.4rem;
     }
    hr{
        border: 2px solid red !important;
        width: 100%;
        margin-bottom: 5rem;
    }
    .subtitle{
        padding: 10px;
        font-family: 'Open Sans';
        text-transform: uppercase;
        border-bottom: 1px dotted black;
        margin-bottom: 10px;
        font-size: 1.6rem;
        
    }

    .display{
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        flex-direction: column;
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
            Academic Session: <?= $_SESSION['from_year'] ?>
            </div>
            <div class="subtitle">
           Course:  <?= $_SESSION['course_name'] ?>
            </div>

<?php
$get_current_sem_qry = "SELECT current_semester FROM academic_sessions WHERE from_year=" . $_SESSION['from_year'] . " AND course_id=" . $_SESSION['course_id'];
$get_current_sem_qry_run = mysqli_query($conn, $get_current_sem_qry);
if ($get_current_sem_qry_run) {
    while ($semester = mysqli_fetch_assoc($get_current_sem_qry_run)) {
        $sem = $semester['current_semester'];
        echo ('
        <form action="generate_tr_back_end.php" method="POST">
        <table class="table table-responsive table-striped table-bordered">
        <caption><div class="name col-lg-7 col-md-7">' . $_SESSION['course_name'] . '</div>  
        <div class="col-lg-5 col-md-5">
        SEMESTER ' . $sem . '
        </div>
       
</caption>

<thead>
<tr>
<th rowspan="2"><strong>Subject Name</strong></th>
<th colspan="6">Components</th>
</tr>
<tr>        
');
        $get_comp_qry = "SELECT component_name from component";
        $get_comp_qry_run = mysqli_query($conn, $get_comp_qry);
        if ($get_comp_qry_run) {
            while ($comp = mysqli_fetch_assoc($get_comp_qry_run)) {
                echo ('
                <th>' . $comp['component_name'] . ' <a data-toggle="popover" title="Meaning of symbols" data-content="A tick indicates marks have been entered, a cross indicates marks for that component are due to be entered, and a minus sign indicates the subject does not have that component"><i class="glyphicon glyphicon-info-sign"></i></a></th>
                    ');
            }
        }
        echo ('</tr>
        </thead>
        <tbody>');
        $subject_count = 0;
        $subject_completed = 0;
        $get_sub_qry = "SELECT * from subjects WHERE course_id=" . $_SESSION['course_id'] . " AND semester=" . $sem;
        $get_sub_qry_run = mysqli_query($conn, $get_sub_qry);
        if ($get_sub_qry_run) {
            while ($sub = mysqli_fetch_assoc($get_sub_qry_run)) {
                echo (' <tr><td>' . $sub['sub_name'] . '</td>');
                $get_subcomp_qry = "SELECT distinct(component_id) from component_distribution where sub_id IN(SELECT sub_id FROM sub_distribution WHERE sub_code='" . $sub['sub_code'] . "') ORDER BY component_id";
                $get_subcomp_qry_run = mysqli_query($conn, $get_subcomp_qry);
                $subj_comp = array();
                $no_of_comp = 0;
                $component_count = 0;
                while ($subcomp = mysqli_fetch_assoc($get_subcomp_qry_run)) {
                    $subj_comp[] = $subcomp['component_id'];
                    $no_of_comp++;
                }
                $get_comp_qry = "SELECT component_id from component";
                $get_comp_qry_run = mysqli_query($conn, $get_comp_qry);
                if ($get_comp_qry_run) {
                    while ($comp_id = mysqli_fetch_assoc($get_comp_qry_run)) {
                        if (in_array($comp_id['component_id'], $subj_comp)) {
                            $check_auditing_qry = "SELECT check_id FROM auditing WHERE component_id=" . $comp_id['component_id'] . " AND semester=" . $sem . " AND course_id=" . $_SESSION['course_id'] . " AND from_year=" . $_SESSION['from_year'] . " AND sub_code='" . $sub['sub_code'] . "'";
                            $check_auditing_qry_run = mysqli_query($conn, $check_auditing_qry);
                            $check_id = mysqli_fetch_assoc($check_auditing_qry_run);
                            if (is_null($check_id['check_id'])) {
                                echo (' <td><i class="glyphicon glyphicon-remove" style="color: #CD331D" title="Marks for the component have not been entered!"></i></td>');
                            } else {
                                echo (' <td><i class="glyphicon glyphicon-ok" style="color:#30A21C" title="Marks for the component have been entered!"></i></td>
                                ');
                                $component_count++;
                            }
                        } else {
                            echo ('<td><i class="glyphicon glyphicon-minus-sign" title="The subject does not contain this component."></i></td>');
                        }
                    }
                    if ($no_of_comp == $component_count) {
                        $subject_completed++;
                    }
                }
                echo ('</tr>');
                $subject_count++;
            }
        }
        $prog_width = ($subject_completed / $subject_count) * 100;
        echo ('</tbody>
        <caption align="bottom">
        <div class="col-lg-12 col-sm-12 col-md-12" style="display:flex; align-items:center">
        <div class="col-lg-7 col-md-7 col-sm-6">');
        if($subject_count==$subject_completed){
            echo('<button class="btn btn-default input-lg" type="submit" name="tab_submit" value="'.$sem.'">Generate TR <i class="glyphicon glyphicon-circle-arrow-right"></i></button>');
        }
        else{
        echo('<button class="btn btn-default input-lg" disabled>Generate TR <i class="glyphicon glyphicon-circle-arrow-right"></i></button>');   
        }
        echo ('</div>
        <div class="col-sm-6 col-xs-12" style="vertical-align: middle;">
        <div class="progress">
        <div class="progress-bar progress-bar-custom" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: ' . $prog_width . '%">
        <span>' . $subject_completed . '/' . $subject_count . ' Subjects Completed</span>
        </div>
    </div></div> 
    </div>
        </caption>
    </table>
    </form>
    <hr>');

    }
}
?>
</div>

<?php
$obj = new footer();
$obj->disp_footer();
$logout_modal=new modals();
    $logout_modal->display_logout_modal();
?>
</body>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();   
});
</script>
</html>