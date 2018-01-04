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

    </style>
</head>
<body>
<?php
session_start();
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$valid = new validate();
$valid->conf_logged_in();
$obj = new head();
$obj->displayheader();
$obj->dispmenu(3, ["/ems/includes/home.php", "/ems/includes/logout.php", "/ems/includes/developers.php"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
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
if(isset($_SESSION['already_checked']))
{
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
</script>

<div class="main-container col-md-12">
    <div class="sub-container col-lg-5 col-xs-12 col-sm-12 col-md-8">
        <button class="option red " data-toggle="modal" data-target="#feed_marks_modal"><div><i class="glyphicon glyphicon-pencil"></i></div> Feed Marks</button>
        <button class="option blue " data-toggle="modal" data-target=""><div><i class= "glyphicon glyphicon-eye-open" ></i></div> View Marks</button>       
        <button class="option green " data-toggle="modal" data-target="#check_marks_modal"><div><i class= "glyphicon glyphicon-check" ></i></div> Check Marks</button>       
        <button class="option pink " data-toggle="modal" data-target="#view_op_modal"><div><i class= "glyphicon glyphicon-save-file" ></i></div> Generate Marksheet</button> 
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
                        $get_batch = "SELECT DISTINCT(from_year) FROM academic_sessions WHERE course_id=" . $_SESSION['current_course_id'];
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
                    <label for="semester">Semeter :</label>
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
            if ($check_list["atkt_flag"]==0) {
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
</script>
</html>
