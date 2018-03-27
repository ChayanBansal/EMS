<?php
session_start();
require('config.php');
require('class_lib.php');
if(isset($_POST['create_roll_list']))
{
    if($_POST["type"]==1)
    {
        $test = new alert();
        $test->exec("Inside","success");
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
        print("Temp: ".$temp);
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
    else if($_POST['type']===2)
    {}
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