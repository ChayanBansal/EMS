<?php
require('config.php');
$truncate_qry="TRUNCATE table tr";
$run=mysqli_query($conn,$truncate_qry);

$truncate_qry="TRUNCATE table transactions";
$run=mysqli_query($conn,$truncate_qry);

$truncate_qry="TRUNCATE table score";
$run=mysqli_query($conn,$truncate_qry);

$truncate_qry="TRUNCATE table failure_report";
$run=mysqli_query($conn,$truncate_qry);

$truncate_qry="TRUNCATE table exam_summary";
$run=mysqli_query($conn,$truncate_qry);

$truncate_qry="TRUNCATE table auditing";
$run=mysqli_query($conn,$truncate_qry);

$truncate_qry="TRUNCATE table checking";
$run=mysqli_query($conn,$truncate_qry);
?>