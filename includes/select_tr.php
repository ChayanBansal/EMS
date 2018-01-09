<?php
    require('config.php');
    if($_POST['tr_getFromYear']==1 AND isset($_POST['course_id']))
    {
        $get_from_year="SELECT DISTINCT(from_year) FROM students WHERE course_id=".$_POST['course_id']." AND enrol_no IN 
                        (SELECT enrol_no FROM roll_list WHERE roll_id IN
                        (SELECT DISTINCT(roll_id) FROM tr))";
        $get_from_year_run=mysqli_query($conn,$get_from_year);
        echo('<option value="" disabled selected>Select Batch</option>');
        while($from_year=mysqli_fetch_assoc($get_from_year_run))
        {
            echo('<option value="'.$from_year['from_year'].'">'.$from_year['from_year'].'</option>');
        }
    }
    //tr_getSemester=1&course_id='+tr_course_id+'&from_year='+tr_from_year+'&type='+tr_type
    if($_POST['tr_getSemester']==1 AND isset($_POST['course_id']) AND isset($_POST['from_year']) AND isset($_POST['type']))
    {
        $get_semester="SELECT DISTINCT(semester) FROM roll_list WHERE enrol_no IN (SELECT enrol_no FROM students WHERE course_id=".$_POST['course_id']." AND from_year=".$_POST['from_year'].")";
        $get_semester_run=mysqli_query($conn,$get_semester);
        while($semester=mysqli_fetch_assoc($get_semester_run))
        {
            echo('<option value="'.$semester['semester'].'">'.$semester['semester'].'</option>');
        }
    }
    mysqli_close($conn);
?>