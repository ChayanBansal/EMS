<?php
$host="192.168.104.78";
$user="end_user";
$pass="end_user@ems";
$db="ems";
$conn=mysqli_connect($host,$user,$pass,$db);
if(mysqli_connect_errno()){
    die("Unable to connect to database! Error: ".mysqli_connect_errno());
}
$browser=$_SERVER['HTTP_USER_AGENT'];
if(!(similar_text($browser,"Chrome")>=6)){
    echo("Browser does not support this application!");
    die();
}
?>