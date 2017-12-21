<?php

session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$student_disp=new students();
$student_disp->gotofeed($conn);
$student_disp->disp_tr($conn);
?>