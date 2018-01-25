<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Super Admin Login - Examination Portal</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    //session_start();
    //session_destroy();
    session_start();
    require_once("includes/config.php");
    require("includes/frontend_lib.php");
    require("includes/class_lib.php");
    $obj=new head();
    $obj->displayheader();
    $obj->dispmenu(3,["/ems/includes/home","/ems/index","/ems/includes/developers"],["glyphicon glyphicon-home","glyphicon glyphicon-log-in","glyphicon glyphicon-info-sign"],["Home","Log In as Operator","About Us"]);
    $user_name = new input_field();
    $password = new input_field();
    $submit = new input_button();
    ?>
<form action='' method='post' onsubmit="return disable_on_submitinput()">
    <div class="form-container">
		<div class="main">
			 <div class="login">
				 <div class="titleform">
						Super Admin 
				 </div>
				 <div class="field" id="f1"> <span class="glyphicon glyphicon-user"></span>
                 <?php
                 $user_name->display_w_js("username","","text","username","Username","1","change()","change2()");
                 ?>
				 </div>
				 <div class="field" id="f2"><span class="glyphicon glyphicon-lock"></span>
                 <?php
                 $password->display_w_js("","","password","password","Password","1","change3()","change4()");
                 ?>
                 </div>
				 <div class="field">
                 <?php
                 $submit->display("","","submit","superlogin","openover()","Sign In");
                 ?>
                 </div>
			 </div>
			 </div>
			 </div>
			 </form>
    <?php
        $obj=new footer();
        $obj->disp_footer();
    ?>

</body>
<script>
        function change(){
            var d=document.getElementById("f1");
            d.style.borderBottomColor="darkblue";
           
        
        }
        function change2(){
            var d=document.getElementById("f1");
            d.style.borderBottomColor="#C9D7E3";
        }
        function change4(){
            var d=document.getElementById("f2");
            d.style.borderBottomColor="#C9D7E3";
        }
        function change3(){
            var d=document.getElementById("f2");
            d.style.borderBottomColor="darkblue";
        }
        </script>
</html>
<?php
    $super_login=new form_receive();
    $super_login->super_login();
    require('preloader/preload.php');
?>