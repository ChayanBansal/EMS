<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="/ems/css/style.css">
    <style>
    .main-container{
        animation: fadein 500ms ease-in-out 1;
        opacity: 0;
        animation-fill-mode: forwards;
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;
    }
    .option{
        padding: 15px;
        padding-right: 30px;
        padding-left: 30px;
        margin: 20px;
        display: flex;
        flex-wrap: wrap;
        color: white;
        font-size: 2rem;
        flex-direction: column;
        align-items: center;
        font-family: 'PT Sans', sans-serif;
    }
    .sub-option{
        margin-top: 5px;
        display: none;
        width: 100%;
        background: orangered;
        color: white;
        border: 1px solid white;
        transition: all 300ms;
    }
    .sub-option button{
        padding: 5px;
        border: none;
        background: orangered;
    }
    .sub-option button:hover{
        background: white;
        color: orangered;
    }
    @keyframes fadein{
        0%{
            opacity: 0;
        }
        100%{
            opacity: 1;
        }
    }
    form label{
        font-size: 1.6rem !important;
    }
    </style>
</head>
<body>
<?php
session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$obj = new head();
$obj->displayheader();
$obj->dispmenu(3, ["/ems/includes/home.php", "/ems/includes/index.php", "/ems/includes/developers.php"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
$dashboard = new dashboard();
$dashboard->display_super_dashboard($_SESSION['super_admin_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "");
$options = new super_user_options();
$options->create_course($conn);
?>
    <div class="main-container col-md-12">
    <div class="sub-container">
        <div class="option red" onmouseover="show('subopt1')" onmouseout="hide('subopt1')">
            <div><i class="glyphicon glyphicon-user"></i></div>
            <div>Operators</div>
            <div class="sub-option" id="subopt1">
                <button><i class="glyphicon glyphicon-plus"></i> Add</button>
                <button><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
            </div>
            </div>
        </div>
        <div class="option blue" onmouseover="show('subopt2')" onmouseout="hide('subopt2')">
            <div><i class="glyphicon glyphicon-file"></i></div>
            <div>Courses</div>
            <div class="sub-option" id="subopt2">
                <button data-toggle="modal" data-target="#addcourseModal"><i class="glyphicon glyphicon-plus"></i> Add</button>
                <button><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
            </div>
            </div>
            <div class="option green" onmouseover="show('subopt3')" onmouseout="hide('subopt3')">
            <div><i class="glyphicon glyphicon-file"></i></div>
            <div>Marks Processing</div>
            <div class="sub-option" id="subopt3">
                <button><i class="glyphicon glyphicon-copy"></i> Generate TR</button>
                <button><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
            </div>
            </div>
            <div class="option pink" onmouseover="show('subopt4')" onmouseout="hide('subopt4')">
            <div><i class="glyphicon glyphicon-user"></i></div>
            <div>Subjects</div>
            <div class="sub-option" id="subopt4">
                <button><i class="glyphicon glyphicon-plus"></i> Add</button>
                <button><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
            </div>
            </div>
        </div>

    </div>
    </div> 
    </div>
    </div>
    <!-- Course Modal -->
    <div class="modal fade" id="addcourseModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Course</h4>
          </div>
          <form action="" method="post">
          <div class="modal-body">
           
                <?php
                $input = new input_field();
                ?>
                <div class="form-group">
                <label for="name">Course Name</label>
                <?php
                $input->display("name", "form-control", "text", "cname", "", 1);
                ?>
                </div>
                <div class="form-group">
                <label for="type">Course Type</label>
                <select name="level" id="type" class="form-control">
                    <option value="ug">Undergraduate</option>
                    <option value="pg">Postgraduate</option>
                </select>
                </div>
                <div class="form-group">
                <label for="duration">Duration</label>
                <?php
                $input->display_table("duration", "form-control", "number", "cduration", "", 1, 1, 10, 0, 10);
                ?>
                </div>
                <div class="form-group">
                <label for="number">Number of subjects</label>
                <?php
                $input->display_table("number", "form-control", "number", "c_no_subjects", "", 1, 0, 20, 0, 20);
                ?> 
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="course_submit">Submit</button>
        </div>
        </form> 
        </div>
        
      </div>
    </div>
    
  </div>
  <!--End-->
  
  <!-- ADD Subject Modal -->
  <div class="modal fade" id="addsubjectModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Subjects</h4>
          </div>
          <form action="" method="post">
          <div class="modal-body">
           
                <?php
                $input = new input_field();
                ?>
                <div class="form-group">
                <label for="name">Course Name</label>
                <select name="course" id="">
                    <?php
                    $get_courses_qry="SELECT course_name from courses";
                    $get_courses_qry_run=mysqli_query($conn,$get_courses_qry);
                    while($row=mysqli_fetch_assoc($get_courses_qry_run)){
                        
                    }
                    ?>
                </select>
                </div>
                <div class="form-group">
                <label for="type">Course Type</label>
                <select name="level" id="type" class="form-control">
                    <option value="ug">Undergraduate</option>
                    <option value="pg">Postgraduate</option>
                </select>
                </div>
                <div class="form-group">
                <label for="duration">Duration</label>
                <?php
                $input->display_table("duration", "form-control", "number", "cduration", "", 1, 1, 10, 0, 10);
                ?>
                </div>
                <div class="form-group">
                <label for="number">Number of subjects</label>
                <?php
                $input->display_table("number", "form-control", "number", "c_no_subjects", "", 1, 0, 20, 0, 20);
                ?> 
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="course_submit">Submit</button>
        </div>
        </form> 
        </div>
        
      </div>
    </div>
    
  </div>
  <!--End-->
    <?php
    $obj = new footer();
    $obj->disp_footer();
    ?>
</body>
<script>
    function show(el){
        document.getElementById(el).style.display="block";
    }
    function hide(el){
        document.getElementById(el).style.display="none";
    }
</script>
</html>