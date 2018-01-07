<?php
require('config.php');
if(isset($_POST['print_proceed'])){
    $_SESSION['from_year'] = $_POST['print_batch'];
    $_SESSION['semester'] = $_POST['print_semester'];
    $_SESSION['course_id'] = $_POST['print_course'];
    $_SESSION['main_atkt']=$_POST['print_type'];   
}
else{
    header('location: /ems/includes/404.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Tabulation Register</title>
    <style>
    .subtitle{
        padding: 10px;
        font-family: 'Open Sans';
        text-transform: uppercase;
        border-bottom: 1px dotted black;
        
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
    $obj->dispmenu(3, ["/ems/includes/home", "/ems/includes/logout", "/ems/includes/developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
    $dashboard = new dashboard();
    $dashboard->display($_SESSION['operator_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "Contact Super Admin");

    ?>
     <div class="subselected">
        <div class="subtitle">
           Showing results for: <?php 
                                echo ($_SESSION['current_course_name'] . " | " . $_SESSION['from_year'] . " | " . $_SESSION['main_atkt'] . " | Semster " . $_SESSION['semester']);
                                ?>
            </div>
        </div>
        <table class="table table-striped table-responsive table-bordered">
         <caption> <input class="form-control input-lg" id="searchbar" type="text" placeholder="Search students.."></caption>
    <thead>
      <tr>
        <th>Enrollment Number</th>
        <th>Student Name</th>
        <th>Father's Name</th>
        <th>Print Gradesheet</th>
      </tr>
    </thead>
    <tbody>
        <?php
        $get_students_qry = "SELECT * FROM students s,roll_list rl WHERE s.course_id=" . $_SESSION['course_id'] . " AND s.from_year=" . $_SESSION['from_year'] . " AND rl.semester=" . $_SESSION['semester'];
        $get_students_qry_run = mysqli_query($conn, $get_students_qry);
        if ($get_students_qry_run) {
            while ($student = mysqli_fetch_assoc($get_students_qry_run)) {
                echo ('<td>' . $student['enrol_no'] . '</td>
                <td>' . $student['first_name'] . " " . $student['last_name'] . '</td>
                <td>' . $student['father_name'] . '</td>');
                $get_no_of_prints = "SELECT no_prints FROM roll_list WHERE enrol_no='" . $student['enrol_no'] . "' AND semester=" . $_SESSION['semester'];
                $get_no_of_prints_run = mysqli_query($conn, $get_no_of_prints);
                $prints = mysqli_fetch_assoc($get_no_of_prints_run)['no_prints'];
                if ($prints == 0) {
                    echo ('<td>');
                    $print_btn = new input_button();
                    $print_btn->display_btn("", "btn btn-default", "submit", "print_roll_id", "", 'Print Now <i class="glyphicon glyphicon-print"></i>');
                    echo ('</td>');
                } else {
                    echo ('<td>');
                    $print_btn = new input_button();
                    $print_btn->display_btn("", "btn btn-success", "submit", "print_roll_id", "", 'Print Again <i class="glyphicon glyphicon-print"></i>');
                    echo ('</td>');
                }
            }
        }
        ?>
    </tbody>
</table>
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