<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <title>Document</title>
    <style>
        .overlay1 {
            position: absolute;
            justify-content: center;
            align-items: center;
            background: rgba(91, 93, 158, 0.75);
            z-index: 0;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        
        .overlaycontainer1 {
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
        input[type=password] {
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
        input[type=password]:focus {
            outline-width: 0;
        }
        input[type="radio"]{
            color: white !important;
        }
        form {
            width: 60% !important;
            overflow: auto;
        }
        
        table {
            width: 100%;
        }
        
        * {
            font-size: 22px;
            font-family: calibri;
        }
        
        body {
            width: 100%;
            height: 100%;
        }
        
        fieldset {
            border: 1px solid white;
            border-radius: 4px;
        }
        
        legend {
            text-align: center;
            background: white;
            color: white;
            height: 40px;
            font-weight: 900;
        }
        
        span {
            color: white;
        }
        
        table tr button {
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
        
        label {
            color: white;
            width: 150px;
            font-size: 18px;
            font-family: 'Open Sans', sans-serif;
            font-weight: normal !important;
        }
        
        title {
            padding: 15px;
            font-weight: bolder;
            font-family: 'Raleway', sans-serif;
            font-weight: bold;
            color: white;
            font-size: 24px;
        }
        
        .qtitle1 {
            padding: 15px;
            font-weight: bolder;
            font-family: 'Raleway', sans-serif;
            color: white;
            font-size: 30px;
        }
        
        .usersign {
            font-size: 22px;
            font-weight: bolder;
        }
        
        .signin {
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
        .radio{
            color: white;
        }
    </style>
</head>

<body>
<?php
    require_once("config.php");
    require("frontend_lib.php");
    require("class_lib.php");
    $obj=new head();
    $obj->displayheader();
    $obj->dispmenu(3,["home.php","index.php","developers.php"],["glyphicon glyphicon-home","glyphicon glyphicon-log-in","glyphicon glyphicon-info-sign"],["Home","Log In","About Us"]);
?>
   <?php
        $obj=new footer();
        $obj->disp_footer();
    ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
        <div class="overlay1" style="z-index:-1;">
        <div class="overlaycontainer1">
            <div class="qtitle1">Add New Course</div>
            <form action="" method="post" class="col-md-4" onsubmit="validate()">
                <fieldset>
                    <table>
                        <tr>
                            <td><label class="usersign" for="" class="usersign">Course Name</label></td>
                            <td><input type="text" name="course_name"></td>
                        </tr>
                        <tr>
                            <td><label for="" class="usersign">Duration</label></td>
                            <td><input type="password" name="opassword"></td>
                        </tr>
                        <tr>
                        <td><label for="" class="usersign">Level</label></td>
                        <td>    
                            <select>
                                <option value="1">Under Graduate</option>
                                <option value="2">Post Graduate</option>
                            </select>
                        </td>
                        </tr>
                        <tr style="text-align:center; margin-bottom: 20px">
                            <td colspan="2">
                                <button type="submit" class="signin" name="attempt_now">Add</button>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </div>
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
</body>

</html>