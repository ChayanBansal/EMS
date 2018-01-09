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
    <script src="/ems/js/feed_validation.js"></script>
    <style>
      #accordion{
      display: block;
      padding: 20px;
      background-color: #f1f1f1;
      height: 100%;
      margin-bottom: 70px;
    }
    #accordion2{
      display: block;
      padding: 20px;
      background-color: #f1f1f1;
      height: 100%;
      margin-bottom: 70px;
    }
    .chat_box{
      height:250px;
      overflow:auto;
    }
    </style>
    <script>
     function show_ay(){
      var course=document.getElementById("mcourse").value;
      $.ajax({
            type: "POST",
          url: "ajax_response",
          data: 'get_ay='+course,
          success: function(data){
                $("#myear").html(data);
            },
            error: function(e){
                alert('Unable to load course years!');
            }
          });
    }
    </script>
</head>
<body onload="get_recent_act()">

<?php
session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$validate = new validate();
$validate->conf_logged_in_super();
if (isset($_SESSION['tr_generated'])) {
  if ($_SESSION['tr_generated'] == true) {
    $alert = new alert();
    $alert->exec("Tabulation Register for " . $_SESSION['course_name'] . " academic session " . $_SESSION['from_year'] . " successfully generated!", "success");

  } else {
    $alert = new alert();
    $alert->exec("Unable to generate tabulation register!", "danger");

  }
  unset($_SESSION['tr_generated']);
}
$obj = new head();
$obj->displayheader();
$obj->dispmenu(3, ["/ems/includes/super_home", "/ems/includes/logout_super", "/ems/includes/developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
$dashboard = new dashboard();
$dashboard->display_super_dashboard($_SESSION['super_admin_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "");
$options = new super_user_options();
$options->create_course($conn);
$options->add_subject($conn);
$options->create_operator($conn);
$options->add_session($conn);
$options->update_session($conn);
$options->create_exam_month_year($conn);
$options->message($conn);
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
	url: "recent_activity",
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
	url: "recent_activity",
	data: 'feed_activity=1',
	success: function(data){
        $("#feed_marks_list").html(data);
    },
    error: function(e){
      $("#feed_marks_list").html("Unable to load recent activities");
    }
	});
  }

    function chat(location,username)
    {
    $.ajax({
    type: "POST",
    url: "chat",
    data: 'username='+username,
    success: function(data){
          $(document.getElementById(location)).html(data);
          var divi=document.getElementById(location);
        divi.scrollTop=divi.scrollHeight;
          chat(location,username);
      },
      error: function(e){
        $(document.getElementById(location)).html("Unable to load recent activities");
      }
    });
    }
  function sendMessage(username,location)
  {
    var msg=document.getElementById(username).value;
  $.ajax({
	type: "POST",
	url: "chat",
	data: 'username='+username+'&msg='+msg,
	success: function(data){
    chat(location,username);
    document.getElementById(username).value='';
    },
    error: function(e){
      $(document.getElementById(location)).html("Unable to load recent activities");
    }
	});
  }

  function tr_getFromYear(tr_course_id)
  {
    $.ajax({
	type: "POST",
	url: "select_tr",
	data: 'tr_getFromYear=1&course_id='+tr_course_id,
	success: function(data){
        $("#tr_batch_list").html(data);
    },
    error: function(e){
      $("#tr_batch_list").html("Unable to load recent activities");
    }
	});
  }

function tr_getSemester(tr_type)
{
  tr_from_year=document.getElementById("tr_batch_list").value;
  tr_course_id=document.getElementById("tr_course_list").value;
  $.ajax(
    {
      type: "POST",
      url: "select_tr",
      data: 'tr_getSemester=1&tr_getFromYear=0&course_id='+tr_course_id+'&from_year='+tr_from_year+'&type='+tr_type,
      success: function(data){
        $("#tr_semester").html(data);
    },
    error: function(e){
      $("#tr_semester").html("Unable to load recent activities");
    }
	});
  }
  


</script>
<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12" style="display:flex; flex-direction:column;">
<div class="panel-group" id="accordion" >
   <h3><center>Recent Activities</center></h3>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#marks_feeding"><center>Marks Feeding</center></a>
        </h4>
      </div>
      <div id="marks_feeding" class="panel-collapse collapse in">
        <div class="panel-body">
          <ul id="feed_marks_list" class="list-group" style="overflow:auto; height:300px;">
          Loading...
          </ul>
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#marks_checking"><center>Marks Checking</center></a>
        </h4>
      </div>
      <div id="marks_checking" class="panel-collapse collapse">
        <div class="panel-body">
          <ul id="check_marks_list" class="list-group" style="overflow:auto; height:300px;">
          Loading...
          </ul>
        </div>
      </div>
    </div>   
</div>


    

    <!--ChatBox-->
<div class="panel-group" id="accordion2" >
   <h3><center>Chat</center></h3>
   <?php 
  $get_users = "SELECT CONCAT('s',super_admin_id) AS id, super_admin_username AS username, super_admin_name AS name FROM super_admin UNION
    SELECT CONCAT('o',operator_id) As id, operator_username AS username, operator_name AS name FROM operators";
  $get_users_run = mysqli_query($conn, $get_users);
  while ($user = mysqli_fetch_assoc($get_users_run)) {
    $location = "l" . $user['id'];
    echo ('<div class="panel panel-default">
              <div class="panel-heading">
                <h4 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion2" href="#' . $user['id'] . '">
                    ' . $user['name'] . '</a>
                </h4>
              </div>
              <div id="' . $user['id'] . '" class="panel-collapse collapse">
                <div class="panel-body">
                  <div id="' . $location . '" class="chat_box">Loading...</div>
                  <div class="panel-footer">
                    <input class="form-control" id="' . $user['username'] . '" type="text">
                    <button id="b' . $user['username'] . '"class="btn btn-info form-control" value="' . $user['username'] . '" onClick="sendMessage(this.value,' . $location . ');" >Send</button>
                  </div>
                </div>
              </div>
            </div>
            <script>
            document.getElementById("b' . $user['username'] . '").addEventListener("click", function(){ chat("' . $location . '","' . $user['username'] . '"); });
           chat("' . $location . '","' . $user['username'] . '");
              

              $("#' . $location . '").animate({
                scrollTop: $("#' . $location . '").offset().top
             }, "slow");
             
            </script>
           ');/*document.getElementById("b'.$user['username'].'").addEventListener("click", function(){ chat("'.$location.'","'.$user['username'].'"); });
           chat("'.$location.'","'.$user['username'].'");*/
  }
    //echo('<script>setInterval(chat(),3000);</script>');

  ?>  
</div>
    <!--ChatBoxEnd-->
</div>


    <div class="main-container col-lg-9 col-md-8 col-sm-12 col-xs-12 ">
    
    <div class="sub-container col-lg-8 col-md-10 col-sm-12 col-xs-12">
    <h2 class="tcaption">Choose Operations: </h2>
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
                <button data-toggle="modal" data-target="#view_tr"><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
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
            <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#select_month">Set Examination Month</button>
            </div>
            </div>


    </div>
    </div>

<!-- View TR Modal Start-->

<!-- Modal -->
<div id="view_tr" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="view_tr" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style="color:black">&times;</span></button>
        <h4 class="modal-title">View TR</h4>
      </div>
      <div class="modal-body">
                <div class="form-group">
                    <label for="tr_course">Course :</label>
                    <select id="tr_course_list" name="tr_course" class="form-control" onChange="tr_getFromYear(this.value)" required>
                        <option value="" disabled selected>Select Course</option>
                        <?php 
                        $get_course = "SELECT DISTINCT(ac.course_id), c.course_name  FROM academic_sessions ac, courses c WHERE c.course_id=ac.course_id";
                        $get_course_run = mysqli_query($conn, $get_course);
                        while ($course = mysqli_fetch_assoc($get_course_run)) {
                          echo ('<option value="' . $course['course_id'] . '">' . $course['course_name'] . '</option>');
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tr_batch">Batch (Starting Year) :</label>
                    <select id="tr_batch_list" name="tr_batch" class="form-control" required>
                        <option value="" disabled selected>Select Batch</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tr_type">Type :</label>
                    <select id="tr_type" name="tr_type" class="form-control" required onChange="tr_getSemester(this.value)">
                        <option value="" disabled selected>Select Type</option>
                        <option value="main">Main</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tr_semester">Semester :</label>
                    <select id="tr_semester" name="tr_semester" class="form-control" required>
                        <option value="" disabled selected>Select Semester</option>                       
                    </select>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name="view_tr_submit">Proceed</button>
      </div>
                      </form>
    </div>

  </div>
</div>
<!-- View TR Modal Close-->

    <!-- Add Course Modal -->
    <div class="modal fade" id="addcourseModal" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span style="color:black">&times;</span></button>
            <h4 class="modal-title">Add New Course</h4>
          </div>
          <form action="" method="post" onsubmit="return disable_on_submitbtn()">
            <div class="modal-body">
           
                <?php
                $input = new input_field();
                ?>
                <div class="form-group">
                <label for="name">Program Name</label>
                <?php
                $input->display("prog_name", "form-control", "text", "prog_name", "", 1);
                ?>
                </div>

                <div class="form-group">
                <label for="name">Branch Name</label>
                <input type="text" name="branch_name" id="branch_name" class="form-control" onfocusout="set_course()" required>
                </div>
                <div class="form-group">
                <label for="name">Course Name</label>
                <div class="form-inline">
                <input type="text" name="cname" id="cname" class="form-control" readonly required>
                <button id="course_change" class="btn btn-default" type="button" onclick="toggle_course_name()">Change Name</button>  
              </div>
              </div>
                <div class="form-group">
                <label for="type">Course Type</label>
                <select name="level" id="type" class="form-control" required>
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


    <!-- Mailing Modal -->
    <div class="modal fade" id="mailModal" role="dialog">
      <div class="modal-dialog modal-lg">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Draft a Message</h4>
          </div>
          <form action="" method="post" onsubmit="return disable_on_submitbtn()">
            <div class="modal-body">
                <?php
                $input = new input_field();
                ?>
                <div class="form-group">
               <h4>To</h4>
              
                <?php
                $get_op_qry = "SELECT operator_email,operator_username,operator_name FROM operators";
                $get_op_qry_run = mysqli_query($conn, $get_op_qry);
                if ($get_op_qry_run) {
                  $_SESSION['no_operators'] = 0;
                  while ($operators = mysqli_fetch_assoc($get_op_qry_run)) {
                    echo ('<label class="checkbox-inline" style="font-weight: normal !important">
                    <input id="name' . $_SESSION['no_operators'] . '" type="checkbox" name="op' . $_SESSION['no_operators'] . '" value="' . $operators['operator_email'] . '">' . strtoupper($operators['operator_name']) . '
                    </label>');
                    $_SESSION['no_operators']++;
                  }
                }
                ?>
                 <label class="checkbox-inline" style="font-weight: normal !important">
                    <input type="checkbox" onselect="" onchange="toggle_all_operators(this,<?= $_SESSION['no_operators'] ?>)"> <b>Select All</b>
                    </label>
                </div>
                <div class="form-group">
                <label for="type">Subject</label>
                <?php
                $input->display_table("", "form-control", "text", "mail_sub", "", 1, 1, 10, 0, 10);
                ?>
             </div>
                <div class="form-group">
                <label for="duration">Body</label>
                <?php
                $input->display_textarea("", "form-control", "mail_body", "", 4, 30, 1);
                ?>
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Exit</button>
            <button type="submit" class="btn btn-success" name="send_mail">Send Mail <i class="glyphicon glyphicon-send"></i></button>
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
                <select name="session_year" id="type" class="form-control" required>
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
                <select name="session_course" id="type" class="form-control" required>
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
          <form action="generate_tr" method="post" onsubmit="return disable_on_submitbtn()">
          <div class="modal-body">
          <?php
          $input = new input_field();
          ?>
          <div class="form-group">
              <label for="name">Academic Year</label>
                <select name="tr_from_year" id="" class="form-control" required>
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
              <select name="tr_course" id="" class="form-control" required>
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
              <div id="err"></div>
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
                $i = 0;
                while ($row = mysqli_fetch_assoc($get_components_qry_run)) {
                  echo ('
                       <tr>
                       <td>' . $row['component_name'] . '</td>
                       <td>');
                  echo ('<input type="number" id="pass' . $i . '" class="form-control input-sm" name="pass' . $row['component_id'] . '" onkeyup="validate(this,100)" onfocusout="validate_focus(this,100)" onchange="validate(this,100)" required>');
                  echo ('
                       </td>
                       <td>');
                  echo ('<input type="number" id="max' . $i . '" class="form-control input-sm" name="max' . $row['component_id'] . '" onkeyup="validate(this,100); check_max(this,' . $i . ')" onfocusout="validate_focus(this,100)" onchange="validate(this,100); check_max(this,' . $i . ')" required>');
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
            <select name="mcourse" id="mcourse" class="form-control" onchange="show_semester(); show_ay()" required>
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
            <select name="myear" id="myear" class="form-control" required>
            <option value="" disabled selected>Select Academic Year</option>
            <?php
            $get_year_qry = "SELECT distinct(from_year) from academic_sessions";
            $get_year_qry_run = mysqli_query($conn, $get_year_qry);
            if ($get_year_qry_run) {
              while ($row = mysqli_fetch_assoc($get_year_qry_run)) {
                echo ('
                    <option value="' . $row['from_year'] . '" >' . $row['from_year'] . '</option>   
                    ');
              }
            } else {
              $alert = new alert();
              $alert->exec("Unable to fetch academic sessions for subjects!", "warning");
            }
            ?>  
           </select>
        </div>
        <div class="form-group">
            <select name="msemester" id="msemester" class="form-control" required>
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
       <th>Elective Subject</th>
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
        <form action="" method="post" onsubmit="return disable_on_submitinput()">
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
  
  <!-- Selecting Exam Month -->

<!-- Modal -->
<div id="select_month" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <form action='' method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Examination Month</h4>
      </div>
      <div class="modal-body">
      <div class="form-group">
        <div class="checkbox">
          <?php $get_sessions="SELECT * FROM academic_sessions";
                $get_sessions_run=mysqli_query($conn,$get_sessions);
                while($session=mysqli_fetch_assoc($get_sessions_run))
                {
                  $get_course_name="SELECT course_id,course_name FROM courses WHERE course_id=".$session['course_id'];
                  $get_course_name=mysqli_query($conn,$get_course_name);
                  $course_name=mysqli_fetch_assoc($get_course_name);
                  echo('<label><input type="checkbox" name="session'.$session['course_id'].'" value="'.$session['ac_session_id'].'">'.$course_name['course_name'].'-'.$session['from_year'].'-'.$session['current_semester'].' </label>');
                }
          ?>
          </div>
          <div clas="form-group">
              <label for="month">Select Year: </label>
                <input type="number" name="year" id="" min="2016" class="form-control">
            </div>
            <div clas="form-group">
              <label for="month">Select Month:</label>
              <select name="month" id="" class="form-control">
                <option value="january">January</option>
                <option value="february">February</option>
                <option value="march">March</option>
                <option value="april">April</option>
                <option value="may">May</option>
                <option value="june">June</option>
                <option value="july">July</option>
                <option value="august">August</option>
                <option value="september">September</option>
                <option value="october">October</option>
                <option value="november">November</option>
                <option value="december">December</option>
              </select>
              </div>
        </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-info" name="set_exam_month">Set Examination Month</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!-- selecting exam month close-->
  
  <!-- Modal Box for viewing operators-->
  <div id="view_op_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
    <form action="" method="post" onsubmit="return disable_on_submitbtn()">
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
    $logout_modal = new modals();
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
    function toggle_all_operators(el,no){
      
        if(el.checked){
          for(var i=0;i<no;i++)
          document.getElementById("name"+i).checked=true;
        }
        else{
          for(var i=0;i<no;i++)
          document.getElementById("name"+i).checked=false;   
        }
    }
   
    
</script>
</html>
