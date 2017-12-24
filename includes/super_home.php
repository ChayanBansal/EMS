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
            <button data-toggle="modal" data-target="#cr_op_modal"><i class="glyphicon glyphicon-plus"></i> Add</button>
                <button data-toggle="modal" data-target="#view_op_modal"><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
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
                <button data-toggle="modal" data-target="#addsubjectModal"><i class="glyphicon glyphicon-plus"></i> Add</button>
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
      <div class="modal-dialog modal-lg" style="width: 90%">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Subjects</h4>
          </div>
          <form action="" method="post">
            <div class="modal-body">
           
            <div class="feed-container">
    <table class="table table-striped table-responsive table-bordered">

   <caption class="form-inline">
        <div class="form-group">
            <select name="mcourse" id="" class="form-control">
            <option value="" disabled selected>Select a course</option>   
        </select>
        </div>
        <div class="form-group">
            <select name="msemester" id="" class="form-control">
            <option value="" disabled selected>Select semester</option>  
           </select>
        </div>
        <div class="form-group">
            <div class="input-group">
            <span class="input-group-addon" onclick="subtract()"><i class="glyphicon glyphicon-minus"></i></span>
            <input type="number" class="form-control" placeholder="Number of subjects" id="no_subjects" onkeyup="display_subjects('down')">
            <span class="input-group-addon" onclick="add()"><i class="glyphicon glyphicon-plus"></i></span>
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
            <button type="submit" class="btn btn-primary" name="course_submit">Submit</button>
        </div>
        </form> 
        </div>
        
      </div>
    </div>
    
  </div>


  
    	<!-- Create operator Modal Box-->
	<!-- Modal -->
  <div class="modal fade" id="cr_op_modal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <form action="<?php echo ($_SERVER['PHP_SELF']); ?>" method="post">
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
  
</div>
  </div>
  <!--End-->
  
  <!-- Modal Box for viewing operators-->
  <div id="view_op_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Operators</h4>
      </div>
      <div class="modal-body">
        <?php $v_op = new view_operators; $v_op->execute($conn);?>
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
    $cr_op = new create_operator();
    $cr_op->execute($conn);
    ?>
</body>
<script>
    function show(el){
        document.getElementById(el).style.display="block";
    }
    function hide(el){
        document.getElementById(el).style.display="none";
    }
    function add(){
        document.getElementById("no_subjects").value++;
        display_subjects('up');
    }
    function subtract(){
        if(document.getElementById("no_subjects").value>1)
        document.getElementById("no_subjects").value--;
        display_subjects('down');
    }
    function display_subjects(direction){
        var val=document.getElementById("no_subjects").value;
        var table=document.getElementById("subject_area");
        if(direction=="down"){
            table.innerHTML="";
        }
        if(isNaN(val)){
            table.innerHTML="Add a subject to insert";
        }
        else{
                        for(var i=1;i<=val;i++){
                        table.innerHTML+=`
                        <tr>
                <td><?php
                        $input->display_table("subcode", "form-control", "text", "subcode", "", 1, 0, 0, 0, 0);
                        ?></td>
                <td><?php
                        $input->display_table("subname", "form-control", "text", "subname", "", 1, 0, 0, 0, 0);
                        ?></td>
                <td>
                <select name="type" id="" class="form-control">
                            
                <option value="theory">Theory</option>
                    <option value="practical">Practical</option>
                <option value="both">Both</option>         
                    </select>
                </td>
                
                <td><?php
                        $input->display_table("theory", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
                        ?></td>
                    <td><?php
                        $input->display_table("practical", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
                        ?></td>
                <td><label for="" id="total" class="form-control disabled"></label></td>
                <td style="text-align: center"><?php
                            $input->display_table("ie", "form-control", "checkbox", "enrol", "", 1, 0, 0, 0, 0)
                        ?></td>
                        `;
                    }
        }
       
    }
</script>
</html>
