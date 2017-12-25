<?php
session_start();
require('config.php');
$update_operator_active_qry="UPDATE operators set operator_active=0 where operator_id=".$_SESSION['operator_id'];
$update_operator_active_qry_run=mysqli_query($conn,$update_operator_active_qry);
if($update_operator_active_qry_run){
    session_destroy();
    header('location: /ems/index.php');
    
}
?>