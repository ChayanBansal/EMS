<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <title>Document</title>
    <style>
        .overlay1{
            position: absolute;
            justify-content: center;
            align-items: center;
            background: rgba(22, 25, 126,0.8);
            z-index: -1;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

    .overlaycontainer1{
        position: absolute;
        display: flex;
        top: 0;
        left: 0;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
        height: 100%;
    }

    table tr td {
        padding: 15px;
        margin-bottom: 5px;
    }

    input[type=text],
    input[type=password]
    {
        width: 100%;
        border-radius: 4px;
        font-size: 16px;
        padding: 6px;
        border: 1px solid white;
        background: transparent;
        font-family: 'Roboto', sans-serif;
        color: white;
        font-weight: normal;
    }
    input[type=text]:focus,
    input[type=password]:focus
    {
        outline-width: 0;
    }


    form {
        z-index: 100;
        width: 40% !important;  
        overflow: auto;  
    }

    table {
        width: 100%;
    }

    * {
        font-size: 22px;
        font-family: calibri;
    }
    body{
    width: 100%;
    height: 100%;
    }
    fieldset {
        z-index: 100;
        border: 1px solid white;
        border-radius: 4px;
    }

    legend {
        z-index: 100;
        text-align: center;
        background: white;
        color: white;
        height: 40px;
        font-weight: 900;
    }
    span{
    color: white;
    }
    table tr button{
        background: transparent;
        font-weight: normal;
        color: white;
        width: 200px;
        padding: 7px;
        border: 1px solid white;
        margin-right: 20px;
        transition: all 300ms;
        margin-top: 10px;
        margin: 30px;
        margin-bottom: 50px;
        font-size: 20px;
    }
    table tr button:hover {
        background: white;
        cursor: pointer;
        color: black;
    }
    label{
            color:white;
            width: 150px;
            font-size: 18px;
            font-family: 'Open Sans', sans-serif;
            font-weight: normal !important;
        }
    title{
            padding: 15px;
            font-weight: bolder;
            font-family: 'Raleway', sans-serif;
            font-weight: bold;
            color: white;
            font-size: 24px;
        }
    .qtitle1{
        padding: 15px;
        font-weight: bolder;
        font-family: 'Raleway', sans-serif;
        color: white;
        font-size: 30px;
    }
    .usersign{
        font-size: 22px;
        font-weight: bolder;
        font-family: 'Raleway', sans-serif;
    }
    .signin{
        background: transparent;
        font-weight: bolder;
        color: white;
        width: 300px;
        padding: 7px;
        border: 1px solid white;
        border-radius: 5px;
        margin-right: 20px;
        transition: all 300ms;
        margin-top: 10px;
        margin: 30px;
        margin-bottom: 50px;
        font-size: 30px;
    }
    </style>
</head>
<body>
<?php
    session_start();
    require("config.php");
    require("frontend_lib.php");
    require("class_lib.php");
    $obj=new head();
    $obj->displayheader();
    $obj->dispmenu(3,["home.php","index.php","developers.php"],["glyphicon glyphicon-home","glyphicon glyphicon-log-in","glyphicon glyphicon-info-sign"],["Home","Log Out","About Us"]);
    $dashboard=new dashboard();
    $dashboard->display($_SESSION['operator_name'],["Change Password","Sign Out"],["change_password.php","index.php"],"Conatct Super Admin");
    $change_p=new change_password();
    $change_p->execute($conn);
?>
    <div class="overlay1">
        <div class="overlaycontainer1">
            <div class="qtitle1">Change Password</div>
            <form action="" method="post" class="col-md-4">
                <fieldset>
                    <table>
                        <tr>
                            <td class="usersign"><label for=""  class="usersign">User Name </label></td>
                            <td><input type="text" name="email" ></td>
                        </tr>
                        <tr>
                            <td><label for=""  class="usersign">Old Password </label></td>
                            <td><input type="password" name="cur_password" ></td>
                        </tr>
                        <tr>
                            <td><label for=""  class="usersign">New Password </label></td>
                            <td><input type="password" name="new_password" ></td>
                        </tr>
                        <tr>
                            <td><label for=""  class="usersign">Retype New Password </label></td>
                            <td><input type="password" name="confirm_new_password" ></td>
                        </tr>
                        <tr style="text-align:center; margin-bottom: 20px">
                            <td colspan="2">
                                <button type="submit" class="signin" name="change_password">Change Password</button> <!-- CHANGE THIS TO ATTEMPT NOW // USE input_button FORM -->
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
    </div>
</body>
</html>