<?php
//This file is made for setting session of current course
    require("config.php");
    $get_all_course = "SELECT * FROM courses";
    $get_list_run = mysqli_query($conn,$get_all_course);
    while( $result = mysqli_fetch_assoc($get_list_run) )
    {
        
        if($_POST[$result['course_id']])
        {
            session_start();
            $_SESSION['current_course_id']=$result['course_id'];
            $_SESSION['current_course_name']=$result['course_name'];
            $_SESSION['current_course_duration']=$result['duration'];
            header('location: useroptions.php');
            break;
        }
    }
?>