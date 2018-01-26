<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Options</title>
    <link rel="stylesheet" href="/ems/css/style.css">
    <link rel="stylesheet" href="/ems/w3css/w3.css">
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

    .main-container{
        animation: fadein 500ms ease-in-out 1;
        opacity: 0;
        animation-fill-mode: forwards;
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;
        margin-bottom: 100px;
    }
    .modal-container{
        width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    }
    .option{
        padding: 20px;
        padding-right: 40px;
        padding-left: 40px;
        margin: 20px;
        display: flex;
        flex-wrap: wrap;
        color: white;
        font-size: 2rem;
        flex-direction: column;
        align-items: center;
        font-family: 'PT Sans', sans-serif;
        width: 100%;
    }
    .sub-option{
        margin-top: 5px;
        display: none;
        width: 100%;
        background: orangered;
        color: white;
        border: 1px solid white;
        transition: all 300ms;
    }
    .sub-option button{
        padding: 5px;
        border: none;
        background: orangered;
    }
    .sub-option button:hover{
        background: white;
        color: orangered;
    }
    .sub-container{
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    @keyframes fadein{
        0%{
            opacity: 0;
        }
        100%{
            opacity: 1;
        }
    }
    input[type="checkbox"]{
        zoom: 0.8;
      }
      .disabled:hover{
          cursor: not-allowed;
      }
    form label{
        font-size: 1.6rem !important;
        font-weight: 500 !important;
    }
    table{
        font-size: 1.6rem !important;
    }
    input{
        font-size: 1.6rem !important;
    }
    select{
        font-size: 1.6rem !important;
    }
    table caption{
        text-align: center;
        margin: 5px;
    }
    caption select{
        margin: 5px;
    }
    #check_list{
        text-align: center;
    }
    th{
        text-align: center;
    }
    #accordion2{
        display: block;
        padding: 20px;
        background-color: #f1f1f1;
        height: 100%;
        margin-bottom: 70px;
      }
      .chat_box{
        height:250px;
        overflow:auto;
      }
      input[type="checkbox"]{
  width: 30px; 
  height: 30px;
  cursor: pointer;
}

    </style>
</head>
<body>
<?php
session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
require('../preloader/preload.php');
$valid = new validate();
$valid->conf_logged_in();
$obj = new head();
$obj->displayheader();
$obj->dispmenu(3, ["/ems/includes/home", "/ems/includes/logout", "/ems/includes/developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
$dashboard = new dashboard();
$dashboard->display($_SESSION['operator_name'], ["Sign Out"], ["change_password.php", "index.php"], "Contact Super Admin");

if(isset($_POST['proceed_to_add_roll']))
{
    $input_clear = new input_check();
    $course_id=$input_clear->input_safe($conn,$_POST['roll_course']);
    $from_year=$input_clear->input_safe($conn,$_POST['roll_batch']);
    $semester=$input_clear->input_safe($conn,$_POST['roll_semester']);
    $get_students="SELECT `enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `address`, `gender`, `current_sem` FROM students WHERE course_id=$course_id AND from_year=$from_year AND current_sem=$semester";
    $get_students_run=mysqli_query($conn,$get_students);
    if($get_students_run)
    {
        echo('<div style="display:flex; justify-content:space-around; ">
        
        <table style="width:60%;align:center; background-color:#FF7052; box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="table table-hover">
        <tcaption>');
        $get_course_name="SELECT course_name FROM courses WHERE course_id=$course_id";
        $get_course_name_run=mysqli_query($conn,$get_course_name);
        $course_name=mysqli_fetch_assoc($get_course_name_run);

        echo($course_name["course_name"].' </tcaption>
        <thead>
          <tr>
            <th><center><h2>Select</h2></center></th>
            <th><center><h2>Student</h2></center></th>
          </tr>
          
        </thead>
        <tbody>');
        
        while($student=mysqli_fetch_assoc($get_students_run))
        {
          echo('
          <tr>
            <td style="vertical-align:middle; text-align:center; font-size:36px;"><input type="checkbox" name="enrol_no" value="'.$student['enrol_no'].'"</td>
            <td>
          <div><div class="w3-card-4">

            <header class="w3-container w3-blue">
            <h3>'.$student['enrol_no'].'</h3>
            </header>
            
            
            
            <footer class="w3-container w3-blue" style="display:flex; flex-wrap: wrap;align-content: space-around;">
            <h4>
                Name: '.$student["first_name"]);
                if($student["middle_name"]=="")
                {
                    echo(' '.$student["last_name"]);
                }
                else
                {
                    echo(' '.$student["middle_name"].' '.$student["last_name"]);
                }

            echo('
            <br>
            Gender: '.$student["gender"].'
            <br>
            Current Semester: '.$student["current_sem"].'
            <br>
            Father\'s Name: '.$student["father_name"].'
            <br>
            Mother\'s Name: '.$student["mother_name"].'
            <br>
            Address: '.$student["address"].'
            </h4>
            <div class="w3-container" style="float:right">
                <img src="../stud_img/'.$student['enrol_no'].'.jpg" alt="'.$student['enrol_no'].'">
            </div>
            </footer>
            
            </div></div></td></tr>');  
        }
        echo('</tbody>
        </table></div>');
    }
    else
    {
        echo("No record to show");
    }
    
}

$obj = new footer();
$obj->disp_footer();
$logout_modal = new modals();
$logout_modal->display_logout_modal();
?>