<?php
session_start();
require("class_lib.php");
    require("config.php");
    require("frontend_lib.php");
if (isset($_POST['tr_view_proceed'])) {
    $input_chk = new input_check();
    $_SESSION['from_year']= $input_chk->input_safe($conn,$_POST['tr_view_batch']);
    $_SESSION['course_id'] = $_SESSION['current_course_id'];
    $_SESSION['semester'] = $input_chk->input_safe($conn,$_POST['tr_view_semester']);
    $_SESSION['main_atkt'] = $input_chk->input_safe($conn,$_POST['tr_view_type']);
    if(empty($_SESSION['from_year']) OR empty($_SESSION['semester']) OR empty($_SESSION['main_atkt'])){
        $alert=new alert();
        $alert->exec("Please verify all fields!","warning");
        die();
    }
} else {
   //header('location: /ems/includes/404.html');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View TR</title>
<link rel="stylesheet" href="/ems/css/style.css">
    <script>
        var total_cr=0.0;
        var total_gpv=0.0;
        var failure_report="";
    function set_rem_tr_values(no,credits,gpv,failures){
        document.getElementById("cr"+no).innerHTML=credits;
        document.getElementById("gpv"+no).innerHTML=gpv;
        document.getElementById("fail"+no).innerHTML=failures;
    }
    function fetch_enrol(id){
        document.getElementById("tr_roll_id").value=id;
    }
    function getTrComponents(subcode){
        $.ajax({
	type: "POST",
	url: "update_tr_ajax",
	data: 'tr_subcode='+subcode,
	success: function(data){
        $("#tr_components").html(data);
      },
    error: function(e){
        alert('Come back again');
    }
	});
    }
</script>
    <style>
        body{
            background: white !important;
        }
        table {
            font-size: 1.6rem;
        }
        
        th {
            background: #2A458E;
            color: white;
            font-weight: 500;
            text-align: center !important;
        }
        
        td {
            text-align: center;
            border: 1px solid #DCDFE1 !important;
        }
        
        .trr {
            width: 100%;
        }
        
        .contain {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 20px;
            margin-bottom: 100px;
        }
        
        table caption {
            font-size: 1.8rem;
            border-top: 1px solid;
            font-family: 'Lato', sans-serif;
        }
        
        .caption-container {
            display: flex;
            width: 4096px;
            justify-content: space-around;
        }
        
        .block {
            padding: 10px;
        }
        
        @media print {
            th {
                font-size: 14px;
            }
            .trr {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
<?php


$obj = new head();
$obj->displayheader();
require('../preloader/preload.php');
$options = new useroptions();
$valid = new validate();
$valid->conf_logged_in();
$options->request_tr_update($conn);
$obj->dispmenu(4, ["/ems/includes/home", "/ems/includes/logout", "/ems/includes/useroptions", "/ems/includes/developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", 'glyphicon glyphicon-th', "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "Options", "About Us"]);
$dashboard = new dashboard();
$dashboard->display($_SESSION['operator_name'], ["Change Password", "Sign Out"], ["change_password", "index"], "Contact Super Admin");
?>
<div class="contain">
    <?php
    $get_count_semesters = "SELECT duration*2 as 'semcount' from courses where course_id=" . $_SESSION['course_id'];
    $get_count_semesters_run = mysqli_query($conn, $get_count_semesters);
    if ($get_count_semesters_run) {
        $semcount = mysqli_fetch_assoc($get_count_semesters_run)['semcount'];
    }
    $get_students_qry = "SELECT * FROM students WHERE course_id=" . $_SESSION['course_id'] . " AND current_sem=" . $_SESSION['semester'] . " AND from_year=" . $_SESSION['from_year']." AND enrol_no IN(SELECT enrol_no FROM roll_list)";
    $get_students_qry_run = mysqli_query($conn, $get_students_qry);
    if ($get_students_qry_run) {
        $stud_count = 1;
        $total_credits = 0;
        $total_gpv = 0;
        while ($student = mysqli_fetch_assoc($get_students_qry_run)) {
            $sgpa = new SplFixedArray($semcount);
            $fail_paper_code = new SplFixedArray($semcount);
            $result_pass_fail = new SplFixedArray($semcount);
            $cur_failure_report = "";
            $get_roll_id = "SELECT distinct(roll_id),semester from roll_list WHERE enrol_no='" . $student['enrol_no'] . "' ORDER BY semester";
            $get_roll_id_run = mysqli_query($conn, $get_roll_id);
            $loopcount = 0;
            while ($roll_id = mysqli_fetch_assoc($get_roll_id_run)) {
                $sem=$roll_id['semester']-1;
                $get_prev_sgpa = "SELECT sgpa FROM exam_summary WHERE roll_id=" . $roll_id['roll_id'];
                $get_prev_sgpa_run = mysqli_query($conn, $get_prev_sgpa);
                $ressgpa = mysqli_fetch_assoc($get_prev_sgpa_run);
                $sgpa[$sem] = $ressgpa['sgpa'];
                /*if ($sgpa[$loopcount] >= 4.0) {
                    $result_pass_fail[$loopcount] = "PASS";
                } else {
                    $result_pass_fail[$loopcount] = "FAIL";
                }Doubtful Code*/
                $get_fail_sub = "SELECT distinct(sub_id) FROM failure_report WHERE roll_id=" . $roll_id['roll_id'];
                $get_fail_sub_run = mysqli_query($conn, $get_fail_sub);
                if (mysqli_num_rows($get_fail_sub_run) == 0) {
                    $result_pass_fail[$sem] = "PASS";
                } else {
                    $result_pass_fail[$sem] = "FAIL";
                }
                $failtext = "";
                while ($failsubid = mysqli_fetch_assoc($get_fail_sub_run)) {
                    $get_subflag = "SELECT sub_code,practical_flag FROM sub_distribution WHERE sub_id=" . $failsubid['sub_id'];
                    $get_subflag_run = mysqli_query($conn, $get_subflag);
                    $res = mysqli_fetch_assoc($get_subflag_run);
                    if ($res['practical_flag'] == 1) {
                        $failtext .= $res['sub_code'] . "[P] ";
                    } else if ($res['practical_flag'] == 2) {
                        $failtext .= $res['sub_code'] . "[IE] ";
                    } else {
                        $failtext .= $res['sub_code'] . "[T] ";
                    }
                }
                $fail_paper_code[$sem] = $failtext;
                $loopcount++;
            }
            $get_cur_rollid = "SELECT roll_id from roll_list WHERE semester=" . $_SESSION['semester'] . " AND enrol_no='" . $student['enrol_no'] . "'";
            $get_cur_rollid_run = mysqli_query($conn, $get_cur_rollid);
            $cur_rollid = mysqli_fetch_assoc($get_cur_rollid_run)['roll_id'];
            $get_current_sgpa = "SELECT sgpa FROM exam_summary WHERE roll_id=" . $cur_rollid;
            $get_current_sgpa_run = mysqli_query($conn, $get_current_sgpa);
            $cur_sgpa = mysqli_fetch_assoc($get_current_sgpa_run)['sgpa'];
            $get_cur_cgpa = "SELECT cgpa FROM students WHERE enrol_no='" . $student['enrol_no'] . "'";
            $get_cur_cgpa_run = mysqli_query($conn, $get_cur_cgpa);
            $cur_cgpa = mysqli_fetch_assoc($get_cur_cgpa_run)['cgpa'];
            echo ('<div class="tr_container" style="width: 100%; overflow:auto">
            <table class="table table-striped table-bordered">
            <caption>
            <div class="caption-container">
            <td class="block">S.No: ' . $stud_count . '</td>
            <td class="block">Enrollment Number: ' . $student['enrol_no'] . '</td>
            <td class="block" colspan="3">Student Name: ' . $student['first_name'] . " " . $student['middle_name'] . " " . $student['last_name'] . '</td>
            </td>
            <td class="block" colspan="3">Father\'s Name: ' . $student['father_name'] . '</td>

            <td class="block" colspan="3">Mother\'s Name: ' . $student['mother_name'] . '</td>
            <td class="block">Gender: ' . $student['gender'] . '</td>
            <td class="block" colspan="2">Status:');
            if ($_SESSION['main_atkt'] == "main") {
                echo ("Regular");
            } else {
                echo ("EX");
            }
            echo ('</td> 
            <td><button type="button" class="btn btn-danger" data-target="#updateTrdialog" data-toggle="modal" onclick="fetch_enrol(this.value)" value="' . $cur_rollid . '">Update TR Marks</button></td>
            </div>
            </caption>
            <tr>
            <th style="vertical-align:middle">Paper Code</th>
            <th style="vertical-align:middle">Paper Name</th>
            <th style="vertical-align:middle" colspan="2">Maximum Marks
                <br>(Th;Pr)</th>
            <th>Th;Pr<br>50:40</th>
            <th style="vertical-align:middle">CAT;CAP;IA<br>
                50;40;20</th>
            <th style="vertical-align:middle">Total Th;Pr
                    <br>100;100</th>
            <th style="vertical-align:middle">Per (%)</th>
            <th style="vertical-align:middle">Grade</th>
            <th style="vertical-align:middle">GP.</th>
            <th style="vertical-align:middle">Cr.</th>
            <th style="vertical-align:middle">GPV.</th>
            <th style="vertical-align:middle">Total Credits Earned</th>
            <th style="vertical-align:middle">Total GPV Earned</th>
            <th style="vertical-align:middle;width:40%" colspan="' . ($semcount + 1) . '">Previous Semester Details</th>
        </tr>
            ');
            $get_subjects_qry = "SELECT sub_code,sub_name from subjects WHERE course_id=" . $_SESSION['course_id'] . " AND from_year=" . $_SESSION['from_year'] . " AND semester=" . $_SESSION['semester'];
            $get_subjects_qry_run = mysqli_query($conn, $get_subjects_qry);
            $rowcount = 1;
            $fail_flag = false;
            while ($subject = mysqli_fetch_assoc($get_subjects_qry_run)) {
                echo ('<tr style="vertical-align:middle">');
                $get_subid_count = "SELECT count(*) from sub_distribution WHERE sub_code='" . $subject['sub_code'] . "'";
                $get_subid_count_run = mysqli_query($conn, $get_subid_count);
                $subid_count = mysqli_fetch_assoc($get_subid_count_run)['count(*)'];
                echo ('
                <td style="vertical-align:middle" rowspan="' . $subid_count . '">' . $subject['sub_code'] . '</td>
                <td style="vertical-align:middle" rowspan="' . $subid_count . '">' . $subject['sub_name'] . '</td>
                ');
                $sub_id_loop = "SELECT sub_id,practical_flag from sub_distribution WHERE sub_code='" . $subject['sub_code'] . "'";
                $sub_id_loop_run = mysqli_query($conn, $sub_id_loop);
                $subidcount = 1;
                while ($subid = mysqli_fetch_assoc($sub_id_loop_run)) {
                    if ($subidcount > 1) {
                        echo ('<tr style="vertical-align:middle">');
                    }
                    $get_comp_id = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $subid['sub_id'] . " ORDER BY component_id";
                    $get_comp_id_run = mysqli_query($conn, $get_comp_id);
                    if ($subid['practical_flag'] == 1) {
                        echo ('<td>P</td><td>100</td>');
                        while ($pass_marks = mysqli_fetch_assoc($get_comp_id_run)) {
                            $practical_pass[] = $pass_marks['passing_marks'];
                        }
                        $get_cap_qry = "SELECT * FROM tr WHERE roll_id=" . $cur_rollid . " AND sub_id=" . $subid['sub_id'];
                        $get_cap_qry_run = mysqli_query($conn, $get_cap_qry);
                        $marks = mysqli_fetch_assoc($get_cap_qry_run);
                        $fail = false;
                        if (is_null($marks['end_sem'])) {
                            echo ('<td> - </td>');
                        } else {
                            if ($marks['end_sem'] < $practical_pass[1]) {
                                echo ("<td style='background: #EF6545'>" . $marks['end_sem'] . "</td>");
                                $fail = true;
                                $fail_flag = true;
                            } else {
                                echo ("<td>" . $marks['end_sem'] . "</td>");
                            }
                        }

                        if (is_null($marks['cat_cap_ia'])) {
                            echo ('<td> - </td>');
                        } else {
                            $get_ia_marks = "SELECT marks FROM score WHERE roll_id=" . $cur_rollid . " AND sub_id=" . $subid['sub_id'] . " AND component_id=5";
                            $get_ia_marks_run = mysqli_query($conn, $get_ia_marks);
                            $ia_marks = mysqli_fetch_assoc($get_ia_marks_run)['marks'];
                            if ($marks['cat_cap_ia'] < $practical_pass[0] || $ia_marks<$practical_pass[2]) {
                                echo ("<td style='background: #EF6545'>" . $marks['cat_cap_ia'] . "</td>");
                                $fail = true;
                                $fail_flag = true;
                            } else {
                                echo ("<td>" . $marks['cat_cap_ia'] . "</td>");
                            }
                        }
                        if (is_null($marks['total'])) {
                            echo ('<td> - </td>');
                        } else {
                            echo ("<td>" . $marks['total'] . "</td>");
                        }
                        if ($fail) {
                            $cur_failure_report .= $subject['sub_code'] . "[P] ";
                        }

                    } else if ($subid['practical_flag'] == 2) {
                        echo ('<td>IE</td><td>100</td>');
                        $ie_pass = mysqli_fetch_assoc($get_comp_id_run)['passing_marks'];
                        $get_cap_qry = "SELECT * FROM tr WHERE roll_id=" . $cur_rollid . " AND sub_id=" . $subid['sub_id'];
                        $get_cap_qry_run = mysqli_query($conn, $get_cap_qry);
                        $marks = mysqli_fetch_assoc($get_cap_qry_run);
                        $fail = false;
                        if (is_null($marks['end_sem'])) {
                            echo ('<td> - </td>');
                        } else {
                            if ($marks['end_sem'] < $practical_pass[1]) {
                                echo ("<td style='background: #EF6545'>" . $marks['end_sem'] . "</td>");
                                $fail = true;
                                $fail_flag = true;
                            } else {
                                echo ("<td>" . $marks['end_sem'] . "</td>");
                            }
                        }
                        if (is_null($marks['cat_cap_ia'])) {
                            echo ('<td> - </td>');
                        } else {
                            if ($marks['cat_cap_ia'] < $practical_pass[0]) {
                                echo ("<td style='background: #EF6545'>" . $marks['cat_cap_ia'] . "</td>");
                                $fail = true;
                                $fail_flag = true;
                            } else {
                                echo ("<td>" . $marks['cat_cap_ia'] . "</td>");
                            }
                        }
                        if (is_null($marks['total'])) {
                            echo ('<td> - </td>');
                        } else {
                            if ($marks['total'] < $ie_pass) {
                                echo ("<td style='background: #EF6545'>" . $marks['total'] . "</td>");
                            } else {
                                echo ("<td>" . $marks['total'] . "</td>");
                            }
                        }

                    } else {
                        echo ('<td>T</td><td>100</td>');
                        while ($pass_marks = mysqli_fetch_assoc($get_comp_id_run)) {
                            $theory_pass[] = $pass_marks['passing_marks'];
                        }
                        $get_cap_qry = "SELECT * FROM tr WHERE roll_id=" . $cur_rollid . " AND sub_id=" . $subid['sub_id'];
                        $get_cap_qry_run = mysqli_query($conn, $get_cap_qry);
                        $marks = mysqli_fetch_assoc($get_cap_qry_run);
                        $fail = false;
                        if (is_null($marks['end_sem'])) {
                            echo ('<td> - </td>');
                        } else {
                            if ($marks['end_sem'] < $theory_pass[1]) {
                                echo ("<td style='background: #EF6545'>" . $marks['end_sem'] . "</td>");
                                $fail = true;
                                $fail_flag = true;
                            } else {
                                echo ("<td>" . $marks['end_sem'] . "</td>");
                            }
                        }

                        if (is_null($marks['cat_cap_ia'])) {
                            echo ('<td> - </td>');
                        } else {
                            if ($marks['cat_cap_ia'] < $theory_pass[0]) {
                                echo ("<td style='background: #EF6545'>" . $marks['cat_cap_ia'] . "</td>");
                                $fail = true;
                                $fail_flag = true;
                            } else {
                                echo ("<td>" . $marks['cat_cap_ia'] . "</td>");
                            }
                        }
                        if (is_null($marks['total'])) {
                            echo ('<td> - </td>');
                        } else {
                            echo ("<td>" . $marks['total'] . "</td>");
                        }
                        if ($fail) {
                            $cur_failure_report .= $subject['sub_code'] . "[T] ";
                        }

                    }
                    echo ('<td>' . $marks['percent'] . '</td>
                    <td>' . $marks['grade'] . '</td>
                    <td>' . $marks['gp'] . '</td>
                    <td>' . $marks['cr'] . '</td>
                    <td>' . $marks['gpv'] . '</td>
                    ');
                    $total_credits += $marks['cr'];
                    $total_gpv += $marks['gpv'];

                    switch ($rowcount) {
                        case 1:
                            echo ('<td id="cr' . $stud_count . '"></td>
                        <td id="gpv' . $stud_count . '"></td>');
                            echo ('<th style="vertical-align:middle">Semester</th>');
                            $convert = new conversion();
                            for ($i = 1; $i <= $semcount; $i++) {
                                echo ('<th>' . $convert->numberToRomanRepresentation($i) . '</th>');
                            }
                            break;

                        case 3:
                            echo ('<td colspan="2" style="font-weight:700;"> Semester ' . $convert->numberToRomanRepresentation($_SESSION['semester']) . '</td>
                            <td>SGPA</td>
                            ');
                            for ($i = 0; $i < $semcount; $i++) {
                                if (empty($sgpa[$i])) {
                                    echo ('<td> - </td>');
                                } else {    
                                    if (empty($fail_paper_code[$i])) {
                                        echo ('<td>' . $sgpa[$i] . '</td>');
                                        
                                    } else {
                                        echo ("<td> - </td>");
                                    }
                                }
                            }
                            
                            break;

                        case 4:
                        echo ("<td colspan='2' style='font-weight:700;'>SGPA: ");
                        if ($fail_flag) {
                            echo('-');
                        }
                        else{
                        echo($cur_sgpa);
                        }
                        echo("</td>");
                        echo ("<td>Result</td>");
                            for ($i = 0; $i < $semcount; $i++) {
                                if (empty($result_pass_fail[$i])) {
                                    echo ('<td> - </td>');
                                } else {
                                    if ($result_pass_fail[$i] == "PASS") {
                                        echo ("<td style='color: #1AC124'>" . $result_pass_fail[$i] . "</td>");
                                    } else {
                                        echo ("<td style='color: #DF3611'>" . $result_pass_fail[$i] . "</td>");

                                    }
                                }
                            }
                            break;

                        case 5:
                            if ($fail_flag) {
                                echo ("<td colspan='2' style='font-weight:700; color: #DF3611'>Result : FAIL</td>");
                            } else {
                                echo ("<td colspan='2' style='font-weight:700; color: #1AC124'>Result : PASS</td>");
                            }
                            echo ("<td>Fail In Paper Code</td>");
                            for ($i = 0; $i < $semcount; $i++) {
                                if (empty($fail_paper_code[$i])) {
                                    echo ('<td> - </td>');
                                } else {
                                    echo ("<td>" . $fail_paper_code[$i] . "</td>");
                                }
                            }
                            break;

                        case 6:
                        echo ('<td colspan="2" id="fail' . $stud_count . '" style="font-weight:700;">Fail In Subject Code :');
                        if (empty($fail_paper_code[$_SESSION['semester']-1])) {
                            echo ('<td> - </td>');
                        } else {
                            echo ("<td>" . $fail_paper_code[$_SESSION['semester']-1] . "</td>");
                        }
                        echo('</td>');
                        break;
                        case 7:
                            echo ("<td colspan='2' style='font-weight:700;'>CGPA : --</td>");// To be replaced by $cur_cgpa
                            break;
                    }
                    echo ('</tr>');
                    $rowcount++;
                    $subid_count++;
                }
            }
            if ($rowcount < 7) {
                while ($rowcount != 8) {
                    switch ($rowcount) {
                        case 3:

                            echo ('<tr><td colspan="12"></td>
                            <td colspan="2" style="font-weight:700;"> Semester ' . $convert->numberToRomanRepresentation($_SESSION['semester']) . '</td>
                            <td>SGPA</td>
                            ');
                            for ($i = 0; $i < $semcount; $i++) {
                                if (empty($sgpa[$i])) {
                                    echo ('<td> - </td>');
                                } else {    
                                    if (empty($fail_paper_code[$i])) {
                                        echo ('<td>' . $sgpa[$i] . '</td>');
                                        
                                    } else {
                                        echo ("<td> - </td>");
                                    }
                                }
                            }
                            
                            echo ("</tr>");
                            break;

                        case 4:
                        echo ("<td colspan='2' style='font-weight:700;'>SGPA: ");
                        if ($fail_flag) {
                            echo('-');
                        }
                        else{
                        echo($cur_sgpa);
                        }
                        echo("</td>");
                        echo ("<td>Result</td>");
                            for ($i = 0; $i < $semcount; $i++) {
                                if (empty($result_pass_fail[$i])) {
                                    echo ('<td> - </td>');
                                } else {
                                    echo ("<td>" . $result_pass_fail[$i] . "</td>");
                                }
                            }
                            echo ("</tr>");
                            break;

                        case 5:
                            echo ("<tr><td colspan='12'></td>");
                            if ($fail_flag) {
                                echo ("<td colspan='2' style='font-weight:700; color: #DF3611'>Result : FAIL</td>");
                            } else {
                                echo ("<td colspan='2' style='font-weight:700; color: #1AC124' >Result : PASS</td>");
                            }

                            echo ("<td>Fail In Paper Code</td>");
                            for ($i = 0; $i < $semcount; $i++) {
                                if (empty($fail_paper_code[$i])) {
                                    echo ('<td> - </td>');
                                } else {
                                    echo ("<td>" . $fail_paper_code[$i] . "</td>");
                                }
                            }
                            echo ("</tr>");
                            break;

                        case 6:
                        echo ('<td colspan="2" id="fail' . $stud_count . '" style="font-weight:700;">Fail In Subject Code :');
                        if (empty($fail_paper_code[$_SESSION['semester']-1])) {
                            echo ('<td> - </td>');
                        } else {
                            echo ("<td>" . $fail_paper_code[$_SESSION['semester']-1] . "</td>");
                        }
                        echo('</td>');
                         echo ("</tr>");
                            break;
                        case 7:
                            echo ("<tr><td colspan='12'></td>
                            <td colspan='2' style='font-weight:700;'>CGPA : --</td>");//To be replaced by $cur_cgpa
                            echo ("</tr>");
                            break;
                    }
                    $rowcount++;
                }
            }
            echo ('<script>
            window.setTimeout(function(){set_rem_tr_values(' . $stud_count . ',' . $total_credits . ',' . $total_gpv . ',"Fail In Subject Code ' . $cur_failure_report . '")},1000);</script>');
            echo ('</table></div>');
            $stud_count++;
        }

    }
    ?>
    </div>

 <!-- Update TR Modal -->
 <div class="modal fade" id="updateTrdialog" role="dialog">
      <div class="modal-dialog">
      
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Select from below</h4>
          </div>
          <form action="" method="post" onsubmit="return disable_on_submitbtn()">
          <div class="modal-body">
          <?php
            $input = new input_field();
            ?>
          <div class="form-group">
              <label for="name">Roll ID</label>
                <?php
                $input->display_table_readonly("tr_roll_id", "form-control", "text", "tr_req_roll_id", "", 1, 0, 0, 1, 0);
                ?>
              </div>
              <div class="form-group">
              <label for="type">Select Subject</label>
              <select name="tr_req_subject" id="tr_subjects" class="form-control" onchange="getTrComponents(this.value)" required>
                  <option disabled selected>Select a Subject</option>
                  <?php
                    $get_subjects_list = "SELECT sub_name,sub_code FROM subjects WHERE course_id=" . $_SESSION['course_id'] . " AND from_year=" . $_SESSION['from_year'] . " AND semester=" . $_SESSION['semester'];
                    $get_subjects_list_run = mysqli_query($conn, $get_subjects_list);
                    while ($sub = mysqli_fetch_assoc($get_subjects_list_run)) {
                        echo ('<option value="' . $sub['sub_code'] . '">' . $sub['sub_code'] . "-" . $sub['sub_name'] . '</option>');
                    }
                    ?>
              </select>
              </div>
              <div class="form-group">
              <label for="semester">Select Components</label>
                <div id="tr_components">
                </div>  
            </div>
            <div class="form-group">
              <label for="semester">Reason/Remarks</label>
            <?php
            $input->display("", "form-control", "text", "tr_req_remark", "Enter remarks", 1);
            ?>  
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Return</button>
            <button type="submit" class="btn btn-success" name="update_tr_submit" value="" id="btn_session_update">Request for Update<i class="glyphicon glyphicon-chevron-right"></i></button>
        </div>
        </form> 
        </div>
        
      </div>
    </div>
    
  </div>
  <!--End-->

    <?php
    $obj = new footer();
    $obj->disp_footer();
    $logout_modal = new modals();
    $logout_modal->display_logout_modal();
    ?>
</body>

</html>