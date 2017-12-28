
<?php
require("config.php");
$insert_qry="INSERT into course_level VALUES(3,'Test')";
$insert_qry_run=mysqli_query($conn,$insert_qry);
if($insert_qry_run){
    echo("Success");
}
?>