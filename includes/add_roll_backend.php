<?php
session_start();
require('config.php');
require('class_lib.php');
if(isset($_POST['create_roll_list']))
{
    if($_POST["type"]=='1')
    {
        $input_clear = new input_check();
        $ac_session_id = $input_clear->input_safe($conn,$_POST['create_roll_list']);
        $enrol_no = $_POST['enrol_no'];
        $total=count($enrol_no);

        $temp=0;
        for($i=0; $i<$total ; $i++)
        {
            mysqli_autocommit($conn,FALSE);
            mysqli_begin_transaction($conn);
            $enrol_number=$input_clear->input_safe($conn,$enrol_no[$i]);
            print($enrol_number);
            $update_ac_session="UPDATE students SET `ac_session_id`=$ac_session_id WHERE enrol_no='".$enrol_number."'";
            $update_ac_session_run=mysqli_query($conn,$update_ac_session);
            if($update_ac_session_run!=FALSE)
            {
                $temp++;
            }
        }
        if($temp==$total)
        {
            mysqli_commit($conn);
            mysqli_autocommit($conn,TRUE);
            $_SESSION['academic_semester_registration']=1;
        }
        else
        {
            mysqli_rollback($conn);
            mysqli_autocommit($conn,TRUE);
            $_SESSION['academic_semester_registration']=0;
        }
    }
    else if($_POST['type']==='2')
    {
        $input_clear = new input_check();
        $ac_session_id = $input_clear->input_safe($conn,$_POST['create_roll_list']);
        $enrol_no = $_POST['enrol_no'];
        $total=count($enrol_no);
        $get_semester="SELECT current_semester FROM ems.academic_sessions WHERE ac_session_id=$ac_session_id";
        $get_semester_run=mysqli_query($conn,$get_semester);
        if($get_semester_run)
        {
            $result=mysqli_fetch_assoc($get_semester_run);
            $semester=$result["current_semester"];
        
            $temp=0;
            for($i=0; $i<$total ; $i++)
            {
                mysqli_autocommit($conn,FALSE);
                mysqli_begin_transaction($conn);
                $enrol_number=$input_clear->input_safe($conn,$enrol_no[$i]);
                $insert_into_roll_list="INSERT INTO ems.roll_list(enrol_no, semester) VALUES('".$enrol_number."', $semester)";
                $insert_into_roll_list_run=mysqli_query($conn,$insert_into_roll_list);
                if($insert_into_roll_list_run!=FALSE)
                {
                    
                    $roll_id=mysqli_insert_id($conn);
                    if(isset($_POST[$enrol_number]))
                    {
                        $detained_subjects=$_POST[$enrol_number];
                        $total_detained=count($detained_subjects);
                        $temp_det=0;
                        foreach($detained_subjects as $det_sub)
                        {
                            $insert_into_detained_subject="INSERT INTO detained_subject(roll_id, sub_id) VALUES($roll_id, $det_sub)";
                            $insert_into_detained_subject_run=mysqli_query($conn,$insert_into_detained_subject);
                            if($insert_into_detained_subject_run)
                            {
                                $temp_det++;
                            }
                        }
                        if($temp_det!=$total_detained)
                        {
                            break;
                        }
                    }
                    $temp++;
                }
            }
            
            if($temp===$total)
            {
                mysqli_commit($conn);
                mysqli_autocommit($conn,TRUE);
                $_SESSION['main_exam_registration']=1;
            }
            else
            {
                mysqli_rollback($conn);
                mysqli_autocommit($conn,TRUE);
                $_SESSION['main_exam_registration']=0;
            }
        }
        else
        {
            echo("Not able to handle your request");
        }
    }
    else if($_POST['type']===3)
    {}
    else if($_POST['type']===4)
    {}
    else if($_POST['type']===5)
    {}
}




    mysqli_close($conn);
    header('location: home.php');

?>