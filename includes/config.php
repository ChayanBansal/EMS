<?php
$host="localhost";
$user="root";
$pass="";
$db="ems";
$conn=mysqli_connect($host,$user,$pass,$db);
if(mysqli_connect_errno()){
    die("Unable to connect to database! Error: ".mysqli_connect_errno());

}
?>