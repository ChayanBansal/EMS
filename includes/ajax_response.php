<?php
// getting semester 
session_start();
require('config.php');
require('class_lib.php');
/*if($_POST['from_year'])
{
    $from_year=$_POST['from_year'];
    $get_semester="SELECT current_semester FROM academic_sessions WHERE from_year=".$from_year." AND course_id=".$_SESSION['current_course_id'];
    $get_semester_run=mysqli_query($conn,$get_semester);
    $result=mysqli_fetch_assoc($get_semester_run);
    $_SESSION['selected_semester']=$result['current_semester'];
    $temp=$result['current_semester'];
    echo('<option name="selected_semester" value="'.$temp.'">'.$temp.'</option>');
}
else{
    echo('<option name="selected_semester" value="">NHP</option>');
}*/
if($_POST['getType']==1)
{
    if($_POST['from_year'])
    {
        $from_year=$_POST['from_year'];
        $get_semester="SELECT current_semester FROM academic_sessions WHERE from_year=".$from_year." AND course_id=".$_SESSION['current_course_id'];
        $get_semester_run=mysqli_query($conn,$get_semester);
        $result=mysqli_fetch_assoc($get_semester_run);
        if($result['current_semester']==1)
        {
            echo('<label for="main_atkt">Type : </label>');
            echo('<label><input type="radio" name="main_atkt" value="main" onClick="getSemester(this.value)">Main</label>');
        }
        else
        {
            echo('<label for="main_atkt">Type : </label>');
            echo('<label><input type="radio" name="main_atkt" value="main" onClick="getSemester(this.value)">Main</label>');
            echo('<label><input type="radio" name="main_atkt" value="atkt" onClick="getSemester(this.value)">ATKT</label>');
        }
    }

}
if($_POST['getSemester']==1)
{
    if($_POST['from_year'] AND $_POST['main_atkt'])
    {
        $from_year=$_POST['from_year'];
        $examType=$_POST['main_atkt'];
        if($examType=='main')
        {
            $get_semester="SELECT current_semester FROM academic_sessions WHERE from_year=".$from_year." AND course_id=".$_SESSION['current_course_id'];
            $get_semester_run=mysqli_query($conn,$get_semester);
            $result=mysqli_fetch_assoc($get_semester_run);
            $_SESSION['selected_semester']=$result['current_semester'];
            $temp=$result['current_semester'];
            echo('<option name="selected_semester" value="'.$temp.'">'.$temp.'</option>');
        }
        else if($examType=='atkt')
        {
            $get_atkt_sem="SELECT DISTINCT(semester) FROM atkt_list WHERE enrol_no IN(SELECT enrol_no FROM students WHERE course_id=".$_SESSION['current_course_id']." AND from_year=".$from_year.")";
            $get_atkt_run=mysqli_query($conn,$get_atkt_sem);
            while($atkt_sem=mysqli_fetch_assoc($get_atkt_run))
            {
                echo('<option name="selected_semester" value="'.$atkt_sem['semester'].'">'.$atkt_sem['semester'].'</option>');
            }
        }
    }
}
?>