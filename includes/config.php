<?php
$host="sql2.freemysqlhosting.net";
$user="sql2211945";
$pass="wL4%aP2!";
$db="sql2211945";
$conn=mysqli_connect($host,$user,$pass,$db);
if(mysqli_connect_errno()){
    echo("Unable to connect to database! Error: ".mysqli_connect_errno());
}
?>