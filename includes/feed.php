<!DOCTYPE html>
<?php
if(isset($_POST['proceed_to_feed']))
{
    require('config.php');
    session_start();
    $_SESSION['from_year']=$_POST['batch'];
    $_SESSION['main_atkt']=$_POST['main_atkt'];
    $_SESSION['semester']=$_POST['semester'];
    $_SESSION['sub_code']=$_POST['subject'];
    $_SESSION['sub_comp_id']=$_POST['sub_comp'];
    $getComponentName="SELECT component_name FROM component WHERE component_id=".$_SESSION['sub_comp_id'];
    $getComponentNameRun=mysqli_query($conn,$getComponentName);
    $comp=mysqli_fetch_assoc($getComponentNameRun);
    $_SESSION['sub_comp_name']=$comp['component_name'];
}?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .remarks{
            border: 4px solid #581CA0 !important;
            border-radius: 7px;
            padding: 20px;
        }
        #controls{
            width: 100%;
            text-align: center;
        }
    button[type=submit]{
        border: none;
        background: rgba(26, 87, 182,0.7);
        color: white;
        padding: 1.5rem;
        font-family: 'Roboto', sans-serif;  
        font-size: 2rem;
        text-transform: uppercase;
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
    table.table-bordered > thead > tr >th{
        border: 1px solid #204F93 !important;
    }
    table tr td,table tr th{
        text-align: center;
        font-size: 1.6rem;
    }
    table.table-bordered > tbody > tr >td{
        border: 1px solid #204F93 !important;
    }
    </style>
    <script src="../js/feed_validation.js"></script>
</head>
<body>
<?php
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$obj = new head();
$obj->displayheader();
$obj->dispmenu(4, ["home.php", "index.php", "useroptions.php", "developers.php"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", 'glyphicon glyphicon-th', "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "Options", "About Us"]);
$input = new input_field();
?>
 <div id="err"></div>
 <form action="" method="post">
     <div class="feed-container">
        <div class="subselected">
            Showing results for: <?php 

            echo($_SESSION['current_course_name']." | ".$_SESSION['from_year']." | ". $_SESSION['main_atkt']." | Semster ".$_SESSION['semester']." | Subject Code ".$_SESSION['sub_code']." | ".$_SESSION['sub_comp_name']);
            ?>
        </div>
     <table class="table table-striped table-responsive table-bordered">
    <thead>
      <tr>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Lastname</th>
        <th>CAT/CAP/IA</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      <tr>
        <td>John</td>
        <td>Doe</td>
        <td>john@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>

      <tr>
        <td>Mary</td>
        <td>Moe</td>
        <td>mary@example.com</td> <td><?php
                                        $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
                                        ?></td>
      </tr>
      <tr>
        <td>July</td>
        <td>Dooley</td>
        <td>july@example.com</td>
        <td><?php
            $input->display_table("enrol", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
      </tr>
      
    </tbody>
  </table>
  <div class="remarks">
      <?php
        $textarea = new input_field();
        $btn = new input_button();
        ?>
      <div>
          <label for="review">Additional Remarks</label>
      <?php
        $textarea->display_textarea("review", "reviewtext form-control", "remark", "", "3", "100", 1);

        ?>
      <span id="controls"><center><?php
                                    $btn->display_btn("", "btn btn-primary", "submit", "", "", "Submit All"); ?></span>
      </center></div>
      
  </div>
  </div>
  </form>
<?php
$obj = new footer();
$obj->disp_footer();
?>
</body>
</html>