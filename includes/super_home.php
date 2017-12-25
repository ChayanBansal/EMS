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
        margin-bottom: 100px;
    }
    .modal-container{
        width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    }
   
    .sub-option{
        margin-top: 5px;
        display: none;
        width: 100%;
        background: orangered;
        justify-content: space-around;
        color: white;
        border: 1px solid white;
        transition: all 300ms;
    }
    .option{
        padding: 20px;
        padding-right: 40px;
        padding-left: 40px;
        margin: 20px;
        width: 100% !important;
        display: flex;
        flex-wrap: wrap;
        color: white;
        font-size: 2rem;
        flex-direction: column;
        align-items: center;
        font-family: 'PT Sans', sans-serif;
    }
    .sub-option button{
        border: none;
        width: 40%;
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
$obj = new head();
$obj->displayheader();
$obj->dispmenu(3, ["/ems/includes/home.php", "/ems/includes/index.php", "/ems/includes/developers.php"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
$dashboard = new dashboard();
$dashboard->display_super_dashboard($_SESSION['super_admin_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "");
$options = new super_user_options();
$options->create_course($conn);
$options->add_subject($conn);
$options->create_operator($conn);
?>
    <div class="main-container col-md-12">
    <div class="sub-container col-lg-4 col-md-8 col-sm-12 col-xs-12">
        <div class="option red" onmouseover="show('subopt1')" onmouseout="hide('subopt1')">
            <div><i class="glyphicon glyphicon-user"></i></div>
            <div>Operators</div>
            <div class="sub-option" id="subopt1">
            <button data-toggle="modal" data-target="#cr_op_modal"><i class="glyphicon glyphicon-plus"></i> Add</button>
                <button data-toggle="modal" data-target="#view_op_modal"><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
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
            <div><i class="glyphicon glyphicon-retweet"></i></div>
            <div>Marks Processing</div>
            <div class="sub-option" id="subopt3">
                <button><i class="glyphicon glyphicon-copy"></i> Generate TR</button>
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
            <div><i class="glyphicon glyphicon-user"></i></div>
            <div>Sessions</div>
            <div class="sub-option" id="subopt5">
            <button data-toggle="modal" data-target="#cr_op_modal"><i class="glyphicon glyphicon-plus"></i> Add</button>
            <button data-toggle="modal" data-target="#view_op_modal"><i class="glyphicon glyphicon-pencil"></i> View/Edit</button>
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

  <!---->
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
               $get_components_qry="SELECT * from component";
               $get_components_qry_run=mysqli_query($conn,$get_components_qry);
               if($get_components_qry_run){
                   while($row=mysqli_fetch_assoc($get_components_qry_run)){
                       echo('
                       <tr>
                       <td>'.$row['component_name'].'</td>
                       <td>');
                           $input->display("","form-control input-sm","number","pass".$row['component_id'],"",1);
                           echo('
                       </td>
                       <td>');
                           
                           $input->display("","form-control input-sm","number","max".$row['component_id'],"",1);
                           echo('</td>
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
            $get_course_qry="SELECT * from courses";
            $get_course_qry_run=mysqli_query($conn,$get_course_qry);
            if($get_course_qry_run){
                while($row=mysqli_fetch_assoc($get_course_qry_run)){
                    echo('
                    <option value="'.$row['course_id'].'" data-course-duration='.$row['duration'].'>'.$row['course_name'].'</option>   
                    ');
                }
            }
            else{
                $alert=new alert();
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
            <span class="input-group-addon" onclick="subtract()"><i class="glyphicon glyphicon-minus"></i></span>
            <input type="number" name="number_subjects" class="form-control" placeholder="Number of subjects" id="no_subjects" onkeyup="display_subjects('down')">
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
    ?>
</body>
<script>
    function show(el){
        document.getElementById(el).style.display="flex";
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
    function show_semester(){
        var sel = document.getElementById("mcourse");
        var duration = sel.options[sel.selectedIndex].getAttribute("data-course-duration");
        var sem=document.getElementById("msemester");
        sem.innerHTML=`<option disabled selected>Select semester</option> `;
        for(var i=1;i<=duration;i++){
            sem.innerHTML+=`
            <option value="`+i+`">`+i+`</option>
            `;
        }
    }
    function display_subjects(direction){
        var val=document.getElementById("no_subjects").value;
        var table=document.getElementById("subject_area");
        table.innerHTML="";
        if(isNaN(val)){
            table.innerHTML="Add a subject to insert";
        }
        else{
                        for(var i=1;i<=val;i++){
                        table.innerHTML+=`
                        <tr>
                <td>
                <input type="text" name="subcode`+i+`" id="subcode`+i+`" class="form-control" required>
                </td>
                <td>
                <input type="text" name="subname`+i+`" id="subname`+i+`" class="form-control" required>
                </td>
                <td>
                <select name="type`+i+`" id="type`+i+`" class="form-control" onchange="check_credits(this,`+i+`)">            
                <option value="theory">Theory</option>
                    <option value="practical">Practical</option>
                <option value="both" selected>Both</option>         
                    </select>
                </td>
                
                <td>
                <input type="number" name="theory`+i+`" id="theory`+i+`" class="form-control" onkeyup="total(`+i+`)" value=0 required>
                </td>
                <td>
                <input type="number" name="practical`+i+`" id="practical`+i+`" class="form-control" onkeyup="total(`+i+`)" value=0 required> 
                </td>
                <td><input id="total`+i+`" name="total`+i+`" class="form-control disabled" readonly type="number"></td>
                <td style="text-align: center">
                <input type="checkbox" name="ie`+i+`" id="ie`+i+`" class="form-control" onchange="disable_credits(this,`+i+`)">
                </td>
                        `;
                    }
        }
       
    }
    function total(no){
        var theory=parseInt(document.getElementById("theory"+no).value);
        var practical=parseInt(document.getElementById("practical"+no).value);
        document.getElementById("total"+no).value=theory+practical;
    }
    function disable_credits(el,no){
        var practical=document.getElementById("practical"+no);
        var theory=document.getElementById("theory"+no);

        if(el.checked){   
        practical.classList.add("disabled");
            practical.required=false;
            practical.disabled=true;
            theory.classList.add("disabled");
            theory.required=false;
            theory.disabled=true;
            theory.value=0;
            practical.value=0;
        }
        else{
            
        practical.classList.remove("disabled");
            practical.required=true;
            practical.disabled=false;
            theory.classList.remove("disabled");
            theory.required=true;
            theory.disabled=false;
        }
       }
    function check_credits(el,no){
        var typename = el.options[el.selectedIndex].value;
        console.log(typename);
        var practical=document.getElementById("practical"+no);
        var theory=document.getElementById("theory"+no);
        switch (typename) {
            case 'theory':
            practical.classList.add("disabled");
            practical.required=false;
            practical.disabled=true;
            theory.classList.remove("disabled");
            theory.required=true;
            theory.disabled=false;
            practical.value=0;
            break;
            case 'practical':
            theory.classList.add("disabled");
            theory.required=false;
            theory.disabled=true;
            practical.classList.remove("disabled");
            practical.required=true;
            practical.disabled=false;
            theory.value=0;
            break;
            case 'both':
            theory.classList.remove("disabled");
            theory.required=true;
            theory.disabled=false;
            practical.classList.remove("disabled");
            practical.required=true;
            practical.disabled=false;
            break;
        }
    }
</script>

</html>
