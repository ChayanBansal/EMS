<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Super Admin - Change Password</title>
    <style>
    .main-container{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
    }
    .form-container{
        border: 1px solid black;
        padding: 20px;
        border-radius: 7px;
    }
    .form-container input{
        width: 100%;
    }
    .ftitle{
        margin-bottom: 20px;
        text-align: center;
        width: 100%;
        font-size: 24px;
    }
    
    button{
        padding: 10px;
        font-family: 'Open Sans', sans-serif;
        font-weight: 200 !important;
    }
    button[type=submit]{
        border: none;
        background: rgba(26, 87, 182,0.7);
        color: white;
        font-size: 2rem;
        transition: all 400ms;
    }
    
    button[type=submit]:hover{
        animation: moveup 300ms 1 ease-in-out;
        animation-fill-mode: forwards;
        background: rgba(255,255,255,0.8);
        color: #1A57B6;    
        box-shadow: 4px 4px 4px rgba(0,0,0,0.6);
        cursor: pointer;
    }
    
    button[type=reset]{
        border: none;
        background: rgba(227, 61, 31,0.7);
        color: white;
        font-size: 2rem;
        transition: all 400ms;
    }
    
    button[type=reset]:hover{
        animation: moveup 300ms 1 ease-in-out;
        animation-fill-mode: forwards;
        background: rgba(255,255,255,0.8);
        color: #E33D1F;    
        box-shadow: 4px 4px 4px rgba(0,0,0,0.6);
        cursor: pointer;
    }
    #btns{
        display: flex;
        justify-content: space-around;
    }
    </style>
</head>
<body>
<?php
session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$validate = new validate();
$validate->conf_logged_in_super();
$obj = new head();
$obj->displayheader();
$obj->dispmenu(3, ["/ems/includes/super_home", "/ems/includes/logout_super", "/ems/includes/developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
$dashboard = new dashboard();
$dashboard->display_super_dashboard($_SESSION['super_admin_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "");
$input = new input_field();
$change_pass=new change_password();
$change_pass->execute($conn);
?>
<div class="main-container">
    <div class="form-container col-md-8 col-xs-10 col-sm-10 col-lg-4">
    <div class="ftitle">Change Password</div>    
    <form action="" method="post">

        <div class="form-group">    
        <label for="">Username</label>
           <input type="text" name="username" id="" class="form-control" required>
            </div>
            <div class="form-group">    
            <label for="">Current Password</label>
            <input type="password" name="cur_pass" id="" required class="form-control">
            </div>
            <div class="form-group">    
            <label for="">New Password</label>
            <input type="password" name="new_pass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
            </div>
            <div class="form-group">    
            <label for="">Retype Password</label>
            <input type="password" name="retype_pass" id="" class="form-control" required>
            </div>
            <div class="form-group" id="btns">
            <button type="reset" onclick="resetfields()">Reset <i class="glyphicon glyphicon-repeat"></i></button>
                        <button type="submit" name="change_password">Submit <i class="glyphicon glyphicon-chevron-right"></i></button>   
            </div>
        </form>
    </div>
</div>

<?php
$obj = new footer();
$obj->disp_footer();
?>
</body>
</html>