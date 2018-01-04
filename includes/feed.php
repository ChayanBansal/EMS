<!DOCTYPE html>
<?php
session_start();
if (isset($_POST['proceed_to_feed'])) {
    require('config.php');
    $_SESSION['from_year'] = $_POST['batch'];
    $_SESSION['main_atkt'] = $_POST['main_atkt'];
    $_SESSION['semester'] = $_POST['semester'];
    $_SESSION['sub_code'] = $_POST['subject'];
    $_SESSION['sub_comp_id'] = $_POST['sub_comp'];

    $check_exists_audit_qry = "SELECT count(*) as 'count' from auditing where from_year=" . $_SESSION['from_year'] . " AND course_id=" . $_SESSION['current_course_id'] . " AND semester=" . $_SESSION['semester'] . " AND component_id=" . $_SESSION['sub_comp_id'] . " AND sub_code='" . $_SESSION['sub_code'] . "'";
    $check_exists_audit_qry_run = mysqli_query($conn, $check_exists_audit_qry);
    if($check_exists_audit_qry_run){
        $count = mysqli_fetch_assoc($check_exists_audit_qry_run);
        if ($count['count'] > 0) {
            $_SESSION['marks_entered_audit'] = true;
            header('location: /ems/includes/useroptions');
        }
    }
    $get_sub_id_qry = "SELECT cd.sub_id from component_distribution cd,sub_distribution sd where cd.sub_id=sd.sub_id and component_id=" . $_SESSION['sub_comp_id'] . " AND sub_code='" . $_SESSION['sub_code'] . "'";
    $get_sub_id_qry_run = mysqli_query($conn, $get_sub_id_qry);
    $sub_id = mysqli_fetch_assoc($get_sub_id_qry_run);
    $_SESSION['sub_id'] = $sub_id['sub_id'];
    $getComponentName = "SELECT component_name FROM component WHERE component_id=" . $_SESSION['sub_comp_id'];
    $getComponentNameRun = mysqli_query($conn, $getComponentName);
    $comp = mysqli_fetch_assoc($getComponentNameRun);
    $_SESSION['sub_comp_name'] = $comp['component_name'];
    $get_subject_name_qry = "SELECT sub_name from subjects where sub_code='" . $_SESSION['sub_code'] . "'";
    $get_subject_name_qry_run = mysqli_query($conn, $get_subject_name_qry);
    $subname = mysqli_fetch_assoc($get_subject_name_qry_run);
    $_SESSION['sub_name'] = $subname['sub_name'];
    $get_max_marks_qry = "SELECT max_marks from component_distribution WHERE sub_id=" . $_SESSION['sub_id'] . " AND component_id=" . $_SESSION['sub_comp_id'];
    $get_max_marks_qry_run = mysqli_query($conn, $get_max_marks_qry);
    $max_result = mysqli_fetch_assoc($get_max_marks_qry_run);
    $_SESSION['max_marks'] = round($max_result['max_marks']);
} ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feed Marks</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .remarks{
            border: 1px dashed #581CA0 !important;
            border-radius: 7px;
            padding: 20px;
        }
        #controls{
            width: 100%;
            text-align: center;
        }
    button[type=submit]{
        border: none;
        background: rgba(26, 87, 182,0.7);
        color: white;
        padding: 1.5rem;
        font-family: 'Roboto', sans-serif;  
        font-size: 2rem;
        text-transform: uppercase;
        transition: all 400ms;
    }
    
    button[type=submit]:hover{
        animation: moveup 300ms 1 ease-in-out;
        animation-fill-mode: forwards;
        background: rgba(255,255,255,0.8);
        color: #1A57B6;    
        box-shadow: 4px 4px 4px rgba(0,0,0,0.6);
        cursor: pointer;
    }
    table.table-bordered > thead > tr >th{
        border: 1px solid #204F93 !important;
    }
    table tr td,table tr th{
        text-align: center;
        font-size: 1.6rem;
    }
    table.table-bordered > tbody > tr >td{
        border: 1px solid #204F93 !important;
    }
    .subtitle{
        padding: 10px;
        font-family: 'Open Sans';
        text-transform: uppercase;
        border-bottom: 1px dotted black;
        
    }
    </style>
    <script src="../js/feed_validation.js"></script>
</head>
<body>
<?php
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$validate=new validate();
$validate->conf_logged_in();
$options = new useroptions(); //inserting marks
$options->insert_marks($conn);
$obj = new head();
$obj->displayheader();
$obj->dispmenu(4, ["/ems/includes/home", "/ems/includes/logout", "/ems/includes/useroptions", "/ems/includes/developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", 'glyphicon glyphicon-th', "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "Options", "About Us"]);
$dashboard = new dashboard();
$dashboard->display($_SESSION['operator_name'], ["Change Password", "Sign Out"], ["change_password", "index"], "Contact Super Admin");
$input = new input_field();

?>
 <div id="err" style="position: fixed; top: 0; width: 100%"></div>
 <form action="" method="post">
     <div class="feed-container">
        <div class="subselected">
        <div class="subtitle">
           Showing results for: <?php 
                                echo ($_SESSION['current_course_name'] . " | " . $_SESSION['from_year'] . " | " . $_SESSION['main_atkt'] . " | Semster " . $_SESSION['semester']);
                                ?>
            </div>
            <div class="subtitle">
                <?= $_SESSION['sub_name'] ?> -- <?= $_SESSION['sub_comp_name'] ?> 
            </div>
            <div class="subtitle">
            Maximum Marks: <?= $_SESSION['max_marks'] ?>
            </div>
        </div>
     <table class="table table-striped table-responsive table-bordered">
         <caption> <input class="form-control input-lg" id="searchbar" type="text" placeholder="Search students.."></caption>
    <thead>
      <tr>
        <th>Enrollment Number</th>
        <th>Student Name</th>
        <th>Father Name</th>
        <th><?= $_SESSION['sub_comp_name'] ?> Marks</th>
      </tr>
    </thead>
    <tbody id="student_table">
    <?php
    $get_elective_flag="SELECT elective_flag FROM subjects WHERE sub_code='".$_SESSION['sub_code']."'";
    $get_elective_flag_run=mysqli_query($conn,$get_elective_flag);
    $elective_flag=mysqli_fetch_assoc($get_elective_flag_run);
    if($elective_flag['elective_flag']==0)
    {
        if ($_SESSION['main_atkt'] == "main") {
            $get_stud_qry = "SELECT r.enrol_no,first_name,last_name,father_name,roll_id from students s,roll_list r where course_id=" . $_SESSION['current_course_id'] . " AND from_year=" . $_SESSION['from_year'] . " AND s.enrol_no=r.enrol_no AND r.semester=" . $_SESSION['semester'];
        } else if ($_SESSION['main_atkt'] == "atkt") {
            $get_stud_qry = "SELECT r.enrol_no,first_name,last_name,father_name,roll_id from students s,atkt_list r where course_id=" . $_SESSION['current_course_id'] . " AND from_year=" . $_SESSION['from_year'] . " AND s.enrol_no=r.enrol_no AND r.semester=" . $_SESSION['semester'];
        }
        $get_stud_qry_run = mysqli_query($conn, $get_stud_qry);
        if ($get_stud_qry_run) {
            $row_count = 1;
            while ($row = mysqli_fetch_assoc($get_stud_qry_run)) {
                echo ('<tr>
                    <td>' . $row['enrol_no'] . '</td>
                    <td>' . $row['first_name'] . " " . $row['last_name'] . '</td>
                    <td>' . $row['father_name'] . '</td>
                    <td>');
                $input->display_table("enrol", "form-control", "number", "score" . $row_count, "", 1, 0, $_SESSION['max_marks'], 0, $_SESSION['max_marks']);
                $_SESSION['roll_id' . $row_count] = $row['roll_id'];
                echo ('</td>
                    </tr>
                    ');
                $row_count++;
            }
            $_SESSION['num_rows'] = mysqli_num_rows($get_stud_qry_run);
        } else {
            $alert = new alert();
            $alert->exec("Unable to fetch roll list!", "warning");
        }
    }
    else
    {
        $sub_code=$_SESSION['sub_code'];
        if ($_SESSION['main_atkt'] == "main") 
        {
            $get_student_list="SELECT em.enrol_no, st.first_name, st.last_name, st.father_name, r.roll_id FROM students st, elective_map em, roll_list r
                            WHERE st.enrol_no = em.enrol_no AND em.elective_sub_code='".$sub_code."' AND r.enrol_no=em.enrol_no 
                            AND st.from_year=".$_SESSION['from_year']." AND course_id=".$_SESSION['current_course_id'];
        }
        else
        {
            $get_student_list="SELECT em.enrol_no, st.first_name, st.last_name, st.father_name, atkt_r.roll_id FROM students st, elective_map em, roll_list atkt_r
            WHERE st.enrol_no = em.enrol_no AND em.elective_sub_code='".$sub_code."' AND atkt_r.enrol_no=em.enrol_no 
            AND st.from_year=".$_SESSION['from_year']." AND course_id=".$_SESSION['current_course_id'];
        }
        $get_student_list_run=mysqli_query($conn,$get_student_list);
        if ($get_student_list_run==TRUE) 
        {
            $row_count = 1;
            while ($row = mysqli_fetch_assoc($get_student_list_run)) 
            {
                echo ('<tr>
                    <td>' . $row['enrol_no'] . '</td>
                    <td>' . $row['first_name'] . " " . $row['last_name'] . '</td>
                    <td>' . $row['father_name'] . '</td>
                    <td>');
                $input->display_table("enrol", "form-control", "number", "score" . $row_count, "", 1, 0, $_SESSION['max_marks'], 0, $_SESSION['max_marks']);
                $_SESSION['roll_id' . $row_count] = $row['roll_id'];
                echo ('</td>
                    </tr>
                    ');
                $row_count++;
            }
            $_SESSION['num_rows'] = mysqli_num_rows($get_student_list_run);
        } 
        else
        {
            $alert = new alert();
            $alert->exec("Unable to fetch roll list!", "warning");
        }
    }
    ?>  
      
      
    </tbody>
  </table>
  <div class="remarks">
      <?php
        $textarea = new input_field();
        $btn = new input_button();
        ?>
      <div>
          <label for="review">Remarks/Comments</label>
      <?php
        $textarea->display_textarea("review", "reviewtext form-control", "remark", "", "3", "100", 1);
        ?>
      <span id="controls"><center><?php
                                    $btn->display_btn("", "btn btn-primary", "submit", "feed_marks", "", "Submit All"); ?></span>
      </center></div>
      
  </div>
  </div>
  </form>
<?php
$obj = new footer();
$obj->disp_footer();
$logout_modal=new modals();
$logout_modal->display_logout_modal();
?>
</body>

<script>
$(document).ready(function(){
  $("#searchbar").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#student_table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
</html>