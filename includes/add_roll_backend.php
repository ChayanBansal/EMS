<?php
session_start();
require('config.php');
require('class_lib.php');
if(isset($_POST['create_roll_list']))
{
    $test = new alert();
    $test->exec("Inside","success");
    $input_clear = new input_check();
    $semester = $input_clear->input_safe($conn,$_POST['create_roll_list']);
    $enrol_no = $_POST['enrol_no'];
    $total=count($enrol_no);
    $temp=0;
    for($i=0; $i<$total ; $i++)
    {
        mysqli_autocommit($conn,FALSE);
        mysqli_begin_transaction($conn);
        $enrol_number=$input_clear->input_safe($conn,$enrol_no[$i]);
        $add_roll="INSERT INTO roll_list(enrol_no,semester) VALUES('".$enrol_number."',$semester)";
        $add_roll_run=mysqli_query($conn,$add_roll);
        if($add_roll_run)
        {
            $temp++;
        }
    }
    if($temp==$total)
    {
        mysqli_commit($conn);
        $_SESSION['roll_list_added']=1;
    }
    else
    {
        $_SESSION['roll_list_added']=0;
    }
    mysqli_close($conn);
    header('location: home.php');
}
?>