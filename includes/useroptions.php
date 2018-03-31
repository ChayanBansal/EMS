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
        background-color: ;
        border-color: rgba(0, 50, 135,0.2) !important;
        border-radius: 3px;
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
        align-items:center;
        justify-content: center;
        padding: 20px;
        background-color: #f1f1f1;
        height: 570px;
        margin-top: 0;
        margin-bottom: 70px;
      }
      .chat_box{
        height:250px;
        overflow:auto;
      }
      .chayanraghav_block{
          display: flex;
      }

    </style>
</head>
<body onload="chat()">
<?php
session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");

$valid = new validate();
$valid->conf_logged_in();

require('../preloader/preload.php');
$obj = new head();
$obj->displayheader();

$obj->dispmenu(3, ["/ems/includes/home", "/ems/includes/logout", "/ems/includes/developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
$dashboard = new dashboard();
$dashboard->display($_SESSION['operator_name'], ["Sign Out"], ["change_password.php", "index.php"], "Contact Super Admin");

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
if (isset($_SESSION['tr_updated'])) {
    $alert = new alert();
    if ($_SESSION['tr_updated']) {
        $alert->exec("TR for Enrollment Number: " . $_SESSION['enrollment'] . " successfully updated!", "success");
    } else {
        $alert->exec("Unable to update TR!", "danger");
    }
    unset($_SESSION['tr_updated']);
    unset($_SESSION['enrollment']);
}
if (isset($_SESSION['tr_req_close'])) {
    $alert = new alert();
    if ($_SESSION['tr_req_close']) {
        $alert->exec("Request Closed", "info");
    } else {
        $alert->exec("Unable to close request!", "danger");
    }
    unset($_SESSION['tr_req_close']);
}

?>


<?php
/*$options=new useroptions();
$options->display($conn);
$options->check_opt();*/

?>
<script>

function getBatch(etype){
    $.ajax({
	type: "POST",
	url: "ajax_response",
	data: {
        "getBatch":1,
        "type":etype
    },
	success: function(data){
        $("#batch_list").html("<option selected disabled value=''>Select Batch</option>");          
        $("#batch_list").append(data);  
        $("#sem_list").html("<option selected disabled value=''>Select Semester</option>");
        $("#sub_list").html("<option selected disabled value=''>Select Subject</option>");
        $("#sub_component").html("<option selected disabled value=''>Select Component</option>");
        
    },
    error: function(e){
        alert('Come back again');
    }
	});
}    
function getSemester(batch) {
    var examType=$("#exam_type").val();
    $.ajax({
	type: "POST",
	url: "ajax_response",
	data: 'getSemester=1'+'&main_atkt='+examType+'&from_year='+batch,
	success: function(data){
        $("#sem_list").html("<option selected disabled value=''>Select Semester</option>");
        $("#sem_list").append(data);
        $("#sub_list").html("<option selected disabled value=''>Select Subject</option>");
        $("#sub_component").html("<option selected disabled value=''>Select Component</option>");
        
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
	data: 'getSubject=1'+'&semester='+semester+'&from_year='+batch+'&main_atkt='+main_atkt,
	success: function(data){
        $("#sub_list").html("<option selected disabled value=''>Select Subject</option>");
        $("#sub_list").append(data);
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
    var semester=document.getElementById("sem_list").value;
    $.ajax({
	type: "POST",
	url: "ajax_response",
	data: 'semester='+semester+'&from_year='+batch+'&main_atkt='+main_atkt+'&getComponent=1&sub_code='+sub_code,
	success: function(data){
        $("#sub_component").html("<option selected disabled value=''>Select Component</option>");
        $("#sub_component").append(data);
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

 function getTrViewBatch(resultid,type){
    tr_course_id=<?= $_SESSION['current_course_id'] ?>;
  $.ajax(
    {
      type: "POST",
      url: "select_tr",
      data: 'tr_getBatch=1&course_id='+tr_course_id+'&type='+type,
      success: function(data){
        $("#"+resultid).html("<option disabled selected value=''>Select Batch</option>");        
        $("#"+resultid).append(data);

    },
    error: function(e){
      $("#tr_semester").html("Unable to load recent activities");
    }
	});
 }
</script>
<!--ChatBox-->
<div style="background: red;display: block">
<div class="panel-group col-lg-3 col-md-4 col-sm-12 col-xs-12" id="accordion2" >
   <h3 style="margin-top:-5px"><center>Chat</center></h3>
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
</div>
    <!--ChatBoxEnd-->

<div class="main-container col-lg-8 col-md-8 col-sm-12 col-xs-12">
    <div class="sub-container col-lg-8 col-sm-12 col-md-12 col-xs-12">
    <div class="cr_container">
    <div class="tcaption">
    Please select a choice:</div>
    </div>
    <div>
    <div class="chayanraghav_block ">
        <button class="option chayanraghav_class_blue" data-toggle="modal" data-target="#feed_marks_modal"><div><i class="glyphicon glyphicon-pencil"></i></div> Feed Marks</button>
        <button class="option chayanraghav_class_blue" data-toggle="modal" data-target="#check_marks_modal"><div><i class= "glyphicon glyphicon-check" ></i></div> Check Marks</button>       
    </div>
    <div class="chayanraghav_block">
        <button class="option chayanraghav_class_blue" data-toggle="modal" data-target="#view_tr"><div><i class="glyphicon glyphicon-eye-open"></i></div> View TR</button>
        <button class="option chayanraghav_class_blue" data-toggle="modal" data-target="#print_tr"><div><i class="glyphicon glyphicon-print"></i></div> Print TR</button>
    </div>
    <div class="chayanraghav_block">
        <button class="option chayanraghav_class_blue" data-toggle="modal" data-target="#edit_tr_request"><div><i class= "glyphicon glyphicon-ok-circle" ></i></div> Edit TR Requests</button> 
        <button class="option chayanraghav_class_blue" data-toggle="modal" data-target="#gen_marksheet"><div><i class= "glyphicon glyphicon-save-file" ></i></div> Generate Marksheet</button> 
    </div>
    </div>
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
                <label for="semester">Type :</label>
                    <select id="exam_type" name="main_atkt" class="form-control" onChange="getBatch(this.value)" required>
                    <option value="" disabled selected>Select Type</option>
                    <option value="main">Main</option>
                    <option value="retotal">Retotalling</option>
                    <option value="reval">Revaluation</option>
                    <option value="atkt">ATKT</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="batch">Batch (Starting Year) :</label>
                    <select id="batch_list" name="batch" class="form-control" onChange="getSemester(this.value)" required>
                        <option value="" disabled selected>Select Batch</option>
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
                    <label>Type :</label>
                    <select id="tr_type_select" name="tr_type_print" class="form-control" required onchange="getTrViewBatch('tr_batch_list_print',this.value)">
                        <option value="" disabled selected>Select Type</option>
                        <option value="main">Main</option>
                        <option value="retotal">Retotaling</option>
                        <option value="reval">Revaluation</option>
                        <option value="atkt">ATKT</option>
                    </select>
                </div>
          <div class="form-group">
                <div class="form-group">
                    <label for="tr_batch">Batch (Starting Year) :   </label>
                    <select id="tr_batch_list_print" name="tr_print_batch" class="form-control" required onchange="tr_getSemester('','tr_semester_print',this.value)">
                        <option value="" disabled selected>Select Batch</option>
                        
                    </select>
                </div>
                    <label for="tr_semester">Semester: </label>
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
                    <label for="session_type">Type :</label>
                    <select id="tr_type_select" name="tr_type_select" class="form-control" required onchange="getTrViewBatch('tr_batch_list_view',this.value)">
                        <option value="" disabled selected>Select Type</option>
                        <option value="main">Main</option>
                        <option value="retotal">Retotaling</option>
                        <option value="reval">Revaluation</option>
                        <option value="atkt">ATKT</option>
                    </select>
                </div>
          <div class="form-group">
                <div class="form-group">
                    <label for="tr_batch">Batch (Starting Year) :</label>
                    <select id="tr_batch_list_view" name="tr_view_batch" class="form-control" required onchange="tr_getSemester('','tr_semester_view',this.value)">
                        <option value="" disabled selected>Select Batch</option>
                        
                    </select>
                </div>
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
        <h4 class="modal-title">Edit TR Requests</h4>
      </div>
      <div class="modal-body">
      <?php
        $get_requests = "SELECT `request_id`, `requester`, `roll_id`, s.`sub_code`, `remarks`, `status` FROM edit_tr_request etr,subjects s WHERE etr.ac_sub_code=s.ac_sub_code AND requester=" . $_SESSION['operator_id'] . " AND status!=3";
        $get_requests_run = mysqli_query($conn, $get_requests);
        echo ('<table class="table table-hover">
    <thead>
      <tr>
        <th>Enrollment No</th>
        <th>Subject Code</th>
        <th>Remark</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>');
        $err = new alert();

        if (!$get_requests_run) {
            echo ("<tr style='text-align:center;'><td colspan='4'>No requests to show!</td><tr>");
            $err->exec("Error fetching requests!", "danger");
        } else {
            if (mysqli_num_rows($get_requests_run) == 0) {
                $err->exec("No requests to show!", "info");
            }
            while ($edit_tr_requests = mysqli_fetch_assoc($get_requests_run)) {
            //$edit_tr_requests['request_id'] $edit_tr_requests['requester'] $edit_tr_requests['roll_id'] $edit_tr_requests['sub_code'] $edit_tr_requests['remarks'] $edit_tr_requests['status']
                $get_edit_enrol = "SELECT enrol_no FROM roll_list WHERE roll_id=" . $edit_tr_requests['roll_id'];
                $get_edit_enrol_run = mysqli_query($conn, $get_edit_enrol);
                $edit_enrol_no = mysqli_fetch_assoc($get_edit_enrol_run);
            //$edit_enrol_no['enrol_no']

                echo ('
        <tr>
            <td>' . $edit_enrol_no["enrol_no"] . '</td>
            <td>' . $edit_tr_requests['sub_code'] . '</td>
            <td>' . $edit_tr_requests['remarks'] . '</td>');

                switch ($edit_tr_requests['status']) {
                    case 0:
                        echo ('<td>Pending</td>');
                        break;
                    case 1:
                        echo ('<td>Approved<form action="tr_update" method="post"><button class="btn btn-info" type="submit" name="tr_edit_submit" value="' . $edit_tr_requests['request_id'] . '">Click here to process</button></form></td>');
                        break;
                    case 2:
                        echo ('<td>Disapproved<form action="tr_update" method="post"><button class="btn btn-info" type="submit" name="tr_edit_close" value="' . $edit_tr_requests['request_id'] . '">Click here to close</button></form></td>');
                        break;
                }

                echo ('</tr>');
            }
        }
        echo ('
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
      <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="tab" href="#tabs-checking-main">Main</a></li>
            <li><a data-toggle="tab" href="#tabs-checking-retotal">Retotalling</a></li>
            <li><a data-toggle="tab" href="#tabs-checking-reval">Revaluation</a></li>
            <li><a data-toggle="tab" href="#tabs-checking-atkt">ATKT</a></li>
            </ul>
            <div class="tab-content">  
              <div id="tabs-checking-main" class="tab-pane fade in active">
              
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
    $get_check_list = "SELECT A.*, T.operator_id,acs.*,s.sub_code FROM auditing A, transactions T, academic_sessions acs,subjects s WHERE A.transaction_id=T.transaction_id AND A.session_id=acs.ac_session_id AND  acs.course_id=" . $_SESSION['current_course_id'] . " AND A.type_flag=0 AND s.ac_sub_code=A.ac_sub_code";
    $get_check_list_run = mysqli_query($conn, $get_check_list);
    echo ('<form action="checking" method="post">');
    while ($check_list = mysqli_fetch_assoc($get_check_list_run)) {
        if ($check_list["check_id"] == null) {
            echo ('<tr class="danger">');
            echo ('<td>' . $check_list["from_year"] . '</td>');
            echo ('<td>' . $check_list["current_semester"] . '</td>');
            echo ('<td>MAIN</td>');
            echo ('<td>' . $check_list["sub_code"] . '</td>');
            $get_sub_name = "SELECT sub_name FROM subjects WHERE sub_code='" . $check_list['sub_code'] . "' AND ac_session_id=" . $check_list['ac_session_id'];
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
                            <button class="btn btn-default" name="check_button_main" type="submit" value=' . $check_list["transaction_id"] . '>
                            <div class="glyphicon glyphicon-check">
                            </div>
                            <div>Check Now</div>
                            </button>
                     </td>');
            echo ('</tr>');
        } else {
            echo ('<tr class="success">');
            echo ('<td>' . $check_list["from_year"] . '</td>');
            echo ('<td>' . $check_list["current_semester"] . '</td>');
            echo ('<td>MAIN</td>');
            echo ('<td>' . $check_list["sub_code"] . '</td>');
            $get_sub_name = "SELECT sub_name FROM subjects WHERE sub_code='" . $check_list['sub_code'] . "' AND ac_session_id=" . $check_list['ac_session_id'];
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
            echo ('<td style="text-align:center"><div class="glyphicon glyphicon-ok"></div><div>Already Checked</div></td>');
            echo ('</tr>');
        }
    }
    echo ('</form>');
    ?>
    </tbody>
  </table>
              </div>
              
              <div id="tabs-checking-retotal" class="tab-pane fade in">
              </div>
              
              <div id="tabs-checking-reval" class="tab-pane fade in">
              </div>
              
              <div id="tabs-checking-atkt" class="tab-pane fade in">
              
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
    $get_check_list = "SELECT A.*, T.operator_id,acs.*,s.sub_code FROM auditing A, transactions T, academic_sessions acs,subjects s WHERE A.transaction_id=T.transaction_id AND A.session_id=acs.ac_session_id AND  acs.course_id=" . $_SESSION['current_course_id'] . " AND A.type_flag=0 AND s.ac_sub_code=A.ac_sub_code";
    $get_check_list_run = mysqli_query($conn, $get_check_list);
    echo ('<form action="checking" method="post">');
    while ($check_list = mysqli_fetch_assoc($get_check_list_run)) {
        if ($check_list["check_id"] == null) {
            echo ('<tr class="danger">');
            echo ('<td>' . $check_list["from_year"] . '</td>');
            echo ('<td>' . $check_list["current_semester"] . '</td>');
            echo ('<td>MAIN</td>');
            echo ('<td>' . $check_list["sub_code"] . '</td>');
            $get_sub_name = "SELECT sub_name FROM subjects WHERE sub_code='" . $check_list['sub_code'] . "' AND ac_session_id=" . $check_list['ac_session_id'];
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
                            <button class="btn btn-default" name="check_button_atkt" type="submit" value=' . $check_list["transaction_id"] . '>
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
            echo ('<td>MAIN</td>');
            echo ('<td>' . $check_list["sub_code"] . '</td>');
            $get_sub_name = "SELECT sub_name FROM subjects WHERE sub_code='" . $check_list['sub_code'] . "' AND ac_session_id=" . $check_list['ac_session_id'];
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
            echo ('<td style="text-align:center"><div class="glyphicon glyphicon-ok"></div><div>Already Checked</div></td>');
            echo ('</tr>');
        }
    }
    echo ('</form>');
    ?>
    </tbody>
  </table>
              </div>
            </div>
              
     
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
function tr_getSemester(id,id2,batch)
{
  var tr_from_year=batch;
  var type=$("#tr_type_select").val();
  var tr_course_id=<?= $_SESSION['current_course_id'] ?>;
  $.ajax(
    {
      type: "POST",
      url: "select_tr",
      data: 'tr_getSemester=1&course_id='+tr_course_id+'&from_year='+batch+'&type='+type,
      success: function(data){
        $("#"+id2).html("<option disabled selected value=''>Select Semester</option>");
        $("#"+id2).append(data);
    },
    error: function(e){
      $("#tr_semester").html("Unable to load recent activities");
    }
	});
  }


</script>
</html>
