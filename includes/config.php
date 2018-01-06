<?php
$host="sql12.freemysqlhosting.net";
$user="sql12214328";
$pass="HDf2fAXFsd";
$db="sql12214328";
$conn=mysqli_connect($host,$user,$pass,$db);
if(mysqli_connect_errno()){
    echo("Unable to connect to database! Error: ".mysqli_connect_errno());
}
?>