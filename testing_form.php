<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
   
	 <link rel="stylesheet" href="style.css">
<?php
require("class_lib.php");
require("frontend_lib.php");
$obj=new head();
$obj->displayheader();
$dash=new dashboard();
$dash->display();
?>