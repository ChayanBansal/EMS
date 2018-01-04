<?php
$host="sql12.freemysqlhosting.net";
$user="sql12213993";
$pass="iqpTsClsCq";
$db="sql12213993";
$conn=mysqli_connect($host,$user,$pass,$db);
if(mysqli_connect_errno()){
    echo("Unable to connect to database! Error: ".mysqli_connect_errno());
}
?>