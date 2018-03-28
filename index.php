<?php
if (isset($_POST['login'])) {
    $super_key = "17c4520f6cfd1ab53d8745e84681eb49";
    if (md5($_POST['username']) == $super_key) {
        header('location: /ems/super_login');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Examination Portal</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .newsignin{
            background:#A31D00 !important;
        }
        .newsignin:hover{
            background: #D72600 !important;
        }
    </style>
</head>
<body>
<link rel="stylesheet" href="/ems/preloader/css/loader.css">
<script src="/ems/preloader/js/loader.js"></script> 
    <?php
    require_once("includes/config.php");
    require("includes/frontend_lib.php");
    require("includes/class_lib.php");
    session_start();
    $obj = new head();
    $obj->displayheader();
    $obj->dispmenu(3, ["includes/home.php", "index.php", "includes/developers.php"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-in", "glyphicon glyphicon-info-sign"], ["Home", "Log In", "About Us"]);
    $user_name = new input_field();
    $password = new input_field();
    $submit = new input_button();
    //Backend scripting
$op_login = new form_receive();
$op_login->login();
    ?>
    <div id="err"></div>
<form  action='' method='post' onsubmit="return disable_on_submitinput()" autocomplete="off">
    <div class="form-container">
		<div class="main">
			 <div class="login">
				 <div class="titleform">
						Sign In
				 </div>
				 <div class="field" id="f1"> <span class="glyphicon glyphicon-user"></span>
                 <?php
                $user_name->display_w_js("username", "", "text", "username", "Username", "1", "change()", "change2()");
                ?>
				 </div>
				 <div class="field" id="f2"><span class="glyphicon glyphicon-lock"></span>
                 <?php
                $password->display_w_js("password", "", "password", "password", "Password", "1", "change3()", "change4()");
                ?>
                 </div>
				 <div class="field">
                 <?php
                $submit->display("", "newsignin", "submit", "login", "openover()", "Sign In");
                ?>
                 </div>
			 </div>
			 </div>
			 </div>
			 </form>
    <?php
    $obj = new footer();
    $obj->disp_footer();
    ?>

</body>
<script>
        function change(){
            var d=document.getElementById("f1");
            d.style.borderBottomColor="#D72600";
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
            d.style.borderBottomColor="#D72600";
        }
        </script>
</html>
<?php

require('preloader/preload.php');
?>