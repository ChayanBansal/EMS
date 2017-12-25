<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Options</title>
    <link rel="stylesheet" href="/ems/css/style.css">
    <style>
        <script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
        <script language="JavaScript" type="text/javascript" src="/js/jquery-ui-personalized-1.5.2.packed.js"></script>
        <script language="JavaScript" type="text/javascript" src="/js/sprinkle.js"></script>




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
function getSemester(examType) {
	var batch=document.getElementById("batch_list").value
    $.ajax({
	type: "POST",
	url: "ajax_response.php",
	data: 'getSemester=1'+'&main_atkt='+examType+'&from_year='+batch+'&getType=0',
	success: function(data){
        $("#sem_list").html(data);
    },
    error: function(e){
        alert('Come back again');
    }
	});
}
function getType(batch){
    $.ajax({
	type: "POST",
	url: "ajax_response.php",
	data: 'from_year='+batch+'&getType=1&getSemester=0',
	success: function(data){
        $("#exam_type").html(data);
    },
    error: function(e){
        alert('Come back again');
    }
	});
}
function getSubject(semester)
{
    $.ajax({
	type: "POST",
	url: "ajax_response.php",
	data: 'getSubject=1'+'&semester='+semester+'&from_year='+batch+'&getType=0&getSemester=0',
	success: function(data){
        $("#exam_type").html(data);
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
        <button class="option blue " data-toggle="modal" data-target="#view_op_modal"><div><i class= "glyphicon glyphicon-eye-open" ></i></div> View Marks</button>       
        <button class="option green " data-toggle="modal" data-target="#view_op_modal"><div><i class= "glyphicon glyphicon-check" ></i></div> Check Marks</button>       
        <button class="option pink " data-toggle="modal" data-target="#view_op_modal"><div><i class= "glyphicon glyphicon-save-file" ></i></div> Generate Marksheet</button> 
    </div>
</div> 
 
 


<!-- Modal -->
<div id="feed_marks_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select from below:</h4>
      </div>
      <div class="modal-body">
        <div>
            <form action=".<?php echo($_SERVER['PHP_SELF']);?>." method="post">
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
                <div id="exam_type" class="radio" >
                <label for="main_atkt">Type : </label>
                    </div>
                </div>
                        
                <div class="form-group" style="display: flex; justify-content: center;">
                    <label for="semester">Semeter :</label>
                    <select id="sem_list" name="semester" class="btn-default">
                    </select>
                </div>  
                
                <div class="form-group" style="display: flex; justify-content: center;">
                    <label for="subject">Subject : </label>
                    <select id="sub_list" name="subject" class="btn-default">
                    </select>
                </div>
                <!--
                <div class="form-group" style="display: flex; justify-content: center;">
                    <label for="subject">Subject Component :</label>
                    <select id="sub_list" name="subject" class="btn-default">
                    
                    </select>
                </div>
                        -->                
                <div class="form-group" style="display: flex; justify-content: center;">
                    <label for="sub_comp">Subject Component :</label>
                    <select id="sub_component" name="sub_comp" class="btn-default">
                        <option value="Cat">Continuous Assessment (Theory)</option>
                        <option value="Cap">Continuous Assessment (Practical)</option>
                        <option value="endsem_theory">End Semester (Theory)</option>
                        <option value="endsem_practical">End Semester (Practical)</option>
                        <option value="ia">Industry Assessment (IA)</option>
                    </select>
                </div>            
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Proceed</button>
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
