<?php
$host="localhost"; //"sql12.freemysqlhosting.net";
$user="root"; //"sql12215234";
$pass="";//"DEFYiHZ4uc";
$db="ems";//"sql12215234";
$conn=mysqli_connect($host,$user,$pass,$db);
if(mysqli_connect_errno()){
    die("Unable to connect to database! Error: ".mysqli_connect_errno());
}
$browser=$_SERVER['HTTP_USER_AGENT'];
if(!(similar_text($browser,"Chrome")>=6)){
    echo("Browser does not support this application!");
    die();
}

/*
Database Variable declarations
*/
$main="ems";
$retotal="ems";
$reval="ems";
$atkt="ems";
?>