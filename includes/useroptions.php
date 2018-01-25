<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Options</title>
    <link rel="stylesheet" href="/ems/css/style.css">
    <style>
    #sem{
        margin: 10px;
        width: 40%;
    }
    .sem{
        width: 100%;
        display: flex;
        justify-content: center;
        text-align: center;
    }
    body{
        overflow: auto;
    }

    .main-container{
        animation: fadein 500ms ease-in-out 1;
        opacity: 0;
        animation-fill-mode: forwards;
        display: flex;
        width: 100%;
        justify-content: center;
        align-items: center;
        margin-bottom: 100px;
    }
    .modal-container{
        width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    }
    .option{
        padding: 20px;
        padding-right: 40px;
        padding-left: 40px;
        margin: 20px;
        display: flex;
        flex-wrap: wrap;
        color: white;
        font-size: 2rem;
        flex-direction: column;
        align-items: center;
        font-family: 'PT Sans', sans-serif;
        width: 100%;
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
    .sub-container{
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    @keyframes fadein{
        0%{
            opacity: 0;
        }
        100%{
            opacity: 1;
        }
    }
    input[type="checkbox"]{
        zoom: 0.8;
      }
      .disabled:hover{
          cursor: not-allowed;
      }
    form label{
        font-size: 1.6rem !important;
        font-weight: 500 !important;
    }
    table{
        font-size: 1.6rem !important;
    }
    input{
        font-size: 1.6rem !important;
    }
    select{
        font-size: 1.6rem !important;
    }
    table caption{
        text-align: center;
        margin: 5px;
    }
    caption select{
        margin: 5px;
    }
    #check_list{
        text-align: center;
    }
    th{
        text-align: center;
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
</head>
<body onload="chat()">
<?php
session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
require('../preloader/preload.php');
$valid = new validate();
$valid->conf_logged_in();
$obj = new head();
$obj->displayheader();

$obj->dispmenu(3, ["/ems/includes/home", "/ems/includes/logout", "/ems/includes/developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
$dashboard = new dashboard();
$dashboard->display($_SESSION['operator_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "Contact Super Admin");

/*Alert while coming from feed*/
if (isset($_SESSION['score_entered_success'])) {
    $alert = new alert();
    if ($_SESSION['score_entered_success'] == true) {
        $alert->exec("Score successfully inserted!", "success");
    } else {
        $alert->exec("Unable to insert marks! Please try again..", "danger");
    }
    unset($_SESSION['score_entered_success']);
}
if (isset($_SESSION['marks_entered_audit'])) {
    $alert = new alert();
    if ($_SESSION['marks_entered_audit'] == true) {
        $alert->exec("Marks for this component have already been entered!", "warning");
    }
    unset($_SESSION['marks_entered_audit']);
}
if (isset($_SESSION['already_checked'])) {
    $alert = new alert();
    if ($_SESSION['already_checked'] == true) {
        $alert->exec("Checking for this component has already been done!", "warning");
    }
    unset($_SESSION['already_checked']);
}

?>

<div class="cr_container">
<div class="tcaption">
Please select a choice:</div>
</div>
<?php
/*$options=new useroptions();
$options->display($conn);
$options->check_opt();*/

?>
<script>
function getType(batch){
    $.ajax({
	type: "POST",
	url: "ajax_response",
	data: 'from_year='+batch+'&getType=1&getSemester=0&getSubject=0&getComponent=0',
	success: function(data){
        $("#exam_type").html(data);
        $("#sem_list").html("<option value='' disabled>Select Semester</option>");
        $("#sub_list").html("<option value='' disabled>Select Subject</option>");
        $("#sub_component").html("<option value='' disabled>Select Component</option>");
    },
    error: function(e){
        alert('Come back again');
    }
	});
}
function getSemester(examType) {
	var batch=document.getElementById("batch_list").value;
    $.ajax({
	type: "POST",
	url: "ajax_response",
	data: 'getSemester=1'+'&main_atkt='+examType+'&from_year='+batch+'&getType=0&getSubject=0&getComponent=0',
	success: function(data){
        $("#sem_list").html(data);
        $("#sub_list").html("<option value='' disabled>Select Subject</option>");
        $("#sub_component").html("<option value='' disabled>Select Component</option>");
    },
    error: function(e){
        alert('Come back again');
    }
	});
}

function getSubject(semester)
{
    var batch=document.getElementById("batch_list").value;
    var main_atkt=document.getElementById("exam_type").value;
    $.ajax({
	type: "POST",
	url: "ajax_response",
	data: 'getSubject=1'+'&semester='+semester+'&from_year='+batch+'&main_atkt='+main_atkt+'&getType=0&getSemester=0&getComponent=0',
	success: function(data){
        $("#sub_list").html(data);
        $("#sub_component").html("<option value='' disabled>Select Component</option>");
    },
    error: function(e){
        alert('Come back again');
    }
	});
}

function getComponent(sub_code)
{
    var batch=document.getElementById("batch_list").value;
    var main_atkt=document.getElementById("exam_type").value;
    var semester=document.getElementById("sub_list").value;
    $.ajax({
	type: "POST",
	url: "ajax_response",
	data: 'getSubject=0'+'&semester='+semester+'&from_year='+batch+'&main_atkt='+main_atkt+'&getType=0&getComponent=1&getSemester=0'+'&sub_code='+sub_code,
	success: function(data){
        $("#sub_component").html(data);
    },
    error: function(e){
        alert('Come back again');
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
        window.setTimeout(function(){
            chat(location,username)
            },5000);
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
    document.getElementById(username).value='';
    },
    error: function(e){
      $(document.getElementById(location)).html("Unable to load recent activities");
    }
	});
  }


</script>
<!--ChatBox-->
<div class="panel-group col-lg-3 col-md-4 col-sm-12 col-xs-12" id="accordion2" >
   <h3><center>Chat</center></h3>
   <?php 
    $get_users = "SELECT CONCAT('s',super_admin_id) AS id, super_admin_username AS username, super_admin_name AS name FROM super_admin UNION
    SELECT CONCAT('o',operator_id) As id, operator_username AS username, operator_name AS name FROM operators";
    $get_users_run = mysqli_query($conn, $get_users);
    while ($user = mysqli_fetch_assoc($get_users_run)) {
        $location = "l" . $user['id'];
        echo ('<div class="panel panel-default" >
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
              

              /*$("#' . $location . '").animate({
                scrollTop: $("#' . $location . '").offset().top
             }, "slow");*/
            
             
            </script>
           ');/*document.getElementById("b'.$user['username'].'").addEventListener("click", function(){ chat("'.$location.'","'.$user['username'].'"); });
           chat("'.$location.'","'.$user['username'].'");*/
    }
    //echo('<script>setInterval(chat(),3000);</script>');

    ?>  
</div>
    <!--ChatBoxEnd-->

<div class="main-container col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="sub-container col-lg-8 col-sm-12 col-md-12 col-xs-12">
        <button class="option red " data-toggle="modal" data-target="#feed_marks_modal"><div><i class="glyphicon glyphicon-pencil"></i></div> Feed Marks</button>
        <button class="option green " data-toggle="modal" data-target="#check_marks_modal"><div><i class= "glyphicon glyphicon-check" ></i></div> Check Marks</button>       
        <button class="option blue" data-toggle="modal" data-target="#view_tr"><div><i class="glyphicon glyphicon-eye-open"></i></div> View TR</button>
        <button class="option yellow" data-toggle="modal" data-target="#print_tr"><div><i class="glyphicon glyphicon-print"></i></div> Print TR</button>
        <button class="option dark_red" data-toggle="modal" data-target="#edit_tr_request"><div><i class= "glyphicon glyphicon-ok-circle" ></i></div> Edit TR Requests</button> 
        <button class="option pink" data-toggle="modal" data-target="#gen_marksheet"><div><i class= "glyphicon glyphicon-save-file" ></i></div> Generate Marksheet</button> 
    </div>
</div> 

<!-- Modal -->
<div id="feed_marks_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <form action="feed" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select from below:</h4>
      </div>
      <div class="modal-body">
        <div>
                <div class="form-group">
                    <label for="batch">Batch (Starting Year) :</label>
                    <select id="batch_list" name="batch" class="form-control" onChange="getType(this.value)" required>
                        <option value="" disabled selected>Select Batch</option>
                        <?php 
                        $get_batch = "SELECT from_year FROM academic_sessions WHERE course_id=" . $_SESSION['current_course_id'];
                        $get_batch_run = mysqli_query($conn, $get_batch);
                        while ($batches = mysqli_fetch_assoc($get_batch_run)) {
                            echo ('<option value="' . $batches['from_year'] . '">' . $batches['from_year'] . '</option>');
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                <label for="semester">Type :</label>
                    <select id="exam_type" name="main_atkt" class="form-control" onChange="getSemester(this.value)" required>
                    <option value="" disabled selected>Select Type</option>
                    </select>
                </div>
                        
                <div class="form-group">
                    <label for="semester">Semester :</label>
                    <select id="sem_list" name="semester" class="form-control" onChange="getSubject(this.value)" required>
                    <option value="" disabled selected>Select Semester</option>
                    </select>
                </div>  
                
                <div class="form-group">
                    <label for="subject">Subject : </label>
                    <select id="sub_list" name="subject" class="form-control" onChange="getComponent(this.value)" required>
                    <option value="" disabled selected>Select Subject</option>
                    </select>
                </div>
                          
                <div class="form-group">
                    <label for="sub_comp">Subject Component :</label>
                    <select id="sub_component" name="sub_comp" class="form-control" required>
                    <option value="" disabled selected>Select Component</option>
                    </select>
                </div>            
            
        </div>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-success" name="proceed_to_feed" value="Proceed" >
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </form>
  </div>
</div>


<!-- Generate Marksheet Start-->

<!-- Modal -->
<div id="gen_marksheet" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="printing" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style="color:black">&times;</span></button>
        <h4 class="modal-title">Generate Marksheet</h4>
      </div>
      <div class="modal-body">
                <div class="form-group">
                    <label for="tr_batch">Batch (Starting Year) :</label>
                    <select id="tr_batch_list" name="print_batch" class="form-control" required>
                        <option value="" disabled selected>Select Batch</option>
                        <?php
                    $get_from_year = "SELECT DISTINCT(from_year) FROM students WHERE course_id=" . $_SESSION['current_course_id'] . " AND enrol_no IN 
                    (SELECT enrol_no FROM roll_list WHERE roll_id IN
                    (SELECT DISTINCT(roll_id) FROM tr))";
                    $get_from_year_run = mysqli_query($conn, $get_from_year);
                    while ($from_year = mysqli_fetch_assoc($get_from_year_run)) {
                        echo ('<option value="' . $from_year['from_year'] . '">' . $from_year['from_year'] . '</option>');
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tr_type">Type :</label>
                    <select id="tr_type" name="print_type" class="form-control" required onChange="tr_getSemester('tr_batch_list','tr_semester',this.value)">
                        <option value="" disabled selected>Select Type</option>
                        <option value="main">Main</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tr_semester">Semester: </label>
                    <select id="tr_semester" name="print_semester" class="form-control" required>
                        <option value="" disabled selected>Semester</option>                       
                    </select>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name="print_proceed">Proceed</button>
      </div>
         </form>
    </div>

  </div>
</div>
<!-- Generate Marksheet Close-->


<!-- Print TR Start-->

<!-- Modal -->
<div id="print_tr" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="print_tr" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style="color:black">&times;</span></button>
        <h4 class="modal-title">Print TR</h4>
      </div>
      <div class="modal-body">
                <div class="form-group">
                    <label for="tr_batch">Batch (Starting Year) :</label>
                    <select id="tr_batch_list_print" name="tr_print_batch" class="form-control" required>
                        <option value="" disabled selected>Select Batch</option>
                        <?php
                    $get_from_year = "SELECT DISTINCT(from_year) FROM students WHERE course_id=" . $_SESSION['current_course_id'] . " AND enrol_no IN 
                    (SELECT enrol_no FROM roll_list WHERE roll_id IN
                    (SELECT DISTINCT(roll_id) FROM tr))";
                    $get_from_year_run = mysqli_query($conn, $get_from_year);
                    while ($from_year = mysqli_fetch_assoc($get_from_year_run)) {
                        echo ('<option value="' . $from_year['from_year'] . '">' . $from_year['from_year'] . '</option>');
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tr_type">Type :</label>
                    <select id="tr_type" name="tr_print_type" class="form-control" required onChange="tr_getSemester('tr_batch_list_print','tr_semester_print',this.value)">
                        <option value="" disabled selected>Select Type</option>
                        <option value="main">Main</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tr_semester_print">Semester: </label>
                    <select id="tr_semester_print" name="tr_print_semester" class="form-control" required>
                        <option value="" disabled selected>Semester</option>                       
                    </select>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name="tr_print_proceed">Proceed</button>
      </div>
         </form>
    </div>

  </div>
</div>
<!-- Print TR Close-->

<!-- View TR Start-->

<!-- Modal -->
<div id="view_tr" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="view_tr_op" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span style="color:black">&times;</span></button>
        <h4 class="modal-title">View TR</h4>
      </div>
      <div class="modal-body">
                <div class="form-group">
                    <label for="tr_batch">Batch (Starting Year) :</label>
                    <select id="tr_batch_list_view" name="tr_view_batch" class="form-control" required>
                        <option value="" disabled selected>Select Batch</option>
                        <?php
                    $get_from_year = "SELECT DISTINCT(from_year) FROM students WHERE course_id=" . $_SESSION['current_course_id'] . " AND enrol_no IN 
                    (SELECT enrol_no FROM roll_list WHERE roll_id IN
                    (SELECT DISTINCT(roll_id) FROM tr))";
                    $get_from_year_run = mysqli_query($conn, $get_from_year);
                    while ($from_year = mysqli_fetch_assoc($get_from_year_run)) {
                        echo ('<option value="' . $from_year['from_year'] . '">' . $from_year['from_year'] . '</option>');
                    }
                    ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tr_type">Type :</label>
                    <select id="tr_type" name="tr_view_type" class="form-control" required onChange="tr_getSemester('tr_batch_list_view','tr_semester_view',this.value)">
                        <option value="" disabled selected>Select Type</option>
                        <option value="main">Main</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tr_semester">Semester: </label>
                    <select id="tr_semester_view" name="tr_view_semester" class="form-control" required>
                        <option value="" disabled selected>Semester</option>                       
                    </select>
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success" name="tr_view_proceed">Proceed</button>
      </div>
         </form>
    </div>

  </div>
</div>
<!-- View TR Close-->

<!-- Edit TR Request Status Modal -->
<div id="edit_tr_request" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
      <?php
        $get_requests="SELECT `request_id`, `requester`, `roll_id`, `sub_code`, `remarks`, `status` FROM edit_tr_request WHERE requester=".$_SESSION['operator_id']." AND status!=3";
        $get_requests_run=mysqli_query($conn,$get_requests);
        echo('<table class="table table-hover">
    <thead>
      <tr>
        <th>Enrollment No</th>
        <th>Subject Code</th>
        <th>Remark</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>');
        while($edit_tr_requests=mysqli_fetch_assoc($get_requests_run))
        {
        //$edit_tr_requests['request_id'] $edit_tr_requests['requester'] $edit_tr_requests['roll_id'] $edit_tr_requests['sub_code'] $edit_tr_requests['remarks'] $edit_tr_requests['status']
        $get_edit_enrol="SELECT enrol_no FROM roll_list WHERE roll_id=".$edit_tr_requests['roll_id'];
        $get_edit_enrol_run=mysqli_query($conn,$get_edit_enrol);
        $edit_enrol_no=mysqli_fetch_assoc($get_edit_enrol_run);
        //$edit_enrol_no['enrol_no']
        
    echo('
      <tr>
        <td>'.$edit_enrol_no["enrol_no"].'</td>
        <td>'.$edit_tr_requests['sub_code'].'</td>
        <td>'.$edit_tr_requests['remarks'].'</td>');
        
        switch($edit_tr_requests['status'])
        {
            case 0:
                echo('<td>Pending</td>');
                break;
            case 1:
                echo('<td>Approved<form action="tr_update" method="post"><button class="btn btn-info" type="submit" name="tr_edit_submit" value="'.$edit_tr_requests['request_id'].'">Click here to process</button></form></td>');
                break;
            case 2:
                echo('<td>Disapproved<form action="tr_update" method="post"><button class="btn btn-info" type="submit" name="tr_edit_close" value="'.$edit_tr_requests['request_id'].'">Click here to close</button></form></td>');
                break;
        }

      echo('</tr>');
    }
      echo('
    </tbody>
  </table>');
      ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Edit TR Request Status Modal Close -->


<!-- Check Marks Modal Box -->
<div id="check_marks_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg" style="width:95%">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Marks Verification And Approval</h4>
      </div>
      <div class="modal-body table-responsive">
      <table id="check_list" class="table table-hover">
      <caption> <input class="form-control" id="searchbar_modal_checking" type="text" placeholder="Search table by any parameter...."></caption>
    <thead>
      <tr>
        <th>Batch<br>(FROM YEAR)</th>
        <th>Semester</th>
        <th>Type</th>
        <th>Subject Code</th>
        <th>Subject Name</th>
        <th>Component Name</th>
        <th>Operator</th>
        <th>Operator's Remark</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody style="overflow: auto;" id="checking_modal">
    <?php
    $get_check_list = "SELECT A.*, T.operator_id FROM auditing A, transactions T WHERE A.transaction_id=T.transaction_id AND A.course_id=" . $_SESSION['current_course_id'];
    $get_check_list_run = mysqli_query($conn, $get_check_list);
    echo ('<form action="checking" method="post">');
    while ($check_list = mysqli_fetch_assoc($get_check_list_run)) {
        if ($check_list["check_id"] == null) {
            echo ('<tr class="danger">');
            echo ('<td>' . $check_list["from_year"] . '</td>');
            echo ('<td>' . $check_list["semester"] . '</td>');
            if ($check_list["atkt_flag"] == 0) {
                echo ('<td>MAIN</td>');
            } else {
                echo ('<td>ATKT</td>');
            }
            echo ('<td>' . $check_list["sub_code"] . '</td>');
            $get_sub_name = "SELECT sub_name FROM subjects WHERE sub_code='" . $check_list['sub_code'] . "'";
            $get_sub_name_run = mysqli_query($conn, $get_sub_name);
            $result_sub_name = mysqli_fetch_assoc($get_sub_name_run);
            echo ('<td>' . $result_sub_name['sub_name'] . '</td>');

            $get_component_name = "SELECT component_name FROM component WHERE component_id=" . $check_list['component_id'];
            $get_component_name_run = mysqli_query($conn, $get_component_name);
            $result_component_name = mysqli_fetch_assoc($get_component_name_run);
            echo ('<td>' . $result_component_name['component_name'] . '</td>');

            $get_operator_name = "SELECT operator_name FROM operators WHERE operator_id=" . $check_list['operator_id'];
            $get_operator_name_run = mysqli_query($conn, $get_operator_name);
            $result_operator_name_run = mysqli_fetch_assoc($get_operator_name_run);
            echo ('<td>' . $result_operator_name_run['operator_name'] . '</td>');

            $get_remark = "SELECT remark FROM transactions WHERE transaction_id=" . $check_list['transaction_id'];
            $get_remark_run = mysqli_query($conn, $get_remark);
            $result_remark = mysqli_fetch_assoc($get_remark_run);
            echo ('<td>' . $result_remark['remark'] . '</td>');
            echo ('<td style="text-align:center">
                            <button class="btn btn-default" name="check_button" type="submit" value=' . $check_list["transaction_id"] . '>
                            <div class="glyphicon glyphicon-check">
                            </div>
                            <div>Check Now</div>
                            </button>
                     </td>');
            echo ('</tr>');
        } else {
            echo ('<tr class="success">');
            echo ('<td>' . $check_list["from_year"] . '</td>');
            echo ('<td>' . $check_list["semester"] . '</td>');
            if ($check_list["atkt_flag"] == 0) {
                echo ('<td>MAIN</td>');
            } else {
                echo ('<td>ATKT</td>');
            }
            echo ('<td>' . $check_list["sub_code"] . '</td>');
            $get_sub_name = "SELECT sub_name FROM subjects WHERE sub_code='" . $check_list['sub_code'] . "'";
            $get_sub_name_run = mysqli_query($conn, $get_sub_name);
            $result_sub_name = mysqli_fetch_assoc($get_sub_name_run);
            echo ('<td>' . $result_sub_name['sub_name'] . '</td>');

            $get_component_name = "SELECT component_name FROM component WHERE component_id=" . $check_list['component_id'];
            $get_component_name_run = mysqli_query($conn, $get_component_name);
            $result_component_name = mysqli_fetch_assoc($get_component_name_run);
            echo ('<td>' . $result_component_name['component_name'] . '</td>');

            $get_operator_name = "SELECT operator_name FROM operators WHERE operator_id=" . $check_list['operator_id'];
            $get_operator_name_run = mysqli_query($conn, $get_operator_name);
            $result_operator_name_run = mysqli_fetch_assoc($get_operator_name_run);
            echo ('<td>' . $result_operator_name_run['operator_name'] . '</td>');

            $get_remark = "SELECT remark FROM transactions WHERE transaction_id=" . $check_list['transaction_id'];
            $get_remark_run = mysqli_query($conn, $get_remark);
            $result_remark = mysqli_fetch_assoc($get_remark_run);
            echo ('<td>' . $result_remark['remark'] . '</td>');
            /*echo ('<td>' . $check_list["sub_code"] . '</td>');
            echo ('<td>' . $check_list["component_name"] . '</td>');
            echo ('<td>' . $check_list["sub_name"] . '</td>');
            echo ('<td>' . $check_list["operator_name"] . '</td>');
            echo ('<td>' . $check_list["remark"] . '</td>');*/
            echo ('<td style="text-align:center"><div class="glyphicon glyphicon-ok"></div><div>Already Checked</div></td>');
            echo ('</tr>');
        }
    }
    echo ('</form>');
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



<?php
$obj = new footer();
$obj->disp_footer();
$logout_modal = new modals();
$logout_modal->display_logout_modal();
?>

</body>
<script>
     $(document).ready(function(){
  $("#searchbar_modal_checking").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#checking_modal tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
function tr_getSemester(id,id2,tr_type)
{
  tr_from_year=document.getElementById(id).value;
  tr_course_id=<?=$_SESSION['current_course_id']?>;
  $.ajax(
    {
      type: "POST",
      url: "select_tr",
      data: 'tr_getSemester=1&tr_getFromYear=0&course_id='+tr_course_id+'&from_year='+tr_from_year+'&type='+tr_type,
      success: function(data){
        $("#"+id2).html(data);
    },
    error: function(e){
      $("#tr_semester").html("Unable to load recent activities");
    }
	});
  }

</script>
</html>
