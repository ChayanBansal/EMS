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
$valid=new validate();
$valid->conf_logged_in();
$obj=new head();
$obj->displayheader();
$obj->dispmenu(3,["home.php","index.php","developers.php"],["glyphicon glyphicon-home","glyphicon glyphicon-log-out","glyphicon glyphicon-info-sign"],["Home","Log Out","About Us"]);
$dashboard=new dashboard();
$dashboard->display($_SESSION['operator_name'],["Change Password","Sign Out"],["change_password.php","index.php"],"Contact Super Admin");
/*Alert while coming from feed*/
if(isset($_SESSION['score_entered_success'])){
    $alert=new alert();
    if($_SESSION['score_entered_success']==TRUE){
        $alert->exec("Score successfully inserted!","success");
    }else{
        $alert->exec("Unable to insert marks! Please try again..","danger");
    }
    unset($_SESSION['score_entered_success']);
}
if(isset($_SESSION['marks_entered_audit'])){
    $alert=new alert();
    if($_SESSION['marks_entered_audit']==TRUE){
        $alert->exec("Marks for this component have already been entered!","warning");
    }
    unset($_SESSION['marks_entered_audit']);
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
	url: "ajax_response.php",
	data: 'from_year='+batch+'&getType=1&getSemester=0&getSubject=0&getComponent=0',
	success: function(data){
        $("#exam_type").html(data);
        $("#sem_list").html("<option value=''>Select Semester</option>");
        $("#sub_list").html(" <option value=''>Select Subject</option>");
        $("#sub_component").html("<option value=''>Select Component</option>");
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
	url: "ajax_response.php",
	data: 'getSemester=1'+'&main_atkt='+examType+'&from_year='+batch+'&getType=0&getSubject=0&getComponent=0',
	success: function(data){
        $("#sem_list").html(data);
        $("#sub_list").html(" <option value=''>Select Subject</option>");
        $("#sub_component").html("<option value=''>Select Component</option>");
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
	url: "ajax_response.php",
	data: 'getSubject=1'+'&semester='+semester+'&from_year='+batch+'&main_atkt='+main_atkt+'&getType=0&getSemester=0&getComponent=0',
	success: function(data){
        $("#sub_list").html(data);
        $("#sub_component").html("<option value=''>Select Component</option>");
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
	url: "ajax_response.php",
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
    <div class="sub-container">
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
    <form action="feed.php" method="post">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select from below:</h4>
      </div>
      <div class="modal-body">
        <div>
            
                <div class="form-group" style="display: flex; justify-content: center;">
                    <label for="batch">Batch (Starting Year) :</label>
                    <select id="batch_list" name="batch" class="btn-default" onChange="getType(this.value)" >
                        <option value="">Select Batch</option>
                        <?php 
                            $get_batch="SELECT DISTINCT(from_year), to_year FROM students WHERE course_id=".$_SESSION['current_course_id'];
                            $get_batch_run=mysqli_query($conn,$get_batch);
                            while($batches=mysqli_fetch_assoc($get_batch_run))
                            {
                                echo('<option value="'.$batches['from_year'].'">'.$batches['from_year'].'-'.$batches['to_year'].'</option>');
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group" style="display: flex; justify-content: center;">
                <label for="semester">Type :</label>
                    <select id="exam_type" name="main_atkt" class="btn-default" onChange="getSemester(this.value)">
                    <option value="">Select Type</option>
                    </select>
                </div>
                        
                <div class="form-group" style="display: flex; justify-content: center;">
                    <label for="semester">Semeter :</label>
                    <select id="sem_list" name="semester" class="btn-default" onChange="getSubject(this.value)">
                    <option value="">Select Semester</option>
                    </select>
                </div>  
                
                <div class="form-group" style="display: flex; justify-content: center;">
                    <label for="subject">Subject : </label>
                    <select id="sub_list" name="subject" class="btn-default" onChange="getComponent(this.value)">
                    <option value="">Select Subject</option>
                    </select>
                </div>
                          
                <div class="form-group" style="display: flex; justify-content: center;">
                    <label for="sub_comp">Subject Component :</label>
                    <select id="sub_component" name="sub_comp" class="btn-default">
                    <option value="">Select Component</option>
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
      <div class="modal-body">
      <table id="check_list" class="table">
    <thead>
      <tr>
        <th>Batch<br>(FROM YEAR)</th>
        <th>Semester</th>
        <th>Subject Code</th>
        <th>Subject Name</th>
        <th>Component Name</th>
        <th>Operator</th>
        <th>Operator's Remark</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody style="overflow: auto;">
    <?php
    $get_check_list="SELECT A.*, S.sub_name, C.component_name, O.operator_name, T.remark FROM auditing A, subjects S, component C, transactions T, operators O WHERE S.sub_code=A.sub_code AND T.operator_id=O.operator_id AND A.component_id=C.component_id AND A.course_id=".$_SESSION['current_course_id'];
    $get_check_list_run=mysqli_query($conn,$get_check_list);
    while($check_list=mysqli_fetch_assoc($get_check_list_run))
    {
        if($check_list["check_id"]==NULL)
        {
            echo('<tr class="warning">');
                echo('<td>'.$check_list["from_year"].'</td>');
                echo('<td>'.$check_list["semester"].'</td>');
                echo('<td>'.$check_list["sub_code"].'</td>');
                echo('<td>'.$check_list["sub_name"].'</td>');
                echo('<td>'.$check_list["component_name"].'</td>');
                echo('<td>'.$check_list["operator_name"].'</td>');
                echo('<td>'.$check_list["remark"].'</td>');
                echo('<td style="text-align:center">
                        <form action="'.htmlspecialchars("checking.php").'">
                            <button name="check_button" type="submit" value='.$check_list["transaction_id"].'>
                            <div class="glyphicon glyphicon-check">
                            </div>
                            <div>Check Now</div>
                            </button>
                        </form>
                     </td>');
            echo('</tr>');
        }
        else
        {
            echo('<tr class="success">');
                echo('<td>'.$check_list["from_year"].'</td>');
                echo('<td>'.$check_list["semester"].'</td>');
                echo('<td>'.$check_list["sub_code"].'</td>');
                echo('<td>'.$check_list["component_name"].'</td>');
                echo('<td>'.$check_list["sub_name"].'</td>');
                echo('<td>'.$check_list["operator_name"].'</td>');
                echo('<td>'.$check_list["remark"].'</td>');
                echo('<td style="text-align:center"><div class="glyphicon glyphicon-ok"></div><div>Already Checked</div></td>');
            echo('</tr>');
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



<?php
        $obj=new footer();
        $obj->disp_footer();
    ?>
</body>
</html>
