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
    else if($_POST['type']==='5')
    {
        $input_clear = new input_check();
        $atkt_session_id = $input_clear->input_safe($conn,$_POST['create_roll_list']);
        $enrol_no = $_POST['enrol_no'];
        $total=count($enrol_no);
        $get_semester="SELECT current_semester FROM $main.academic_sessions WHERE ac_session_id=(SELECT ac_session_id FROM ems_atkt.atkt_sessions WHERE atkt_session_id=$atkt_session_id)";
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
                $get_atkt_roll_id="SELECT atkt_roll_id, roll_id FROM atkt_roll_list WHERE roll_id IN (SELECT roll_id FROM $main.roll_list WHERE semester=$semester AND enrol_no IN (".implode("','",$enrol_number)."))"; 
                $get_atkt_roll_id_run=mysqli_query($conn,$get_atkt_roll_id);
                if($get_atkt_roll_id_run!=FALSE)
                {
                    foreach($get_atkt_roll_id_run as $atkt_roll)
                    {
                        $get_fail_subject="SELECT subj";
                    }
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
    else if($_POST['type']==='2') //atkt backend is not done
    {
        $input_clear = new input_check();
        $ac_session_id = $input_clear->input_safe($conn,$_POST['create_roll_list']);
        $enrol_no = $_POST['enrol_no'];
        $total=count($enrol_no);
        $get_semester="SELECT current_semester FROM $main.academic_sessions WHERE ac_session_id=$ac_session_id";
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
                $insert_into_roll_list="INSERT INTO $main.roll_list(enrol_no, semester) VALUES('".$enrol_number."', $semester)";
                $insert_into_roll_list_run=mysqli_query($conn,$insert_into_roll_list);
                //echo($insert_into_roll_list);
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
                            $insert_into_detained_subject="INSERT INTO detained_subject(roll_id, detained_sub_id) VALUES($roll_id, $det_sub)";
                            $insert_into_detained_subject_run=mysqli_query($conn,$insert_into_detained_subject);
                            echo($insert_into_detained_subject."<br>");
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
    else if($_POST['type']===4)
    {}
    else if($_POST['type']===5)
    {}
}




    mysqli_close($conn);
    header('location: home.php');

?>