<?php
$host="sql12.freemysqlhosting.net";
$user="sql12215234";
$pass="DEFYiHZ4uc";
$db="sql12215234";
$conn=mysqli_connect($host,$user,$pass,$db);
if(mysqli_connect_errno()){
    echo("Unable to connect to database! Error: ".mysqli_connect_errno());
}
?>