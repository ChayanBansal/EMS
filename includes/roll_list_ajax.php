<?php
require("config.php");
require("class_lib.php");
if(isset($_POST['operation']))
{
    switch($_POST['operation'])
    {
        case 1:    
            if(isset($_POST['course_id']))
            {
                $input_clear = new input_check();
                $course_id=$input_clear->input_safe($conn,$_POST['course_id']);
                $get_from_year="SELECT from_year FROM academic_sessions where course_id=$course_id";
                $get_from_year_run=mysqli_query($conn,$get_from_year);
                if($get_from_year_run)
                {
                    echo('<option value=""disabled selected>Select batch</option>');
                    while($from_year=mysqli_fetch_assoc($get_from_year_run))
                    {
                        echo('<option value="'.$from_year['from_year'].'">'.$from_year['from_year'].'</option>');
                    }
                }
                else
                {
                    echo('<option value=""disabled selected>No batches to show</option>');
                }
            }
            break;
        
        case 2:
            if(isset($_POST['batch']) AND isset($_POST['course']))
            {
                $input_clear = new input_check();
                $from_year=$input_clear->input_safe($conn,$_POST['batch']);
                $course_id=$input_clear->input_safe($conn,$_POST['course']);
                $get_semester="SELECT current_semester from academic_sessions WHERE course_id=$course_id AND from_year=$from_year";
                $get_semester_run=mysqli_query($conn,$get_semester);
                if($get_semester_run)
                {
                    echo('<option value=""disabled selected>Select batch</option>');
                    while($semester=mysqli_fetch_assoc($get_semester_run))
                    {
                        echo('<option value="'.$semester['current_semester'].'">'.$semester['current_semester'].'</option>');
                    }
                }
                else
                {
                    echo('<option value=""disabled selected>No semester to show</option>');
                }
            }
            break;
    }
}

mysqli_close($conn);
?>