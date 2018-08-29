<!DOCTYPE html>
<html lang="en">
<head>
<link rel='shortcut icon' href='images/favicon.ico' type='image/x-icon'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Options</title>
    <link rel="stylesheet" href="/ems/css/style.css">
    <link rel="stylesheet" href="/ems/w3css/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic" rel="stylesheet">
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
.student_card{
    font-family: 'Gentium Book Basic', serif;
}

    </style>
</head>
<body>
<?php
session_start();
if(isset($_POST['proceed_to_add_roll']))
{
    $_SESSION['current_course_id']=$_POST['roll_course'];
}
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$valid = new validate();
$valid->conf_logged_in();
require('../preloader/preload.php');
$obj = new head();
$obj->displayheader();
$obj->dispmenu(3, ["/ems/includes/home", "/ems/includes/logout", "/ems/includes/developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
$dashboard = new dashboard();
$dashboard->display($_SESSION['operator_name'], ["Sign Out"], ["change_password.php", "index.php"], "Contact Super Admin");

if(isset($_POST['proceed_to_add_roll']))
{
    $input_clear = new input_check();
    $type=$input_clear->input_safe($conn,$_POST['register_for_type']);
    $course_id=$input_clear->input_safe($conn,$_POST['roll_course']);
    $from_year=$input_clear->input_safe($conn,$_POST['roll_batch']);
    $semester=$input_clear->input_safe($conn,$_POST['roll_semester']);

    if($type==='1')
    {
        //Session in which the students are to be registered
        $get_ac_session_id="SELECT ac_session_id FROM $main.academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND current_semester=$semester";
        $get_ac_session_id_run=mysqli_query($conn,$get_ac_session_id);
        if($get_ac_session_id_run!=FALSE)
        {
            while($result=mysqli_fetch_assoc($get_ac_session_id_run))
            {
                $ac_session_id=$result['ac_session_id'];
            }
        
            $previous_semester=((int)$semester)-1;

            //session in which students are already registered (i.e, their previous session_id)
            $get_previous_ac_session_id="SELECT ac_session_id FROM $main.academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND current_semester=$previous_semester";
            $get_previous_ac_session_id_run=mysqli_query($conn,$get_previous_ac_session_id);
            if($get_previous_ac_session_id_run!=FALSE)
            {
                if(mysqli_num_rows($get_previous_ac_session_id_run)>0)
                {
                    foreach($get_previous_ac_session_id_run as $result)
                    {
                        $previous_ac_session_id=$result["ac_session_id"];
                    }
                    $get_students="SELECT `enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `address`, `gender` FROM $main.students WHERE ac_session_id=$previous_ac_session_id";
                    $get_students_run=mysqli_query($conn,$get_students);
                    if($get_students_run!=FALSE)
                    {
                        echo('<div style="display:flex; justify-content:space-around; overflow:auto; margin-bottom:100px; ">
                        
                        <table style="width:80%;align:center; background-color:#C84646; box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="table table-hover">
                        <caption>
                        Batch: '.$from_year.' | Previous Semester: '.$previous_semester.' | Registering for semester: '.$semester.'
                        <input class="form-control input-lg" id="searchbar" type="text" placeholder="Search students..">
                        </caption>
                        <thead>
                        <tr>
                            <th><center><h2><input type="checkbox" id="select_all_check" onclick="select_all();"></h2></center></th>
                            <th><center><h2 style="color:white;font-family: Gentium Book Basic, serif;">Student</h2></center></th>
                        </tr>
                        
                        </thead>
                        <form action="add_roll_backend" method="post">
                        <input type="hidden" value="1" name="type">
                        <tbody id="roll_list">');
                        
                        while($student=mysqli_fetch_assoc($get_students_run))
                        {
                            echo('
                            <tr>
                                <td style="vertical-align:middle; text-align:center; font-size:36px;"><input type="checkbox" onclick="toogle_select_all()" class="roll_check" name="enrol_no[]" value="'.$student['enrol_no'].'"></td>
                                <td><div class="student_card">
                            <div><div class="w3-card-4">

                                <header class="w3-container w3-blue">
                                <h3>'.$student['enrol_no'].'</h3>
                                </header>
                                
                                
                                
                                <footer class="w3-container w3-blue" style="display:flex; flex-wrap: wrap;align-content: space-around;">
                                <h4>
                                    <table>
                                    <tr>
                                    <td>Name:</td><td>'.$student["first_name"]);
                                    if($student["middle_name"]=="")
                                    {
                                        echo(' '.$student["last_name"]);
                                    }
                                    else
                                    {
                                        echo(' '.$student["middle_name"].' '.$student["last_name"]);
                                    }

                            echo('
                            </td>
                            <tr>
                            <td>
                            Gender:</td><td>'.$student["gender"].'
                            </td></tr>
                        
                            <tr><td>
                            Father\'s Name:</td><td>'.$student["father_name"].'
                            </td></tr>
                            <tr>
                            <td>
                            Mother\'s Name:</td><td>'.$student["mother_name"].'
                            </td></tr>
                            <tr>
                            <td>
                            Address:</td><td>'.$student["address"].'
                            </td></tr>
                            </table>
                            </h4>
                            <div class="w3-container" style="float:right">
                                <img src="../stud_img/'.$student['enrol_no']);
                                if(file_exists("../stud_img/".$student['enrol_no'].".png")){
                                    echo(".png");
                                }else{
                                    echo(".jpg");
                                }
                                echo('" alt="'.$student['enrol_no'].'">
                            </div>
                            </footer>
                            
                            </div></div></div></td></tr>');  
                        }
                        echo('
                        <tr><th colspan="2"><center><button class="btn btn-success" type="submit" name="create_roll_list" value="'.$ac_session_id.'">Register for Academic Semester</button></center></th></tr>
                        </tbody></form>
                        
                        </table></div>');
                    }
                    else
                    {
                        echo("No record to show");
                    }
                }
            }
            else
            {
                $get_course_name="SELECT course_name FROM $main.courses WHERE course_id=$course_id";
                $get_course_name_run=mysqli_query($conn,$get_course_name);
                if($get_course_name_run)
                {
                    $course_name=mysqli_fetch_assoc($get_course_name_run);
                    echo("No student found eligible to be registered in Semester $semester as per filters added. <br> Filters added are Semester (to be registerd in) : $semester | Batch : $from_year | Course : ".$course_name["course_name"]);    
                }
                else
                {
                    echo("No student found eligible to be registered in Semester $semester as per filters added. Filters added are <br> Semester (to be registerd in) : $semester | Batch : $from_year");
                }
            }
        }
        else
        {
            echo("No records to show");
        }
    }
    else if($type==='2')
    {
         //Session in which the students are to be registered
         $get_ac_session_id="SELECT ac_session_id FROM $main.academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND current_semester=$semester";
         $get_ac_session_id_run=mysqli_query($conn,$get_ac_session_id);
         if($get_ac_session_id_run!=FALSE)
         {
            while($result=mysqli_fetch_assoc($get_ac_session_id_run))
            {
                $ac_session_id=$result['ac_session_id'];
            }
            $get_students="SELECT `enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `address`, `gender` FROM $main.students WHERE ac_session_id=$ac_session_id";
            $get_students_run=mysqli_query($conn,$get_students);
            if($get_students_run!=FALSE)
            {
                echo('<div style="display:flex; justify-content:space-around; overflow:auto; margin-bottom:100px; ">
                
                <table style="width:80%;align:center; background-color:#C84646; box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="table table-hover">
                <caption>
                Batch: '.$from_year.' | Registering for Main Exam | Semester: '.$semester.'
                <input class="form-control input-lg" id="searchbar" type="text" placeholder="Search students..">
                </caption>
                <thead>
                <tr>
                    <th><center><h2><input type="checkbox" id="select_all_check" onclick="select_all();"></h2></center></th>
                    <th><center><h2 style="color:white;font-family: Gentium Book Basic, serif;">Student</h2></center></th>
                    <th><center><h2 style="color:white;font-family: Gentium Book Basic, serif;">Detained Subjects</h2></center></th>
                </tr>
                
                </thead>
                <form action="add_roll_backend" method="post">
                <input type="hidden" value="2" name="type">
                <tbody id="roll_list">');
                
                while($student=mysqli_fetch_assoc($get_students_run))
                {
                    $check_double_reg="SELECT roll_id FROM $main.roll_list WHERE enrol_no='".$student["enrol_no"]."' AND semester=$semester";
                    $check_double_reg_run=mysqli_query($conn,$check_double_reg);
                    if(mysqli_num_rows($check_double_reg_run)>0)
                    {
                        
                        if(mysqli_num_rows($check_double_reg_run)>0)
                        {
                            echo('
                            <tr class="info">
                            <td style="vertical-align:middle; text-align:center; font-size:36px;">Already Registered</td>
                            <td>
                            <div class="student_card">
                    <div><div class="w3-card-4">

                        <header class="w3-container w3-blue">
                        <h3>'.$student['enrol_no'].'</h3>
                        </header>
                        <footer class="w3-container w3-blue" style="display:flex; flex-wrap: wrap;align-content: space-around;">
                        <h4>
                        <table>
                        <tr>
                        <td>Name:</td><td>'.$student["first_name"]);
                        if($student["middle_name"]=="")
                        {
                            echo(' '.$student["last_name"]);
                        }
                        else
                        {
                            echo(' '.$student["middle_name"].' '.$student["last_name"]);
                        }

                echo('
                </td>
                <tr>
                <td>
                Gender:</td><td>'.$student["gender"].'
                </td></tr>
            
                <tr><td>
                Father\'s Name:</td><td>'.$student["father_name"].'
                </td></tr>
                <tr>
                <td>
                Mother\'s Name:</td><td>'.$student["mother_name"].'
                </td></tr>
                <tr>
                <td>
                Address:</td><td>'.$student["address"].'
                </td></tr>
                </table>
                </h4>
                <div class="w3-container" style="float:right">
                    <img src="../stud_img/'.$student['enrol_no']);
                    if(file_exists("../stud_img/".$student['enrol_no'].".png")){
                        echo(".png");
                    }else{
                        echo(".jpg");
                    }
                    echo('" alt="'.$student['enrol_no'].'">
                </div>
                </footer>
                
                </div></div></div></td><td>');
                $get_roll_id="SELECT roll_id FROM $main.roll_list WHERE enrol_no='".$student['enrol_no']."' AND semester=$semester";
                $get_roll_id_run=mysqli_query($conn,$get_roll_id);
                if(mysqli_num_rows($get_roll_id_run)>0)
                {
                    $result=mysqli_fetch_assoc($get_roll_id_run);
                    $get_detained_subject="SELECT detained_sub_id FROM $main.detained_subject WHERE roll_id=".$result['roll_id'];
                    $get_detained_subject_run=mysqli_query($conn,$get_detained_subject);
                    if(mysqli_num_rows($get_detained_subject_run)>0)
                    {
                        foreach($get_detained_subject_run as $det_sub_id)
                        {
                            $get_sub_name="SELECT s.sub_name, s.sub_code, sd.practical_flag FROM $main.subjects s, $main.sub_distribution sd WHERE sd.sub_id=".$det_sub_id['detained_sub_id']." AND s.ac_sub_code=sd.ac_sub_code";
                            $get_sub_name_run=mysqli_query($conn,$get_sub_name);
                            if($get_sub_name_run)
                            {
                                echo("<ul>");
                                foreach($get_sub_name_run as $list_det_sub)
                                {
                                    echo("<li> [".$list_det_sub["sub_name"]."] ".$list_det_sub["sub_name"]);
                                    if($list_det_sub["practical_flag"]==='1')
                                    {
                                        echo(" [PRACTICAL]</li>");    
                                    }
                                    else if($list_det_sub["practical_flag"]==='0')
                                    {
                                        echo(" [THEORY] </li>");
                                    }
                                    else if($list_det_sub["practical_flag"]==='2')
                                    {
                                        echo(" [IE] </li>");
                                    }
                                    
                                }
                                echo("</ul>");
                            }
                        }
                    }
                }
                
                echo('</td></tr>');
                            continue;
                        }
                    }
                    
                    else
                    {
                        echo('
                    <tr>
                        <td style="vertical-align:middle; text-align:center; font-size:36px;"><input type="checkbox" onclick="toogle_select_all()" class="roll_check" name="enrol_no[]" value="'.$student['enrol_no'].'"></td>
                        <td><div class="student_card">
                    <div><div class="w3-card-4">

                        <header class="w3-container w3-blue">
                        <h3>'.$student['enrol_no'].'</h3>
                        </header>
                        <footer class="w3-container w3-blue" style="display:flex; flex-wrap: wrap;align-content: space-around;">
                        <h4>
                            <table>
                            <tr>
                            <td>Name:</td><td>'.$student["first_name"]);
                            if($student["middle_name"]=="")
                            {
                                echo(' '.$student["last_name"]);
                            }
                            else
                            {
                                echo(' '.$student["middle_name"].' '.$student["last_name"]);
                            }

                    echo('
                    </td>
                    <tr>
                    <td>
                    Gender:</td><td>'.$student["gender"].'
                    </td></tr>
                
                    <tr><td>
                    Father\'s Name:</td><td>'.$student["father_name"].'
                    </td></tr>
                    <tr>
                    <td>
                    Mother\'s Name:</td><td>'.$student["mother_name"].'
                    </td></tr>
                    <tr>
                    <td>
                    Address:</td><td>'.$student["address"].'
                    </td></tr>
                    </table>
                    </h4>
                    <div class="w3-container" style="float:right">
                        <img src="../stud_img/'.$student['enrol_no']);
                        if(file_exists("../stud_img/".$student['enrol_no'].".png")){
                            echo(".png");
                        }else{
                            echo(".jpg");
                        }
                        echo('" alt="'.$student['enrol_no'].'">
                    </div>
                    </footer>
                    
                    </div></div></div></td>');
                    echo('<td>');
                    $get_subjects="SELECT s.ac_sub_code, s.sub_code, s.sub_name, s.elective_flag, sd.sub_id, sd.practical_flag FROM $main.subjects s, $main.sub_distribution sd WHERE s.ac_session_id=$ac_session_id AND s.ac_sub_code=sd.ac_sub_code";
                    $get_subjects_run=mysqli_query($conn,$get_subjects);
                    if(mysqli_num_rows($get_subjects_run)>0)
                    {
                        foreach($get_subjects_run as $subject)
                        {
                            if($subject["elective_flag"]==='0')
                            {
                                echo("<input type='checkbox' value='".$subject["sub_id"]."' name='".$student["enrol_no"]."[]'> ");
                                if($subject["practical_flag"]==='1')
                                {
                                    echo("[".$subject["sub_code"]."]".$subject["sub_name"]." [Practical] <br>");
                                }
                                else if($subject["practical_flag"]==='0')
                                {
                                    echo("[".$subject["sub_code"]."]".$subject["sub_name"]." [THEORY] <br>");
                                }
                                else if($subject["practical_flag"]==='2')
                                {
                                    echo("[".$subject["sub_code"]."]".$subject["sub_name"]." [IE] <br>");
                                }
                            }
                            else if($subject["elective_flag"]==='1')
                            {
                                $get_elective_subject="SELECT COUNT(*) FROM $main.elective_map WHERE enrol_no='".$student["enrol_no"]."' AND ac_sub_code=".$subject["ac_sub_code"];
                                $get_elective_subject_run=mysqli_query($conn,$get_elective_subject);
                                if($get_elective_subject_run)
                                {
                                    $elective_count=mysqli_fetch_assoc($get_elective_subject_run);
                                    if($elective_count['count']===1)
                                    {
                                        echo("<input type='checkbox' value='".$subject["sub_id"]."' name='".$student["enrol_no"]."[]'> ");
                                        if($subject["practical_flag"]==='1')
                                        {
                                            echo("[".$subject["sub_code"]."]".$subject["sub_name"]." [Practical] <br>");
                                        }
                                        else if($subject["practical_flag"]==='0')
                                        {
                                            echo("[".$subject["sub_code"]."]".$subject["sub_name"]." [THEORY] <br>");
                                        }
                                        else if($subject["practical_flag"]==='2')
                                        {
                                            echo("[".$subject["sub_code"]."]".$subject["sub_name"]." [IE] <br>");
                                        }
                                    }
                                    
                                }
                            }
                            else
                            {
                                echo("Discrepency in the database");
                            }
                        }    
                    }                    
                    echo('</td></tr>');  
                }
                }
                echo('
                <tr><th colspan="3"><center><button class="btn btn-success" type="submit" name="create_roll_list" value="'.$ac_session_id.'">Register for Main Examination</button></center></th></tr>
                </tbody></form>
                
                </table></div>');
            }
            else
            {
                echo("No record to show");
            }
        }
    }
    else if($type==='5')
    {
         //Session in which the students are to be registered
         $get_atkt_session_id="SELECT ac_session_id, atkt_session_id FROM ems.atkt_sessions WHERE ac_session_id =(SELECT ac_session_id FROM $main.academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND current_semester=$semester)";
         $get_atkt_session_id_run=mysqli_query($conn,$get_atkt_session_id);
         if($get_atkt_session_id_run!=FALSE)
         {
            while($result=mysqli_fetch_assoc($get_atkt_session_id_run))
            {
                $ac_session_id=$result['ac_session_id'];
                $atkt_session_id=$result['atkt_session_id'];
            }
            $get_students="SELECT s.enrol_no, s.first_name, s.middle_name, s.last_name, s.father_name, s.mother_name, s.address, s.gender, r.atkt_reg_flag, r.roll_id FROM $main.students s, $main.roll_list r  WHERE s.ac_session_id=$ac_session_id AND s.enrol_no=r.enrol_no AND s.enrol_no IN(SELECT enrol_no FROM $main.roll_list WHERE semester =$semester AND atkt_flag=1)";
            $get_students_run=mysqli_query($conn,$get_students);
            if($get_students_run!=FALSE)
            {
                echo('<div style="display:flex; justify-content:space-around; overflow:auto; margin-bottom:100px; ">
                
                <table style="width:80%;align:center; background-color:#C84646; box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="table table-hover">
                <caption>
                Batch: '.$from_year.' | Registering for ATKT Exam | Semester: '.$semester.'
                <input class="form-control input-lg" id="searchbar" type="text" placeholder="Search students..">
                </caption>
                <thead>
                <tr>
                    <th><center><h2><input type="checkbox" id="select_all_check" onclick="select_all();"></h2></center></th>
                    <th><center><h2 style="color:white;font-family: Gentium Book Basic, serif;">Student</h2></center></th>
                    <th><center><h2 style="color:white;font-family: Gentium Book Basic, serif;">ATKT Subjects</h2></center></th>
                </tr>
                
                </thead>
                <form action="add_roll_backend" method="post">
                <input type="hidden" value="5" name="type">
                <tbody id="roll_list">');
                
                while($student=mysqli_fetch_assoc($get_students_run))
                {
                    
                    if($student['atkt_reg_flag']===1)
                    {
                        
                            echo('
                            <tr class="info">
                            <td style="vertical-align:middle; text-align:center; font-size:36px;">Already Registered</td>
                            <td>
                            <div class="student_card">
                    <div><div class="w3-card-4">

                        <header class="w3-container w3-blue">
                        <h3>'.$student['enrol_no'].'</h3>
                        </header>
                        <footer class="w3-container w3-blue" style="display:flex; flex-wrap: wrap;align-content: space-around;">
                        <h4>
                        <table>
                        <tr>
                        <td>Name:</td><td>'.$student["first_name"]);
                        if($student["middle_name"]=="")
                        {
                            echo(' '.$student["last_name"]);
                        }
                        else
                        {
                            echo(' '.$student["middle_name"].' '.$student["last_name"]);
                        }

                echo('
                </td>
                <tr>
                <td>
                Gender:</td><td>'.$student["gender"].'
                </td></tr>
            
                <tr><td>
                Father\'s Name:</td><td>'.$student["father_name"].'
                </td></tr>
                <tr>
                <td>
                Mother\'s Name:</td><td>'.$student["mother_name"].'
                </td></tr>
                <tr>
                <td>
                Address:</td><td>'.$student["address"].'
                </td></tr>
                </table>
                </h4>
                <div class="w3-container" style="float:right">
                    <img src="../stud_img/'.$student['enrol_no']);
                    if(file_exists("../stud_img/".$student['enrol_no'].".png")){
                        echo(".png");
                    }else{
                        echo(".jpg");
                    }
                    echo('" alt="'.$student['enrol_no'].'">
                </div>
                </footer>
                
                </div></div></div></td><td>');
                $get_atkt_roll_id="SELECT atkt_roll_id FROM ems.atkt_roll_list WHERE roll_id=".$student['roll_id']."' AND atkt_session_id=$atkt_session_id";
                $get_atkt_roll_id_run=mysqli_query($conn,$get_atkt_roll_id);
                if(mysqli_num_rows($get_atkt_roll_id_run)>0)
                {
                    $result=mysqli_fetch_assoc($get_atkt_roll_id_run);
                    $get_atkt_subject="SELECT sd.sub_id,sd.practical_flag, s.sub_code, s.sub_name FROM $main.subjects s, $main.sub_distribution WHERE sd.sub_id IN (SELECT sub_id FROM ems.atkt_subjects WHERE atkt_roll_id=".$result["atkt_roll_id"].")";
                    $get_atkt_subject_run=mysqli_query($conn,$get_detained_subject);
                    if($get_atkt_subject_run)
                    {
                        echo("<ol>");
                        foreach($get_atkt_subject_run as $atkt_sub_id)
                        {
                            echo("<li>".$atkt_sub_id["subcode"]." ");
                            if($atkt_sub_id["practical_flag"]===1)
                            {
                                echo("[PRACTICAL] </li>");
                            }
                            else if($atkt_sub_id["practical_flag"]===0)
                            {
                                echo("[THEORY] </li>");
                            }
                            else if($atkt_sub_id["practical_flag"]===2)
                            {
                                echo("[IE] </li>");
                            }
                        }
                        echo("</ol>");
                    }
                }
                
                echo('</td></tr>');
                            continue;
                        
                    }
                    
                    else
                    {
                        echo('
                    <tr>
                        <td style="vertical-align:middle; text-align:center; font-size:36px;"><input type="checkbox" onclick="toogle_select_all()" class="roll_check" name="enrol_no[]" value="'.$student['enrol_no'].'"></td>
                        <td><div class="student_card">
                    <div><div class="w3-card-4">

                        <header class="w3-container w3-blue">
                        <h3>'.$student['enrol_no'].'</h3>
                        </header>
                        <footer class="w3-container w3-blue" style="display:flex; flex-wrap: wrap;align-content: space-around;">
                        <h4>
                            <table>
                            <tr>
                            <td>Name:</td><td>'.$student["first_name"]);
                            if($student["middle_name"]=="")
                            {
                                echo(' '.$student["last_name"]);
                            }
                            else
                            {
                                echo(' '.$student["middle_name"].' '.$student["last_name"]);
                            }

                    echo('
                    </td>
                    <tr>
                    <td>
                    Gender:</td><td>'.$student["gender"].'
                    </td></tr>
                
                    <tr><td>
                    Father\'s Name:</td><td>'.$student["father_name"].'
                    </td></tr>
                    <tr>
                    <td>
                    Mother\'s Name:</td><td>'.$student["mother_name"].'
                    </td></tr>
                    <tr>
                    <td>
                    Address:</td><td>'.$student["address"].'
                    </td></tr>
                    </table>
                    </h4>
                    <div class="w3-container" style="float:right">
                        <img src="../stud_img/'.$student['enrol_no']);
                        if(file_exists("../stud_img/".$student['enrol_no'].".png")){
                            echo(".png");
                        }else{
                            echo(".jpg");
                        }
                        echo('" alt="'.$student['enrol_no'].'">
                    </div>
                    </footer>
                    
                    </div></div></div></td>');
                    echo('<td>');
                    $get_subjects="SELECT s.ac_sub_code, s.sub_code, s.sub_name, s.elective_flag, sd.sub_id, sd.practical_flag FROM $main.subjects s, $main.sub_distribution sd WHERE s.ac_session_id=$ac_session_id AND s.ac_sub_code=sd.ac_sub_code AND sd.sub_id IN
                                    (SELECT sub_id FROM $main.failure_report WHERE roll_id=".$student["roll_id"].")";
                    $get_subjects_run=mysqli_query($conn,$get_subjects);
                    if(mysqli_num_rows($get_subjects_run)>0)
                    {
                        foreach($get_subjects_run as $subject)
                        {
                            echo("<input type='checkbox' value='".$subject["sub_id"]."' name='".$student["enrol_no"]."[]'");
                        }    
                    }                    
                    echo('</td></tr>');  
                }
                }
                echo('
                <tr><th colspan="3"><center><button class="btn btn-success" type="submit" name="create_roll_list" value="'.$atkt_session_id.'">Register for ATKT Examination</button></center></th></tr>
                </tbody></form>
                
                </table></div>');
            }
            else
            {
                echo("No record to show");
            }
        }
    }
}

$obj = new footer();
$obj->disp_footer();
$logout_modal = new modals();
$logout_modal->display_logout_modal();
?>
<script>
function select_all()
{
    if(document.getElementById("select_all_check").checked)
    {
        $(".roll_check").prop('checked', true);
    }
}
function toogle_select_all()
{
    var all_checks = document.getElementsByClassName("roll_check");
    if(document.getElementsByClassName("roll_check").checked==false)
    {
        $("#select_all_check").prop('checked', false);
    }
}
$(document).ready(function(){
  $("#searchbar").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#roll_list tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>
</body>
</html>