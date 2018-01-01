<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="/ems/css/style.css">
    <script src="/ems/js/super_home_script.js"></script>
    <link rel="stylesheet" href="/ems/css/super_home_styles.css">
    <style>
      #accordion{
      display: block;
      padding: 20px;
      background-color: #f1f1f1;
      height: 100%;
      margin-bottom: 70px;
    }
    </style>
</head>
<body onload="get_recent_act()">

<?php
session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$validate=new validate();
$validate->conf_logged_in_super();
$obj = new head();
$obj->displayheader();
$obj->dispmenu(3, ["/ems/includes/home.php", "/ems/includes/index.php", "/ems/includes/developers.php"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
$dashboard = new dashboard();
$dashboard->display_super_dashboard($_SESSION['super_admin_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "");
$options = new super_user_options();
$options->create_course($conn);
$options->add_subject($conn);
$options->create_operator($conn);
$options->add_session($conn);
$options->update_session($conn);
$options->lock_operator($conn);
$options->unlock_operator($conn);
?>
   <!--<a id="recent-act" onmouseover="show(this.id)" onmouseout="hide(sidenav)">Hover to show recent activities</a>-->
 <!--<button id="recent-act" onClick="show_recent_act()">Hover to show recent activities</button>-->
  <!--<div id="sidenav" class="col-lg-2 col-md-4 col-sm-4 col-xs-4">
   <h2><center>Recent Activities</center></h2>-->
<script>
  function get_recent_act()
  {
    get_check_act();
    get_feed_act();
  }
  
  function get_check_act()
  {
  $.ajax({
	type: "POST",
	url: "recent_activity.php",
	data: 'feed_activity=0',
	success: function(data){
        $("#check_marks_list").html(data);
    },
    error: function(e){
      $("#check_marks_list").html("Unable to load recent activities");
    }
	});
  }
  function get_feed_act()
  {
  $.ajax({
	type: "POST",
	url: "recent_activity.php",
	data: 'feed_activity=1',
	success: function(data){
        $("#feed_marks_list").html(data);
    },
    error: function(e){
      $("#feed_marks_list").html("Unable to load recent activities");
    }
	});
  }
</script>
<div class="panel-group col-lg-3 col-md-4 col-sm-12 col-xs-12" id="accordion">
  <h3>Recent Activities</h3>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#marks_feeding">Marks Feeding</a>
        </h4>
      </div>
      <div id="marks_feeding" class="panel-collapse collapse in">
        <div class="panel-body">
          <ul id="feed_marks_list" class="list-group" style="overflow:auto; height:300px;">
          </ul>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#marks_checking">Marks Checking</a>
        </h4>
      </div>
      <div id="marks_checking" class="panel-collapse collapse">
        <div class="panel-body">
          <ul id="check_marks_list" class="list-group" style="overflow:auto; height:300px;">
          </ul>
        </div>
      </div>
    </div>
    
    </div>
   

  </div>
    
    <div class="main-container col-lg-9 col-md-8 col-sm-12 col-xs-12 ">
    <div class="sub-container col-lg-8 col-md-10 col-sm-12">
        <div class="option red" onmouseover="show('subopt1')" onmouseout="hide('subopt1')">
            <div><i class="glyphicon glyphicon-user"></i></div>
            <div>Operators</div>
            <div class="sub-option" id="subopt1">
            <button data-toggle="modal" data-target="#cr_op_modal"><i class="glyphicon glyphicon-plus"></i> Add</button>
                <button data-toggle="modal" data-target="#view_op_modal"><i class="glyphicon glyphicon-pencil"></i> View/Lock/Delete</button>
            </div>
            </div>
        <div class="option blue" onmouseover="show('subopt2')" onmouseout="hide('subopt2')">
            <div><i class="glyphicon glyphicon-file"></i></div>
            <div>Courses</div>
            <div class="sub-option" id="subopt2">
                <button data-toggle="modal" data-target="#addcourseModal"><i class="glyphicon glyphicon-plus"></i> Add</button>
                <button data-toggle="modal" data-target="#viewcourseModal"><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
            </div>
            </div>
            <div class="option green" onmouseover="show('subopt3')" onmouseout="hide('subopt3')">
            <div><i class="glyphicon glyphicon-retweet"></i></div>
            <div>Marks Processing</div>
            <div class="sub-option" id="subopt3">
                <button data-toggle="modal" data-target="#trSelectiondialog"><i class="glyphicon glyphicon-copy"></i> Generate TR</button>
                <button><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
            </div>
            </div>
            <div class="option pink" onmouseover="show('subopt4')" onmouseout="hide('subopt4')">
            <div><i class="glyphicon glyphicon-list-alt"></i></div>
            <div>Subjects</div>
            <div class="sub-option" id="subopt4">
                <button data-toggle="modal" data-target="#addsubjectModal"><i class="glyphicon glyphicon-plus"></i> Add</button>
                <button><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
            </div>
            </div>
            <div class="option yellow" onmouseover="show('subopt5')" onmouseout="hide('subopt5')">
            <div><i class="glyphicon glyphicon-th-list"></i></div>
            <div>Sessions</div>
            <div class="sub-option" id="subopt5">
            <button data-toggle="modal" data-target="#addsessionModal"><i class="glyphicon glyphicon-plus"></i> Add</button>
            <button data-toggle="modal" data-target="#viewsessionModal"><i class="glyphicon glyphicon-pencil"></i> Update Session</button>
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
          <form action="" method="post" onsubmit="return disable_on_submitbtn()">
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

   <!-- Add Session Modal -->
   <div class="modal fade" id="addsessionModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add New Session</h4>
          </div>
          <form action="" method="post" onsubmit="return disable_on_submitbtn()">
            <div class="modal-body">
            <?php
            $input = new input_field();
            ?>
            <div class="form-group">
                <label for="name">Academic Year</label>
                <select name="session_year" id="type" class="form-control">
                    <?php
                    $input = new input_field();
                    $get_details_qry = "SELECT distinct(from_year) as acad_year from students";
                    $get_details_qry_run = mysqli_query($conn, $get_details_qry);
                    if ($get_details_qry_run) {
                      while ($row = mysqli_fetch_assoc($get_details_qry_run)) {
                        echo ('
                        <option value="' . $row['acad_year'] . '">' . $row['acad_year'] . '</option>
                        ');
                      }
                    } else {
                      $alert = new alert();
                      $alert->exec("Unable to fetch session academic years....", "warning");
                    }
                    ?>
                 </select>
                </div>
                <div class="form-group">
                <label for="type">Course Name</label>
                <select name="session_course" id="type" class="form-control">
                <?php
                $get_details_qry = "SELECT distinct s.course_id,course_name from students s, courses c where s.course_id=c.course_id";
                $get_details_qry_run = mysqli_query($conn, $get_details_qry);
                if ($get_details_qry_run) {
                  while ($row = mysqli_fetch_assoc($get_details_qry_run)) {
                    echo ('
                        <option value="' . $row['course_id'] . '">' . $row['course_name'] . '</option>
                        ');
                  }
                } else {
                  $alert = new alert();
                  $alert->exec("Unable to fetch session courses....", "warning");
                }
                ?>
                 </select>
                </div>
                <div class="form-group">
                <label for="semester">Semester</label>
                <?php
                $input->display_table("semester", "form-control", "number", "session_semester", "", 1, 0, 8, 0, 8);
                ?>
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="session_submit">Add Session<i class="glyphicon glyphicon-chevron-right"></i></button>
        </div>
        </form> 
        </div>
        
      </div>
    </div>
    
  </div>
  <!--End-->

  <!-- View Session Modal -->
  <div class="modal fade" id="viewsessionModal" role="dialog">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">List of existing Sessions</h4>
          </div>
            <div class="modal-body">
            <?php
            $input = new input_button();
            ?>
            <table class="table table-responsive table-striped table-bordered">
            <thead>
                <tr style="text-align:center">
                <th>Academic Year</th>
                <th>Course Name</th>
                <th>Current Semester</th>
                <th>Update</th>
                </tr>
            </thead>
                <tbody>
                    <?php
                    $get_sessions_qry = "SELECT from_year,s.course_id,course_name,current_semester from academic_sessions s, courses c where s.course_id=c.course_id";
                    $get_sessions_qry_run = mysqli_query($conn, $get_sessions_qry);
                    if ($get_sessions_qry_run) {
                      while ($row = mysqli_fetch_assoc($get_sessions_qry_run)) {
                        echo ('
                            <tr style="text-align:center">
                            <td>' . $row['from_year'] . '</td>
                            <td>' . $row['course_name'] . '</td>
                            <td>' . $row['current_semester'] . '</td>
                            <td>');
                        ?>
                           <button type="button" class="btn btn-default" data-target="#updateSessiondialog" data-toggle="modal" data-course="<?= $row['course_name'] ?>" data-year="<?= $row['from_year'] ?>" data-course-id="<?= $row['course_id'] ?>" data-current-semester="<?= $row['current_semester'] ?>" onclick="set_session_values(this)"><i class="glyphicon glyphicon-edit"></i></button>             
                        <?php
                        echo ('</td>
                        ');
                      }
                    }
                    ?>
                </tbody>
        </table>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        
      </div>
    </div>
    
  </div>
  <!--End-->

 <!-- Update Session Modal -->
 <div class="modal fade" id="updateSessiondialog" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Update Session</h4>
          </div>
          <form action="" method="post" onsubmit="return disable_on_submitbtn()">
          <div class="modal-body">
          <?php
          $input = new input_field();
          ?>
          <div class="form-group">
              <label for="name">Academic Year</label>
                <?php
                $input->display_table_readonly("session_ay", "form-control", "number", "session_ay", "", 1, 0, 0, 1, 0);
                ?>
              </div>
              <div class="form-group">
              <label for="type">Course Name</label>
              <?php
              $input->display_table_readonly("session_course_name", "form-control", "text", "session_course_name", "", 0, 0, 0, 1, 0);
              ?>
              </div>
              <div class="form-group">
              <label for="semester">Semester</label>
              <?php
              $input->display_table("session_semester", "form-control", "number", "session_semester", "", 1, 0, 8, 0, 8);
              ?>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Return</button>
            <button type="submit" class="btn btn-success" name="session_update_submit" value="" id="btn_session_update">Update Session<i class="glyphicon glyphicon-chevron-right"></i></button>
        </div>
        </form> 
        </div>
        
      </div>
    </div>
    
  </div>
  <!--End-->

  <!--View Courses Modal-->
  <div class="modal fade" id="viewcourseModal" role="dialog">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">List of Courses</h4>
          </div>
          <form action="" method="post">
            <div class="modal-body">
            <table class="table table-striped table-bordered" style="width: 100%">
    <thead>
      <tr style="text-align:center">
        <th>Course ID</th>
        <th>Course Type</th>
        <th>Course Name</th>
		<th>Duration</th>
	  </tr>
    </thead>
    <tbody>
        
            <?php
            $get_course_qry = "SELECT * from courses";
            $get_course_qry_run = mysqli_query($conn, $get_course_qry);
            if ($get_course_qry_run) {
              while ($course = mysqli_fetch_assoc($get_course_qry_run)) {
                echo ('<tr style="text-align:center">
                        <td>' . $course['course_id'] . '</td>
                        <td>');
                if ($course['level_id'] == 1) {
                  echo ("Undergraduate");
                } else {
                  echo ("Postgraduate");
                }
                echo ('</td>
                        <td>' . $course['course_name'] . '</td>
                        <td>' . $course['duration'] . '</td>
                        </tr>');
              }
            } else {
              $alert->exec("Unable to fetch courses!", "warning");
            }
            ?>
        
    </tbody>
    </table>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <!--<button type="submit" class="btn btn-primary" name="course_submit">Submit</button>-->
        </div>
        </form> 
        </div>
        
      </div>
    </div>
    
  </div>
  <!--End-->

  <!--TR Selection Modal-->
  <div class="modal fade" id="trSelectiondialog" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Fill in the following details</h4>
          </div>
          <form action="generate_tr.php" method="post" onsubmit="return disable_on_submitbtn()">
          <div class="modal-body">
          <?php
          $input = new input_field();
          ?>
          <div class="form-group">
              <label for="name">Academic Year</label>
                <select name="tr_from_year" id="" class="form-control">
                  <?php
                  $get_ay_qry = "SELECT distinct(from_year) from academic_sessions";
                  $get_ay_qry_run = mysqli_query($conn, $get_ay_qry);
                  if ($get_ay_qry_run) {
                    while ($row = mysqli_fetch_assoc($get_ay_qry_run)) {
                      echo ('
                      <option value="' . $row['from_year'] . '">' . $row['from_year'] . '</option>
                      ');
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
              <label for="type">Select Course</label>
              <select name="tr_course" id="" class="form-control">
                  <?php
                  $get_course_qry = "SELECT course_id,course_name from courses";
                  $get_course_qry_run = mysqli_query($conn, $get_course_qry);
                  if ($get_course_qry_run) {
                    while ($row = mysqli_fetch_assoc($get_course_qry_run)) {
                      echo ('
                      <option value="' . $row['course_id'] . '">' . $row['course_name'] . '</option>
                      ');
                    }
                  }
                  ?>
                </select>
              </div>
             
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="tr_submit" value="" id="btn_session_update">Proceed<i class="glyphicon glyphicon-chevron-right"></i></button>
        </div>
        </form> 
        </div>
        
      </div>
    </div>
    
  </div>
  <!--End-->
  <!-- ADD Subject Modal -->
  <div class="modal fade" id="addsubjectModal" role="dialog">
      <div class="modal-dialog modal-lg" style="width: 90%">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Subjects</h4>
          </div>
          <form action="" method="post" onsubmit="return disable_on_submitbtn()">
            <div class="modal-body">
            <div class="modal-container">
        <div class="component">
           <table class="table table-bordered table-responsive">
               <caption>Subject Components</caption>
               <tr>
                <th>Component</th>
               <th>Passing Marks</th>
               <th>Maximum Marks</th>
               </tr>
               <?php
               
              $get_components_qry = "SELECT * from component";
              $get_components_qry_run = mysqli_query($conn, $get_components_qry);
              if ($get_components_qry_run) {
                while ($row = mysqli_fetch_assoc($get_components_qry_run)) {
                  echo ('
                       <tr>
                       <td>' . $row['component_name'] . '</td>
                       <td>');
                  $input->display("", "form-control input-sm", "number", "pass" . $row['component_id'], "", 1);
                  echo ('
                       </td>
                       <td>');

                  $input->display("", "form-control input-sm", "number", "max" . $row['component_id'], "", 1);
                  echo ('</td>
                        </tr>
                       ');
                }
              }
              ?>
               
            </table>
        </div>
    <table class="table table-striped table-responsive table-bordered">
   <caption class="form-inline">
        <div class="form-group">
            <select name="mcourse" id="mcourse" class="form-control" onchange="show_semester()">
            <option value="" disabled selected>Select a course</option>   
            <?php
            $get_course_qry = "SELECT * from courses";
            $get_course_qry_run = mysqli_query($conn, $get_course_qry);
            if ($get_course_qry_run) {
              while ($row = mysqli_fetch_assoc($get_course_qry_run)) {
                echo ('
                    <option value="' . $row['course_id'] . '" data-course-duration=' . $row['duration'] . '>' . $row['course_name'] . '</option>   
                    ');
              }
            } else {
              $alert = new alert();
              $alert->exec("Unable to fetch courses!", "warning");
            }
            ?>
        </select>
        </div>
        <div class="form-group">
            <select name="msemester" id="msemester" class="form-control">
            <option value="" disabled selected>Select semester</option>  
           </select>
        </div>
        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" onclick="subtract()" class="span-btn"><i class="glyphicon glyphicon-minus"></i></span>
            <input type="number" name="number_subjects" class="form-control" placeholder="Number of subjects" id="no_subjects" onkeyup="display_subjects('down')" min="0" onchange="display_subjects('down')" >
            <span class="input-group-addon" onclick="add()" class="span-btn"><i class="glyphicon glyphicon-plus"></i></span>
            </div>
        </div>
        
    </caption>
    <thead>
     <tr>
       <th>Subject Code</th>
       <th>Subject Name</th>
       <th>Subject Type</th>
       <th>Theory Credits</th>
       <th>Practical Credits</th>
       <th>Total Credits</th>
       <th>Internal Examination</th>
     </tr>
   </thead>
   <tbody id="subject_area">
     
     </tbody>
  </table>
    </div>

            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="add_sub_submit">Submit</button>
        </div>
        </form> 
        </div>
        
      </div>
    </div>
    
  </div>


  
    	<!-- Create operator Modal Box-->
	<!-- Modal -->
  <div class="modal fade" id="cr_op_modal" role="dialog">
    <div class="modal-dialog ">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return disable_on_submitinput()">
		<div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Fill in the following details to create a new operator</h4>
        </div>
        <div class="modal-body">
          
			<table>
			   <tr>
				<td>Operator Name: </td>
				<td><?php $creation = new input_field();
        $creation->display("", "form-control", "text", "operator_name", "Name of Operator", 1); ?></td>
			   </tr>
			   <tr>
				<td>Operator Email: </td>
				<td><?php $creation->display("", "form-control", "email", "operator_email", "Email of Operator", 1); ?>
			   </tr>
			  </table>
			 
        </div>
        <div class="modal-footer">
		  
          <?php $creation_b = new input_button();
          $creation_b->display("", "btn btn-success", "submit", "create", "submit", "Create"); ?>
		  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
		</form>
      </div>
      
    </div>
  </div>

  <!--End-->
  
  <!-- Modal Box for viewing operators-->
  <div id="view_op_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return disable_on_submitbtn()">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Operators</h4>
      </div>
      <div class="modal-body modal-lg">
        <?php $get_op_query = "SELECT locked,operator_active,operator_name, operator_username, operator_email from operators";
		$get_op_run = mysqli_query($conn, $get_op_query);
		if (mysqli_num_rows($get_op_run) == 0) {
			$al = new alert();
			$al->exec("No operator exists!", "danger");
		} else {
			echo ('
              
  <table class="table table-striped table-bordered" style="width: 100%">
    <thead>
      <tr style="text-align:center">
        <th>Name</th>
        <th>Username</th>
		<th>Email</th>
		<th>Operator Status</th>
		<th>Lock/Unlock Account</th>
      </tr>
    </thead>
    <tbody> 
   
    ');
			while ($result = mysqli_fetch_assoc($get_op_run)) {
				echo ('
	  <tr style="text-align:center">
    <td>' . $result["operator_name"] . '</td>
        <td>' . $result["operator_username"] . '</td>
		<td>' . $result["operator_email"] . '</td>
		<td>');
				if ($result['operator_active'] == 1) {
					echo ('Active <i class="glyphicon glyphicon-record" style="color:green"></i>');
				} else {
					echo ('Inactive <i class="glyphicon glyphicon-record" style="color:red"></i>');
				}
				echo ('</td><td>');
				if ($result['locked'] == 0) {
					echo ('<button type="submit" class="btn btn-default" name="lock" value="' . $result['operator_username'] . '"><i class="fa fa-lock" aria-hidden="true"> Lock </i> </button>');
				} else {
					echo ('<button type="submit" class="btn btn-default" name="unlock" value="' . $result['operator_username'] . '"><i class="fa fa-unlock"> Unlock</i> </button>');
				}
				echo ('</td>
      </tr>');
			}
			echo ('
   </form> </tbody>
  </table>');


		} ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    <?php
    $obj = new footer();
    $obj->disp_footer();
    $logout_modal=new modals();
    $logout_modal->display_logout_modal();
    ?>
</body>
<script>
    function set_session_values(el){
        document.getElementById("session_ay").value=el.getAttribute("data-year");
        document.getElementById("session_course_name").value=el.getAttribute("data-course");
        document.getElementById("session_semester").value=el.getAttribute("data-current-semester");
        document.getElementById("btn_session_update").value=el.getAttribute("data-course-id");
    }
</script>
</html>
