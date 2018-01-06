<?php
session_start();
$_SESSION['from_year'] = 2016;//$_POST['batch'];
$_SESSION['course_id'] = 3;//$_POST['course_id'];
$_SESSION['semester'] = 3;//$_POST['semester'];
$_SESSION['main_atkt']="main";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View TR</title>
    <script>
        var total_cr=0.0;
        var total_gpv=0.0;
        var failure_report="";
    function set_rem_tr_values(no){
        document.getElementById("cr"+no).innerHTML=total_cr;
        document.getElementById("gpv"+no).innerHTML=total_gpv;
        document.getElementById("fail"+no).innerHTML=failure_report;
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
        }
        
        .trr {
            width: 100%;
        }
        
        .contain {
            display: flex;
            justify-content: center;
            padding: 20px;
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
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$obj = new head();
$obj->displayheader();
$obj->dispmenu(3, ["/ems/includes/home", "/ems/includes/logout", "/ems/includes/developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
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
    $get_students_qry = "SELECT * FROM students WHERE course_id=" . $_SESSION['course_id'] . " AND current_sem=" . $_SESSION['semester'] . " AND from_year=" . $_SESSION['from_year'];
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
            $get_roll_id = "SELECT distinct(roll_id) from roll_list WHERE enrol_no='" . $student['enrol_no'] . "' ORDER BY semester";
            $get_roll_id_run = mysqli_query($conn, $get_roll_id);
            $loopcount = 0;
            while ($roll_id = mysqli_fetch_assoc($get_roll_id_run)) {
                $get_prev_sgpa = "SELECT sgpa FROM exam_summary WHERE roll_id=" . $roll_id['roll_id'];
                $get_prev_sgpa_run = mysqli_query($conn, $get_prev_sgpa);
                $ressgpa = mysqli_fetch_assoc($get_prev_sgpa_run);
                $sgpa[$loopcount] = $ressgpa['sgpa'];
                if ($sgpa[$loopcount] >= 4.0) {
                    $result_pass_fail[$loopcount] = "PASS";
                } else {
                    $result_pass_fail[$loopcount] = "FAIL";
                }
                $get_fail_sub = "SELECT distinct(sub_id) FROM failure_report WHERE roll_id=" . $roll_id['roll_id'];
                $get_fail_sub_run = mysqli_query($conn, $get_fail_sub);
                $failtext = "";
                while ($failsubid = mysqli_fetch_assoc($get_fail_sub_run)) {
                    $get_subflag = "SELECT sub_code,practical_flag FROM sub_distribution WHERE sub_id=" . $failsubid['sub_id'];
                    $get_subflag_run = mysqli_query($conn, $get_subflag);
                    $res = mysqli_fetch_assoc($get_subflag_run);
                    if ($res['practical_flag'] == 1) {
                        $failtext .= $res['sub_code'] . "[P] ";
                    } else if ($res['practical_flag'] == 2) {
                        $failtext = $res['sub_code'] . "[IE] ";
                    } else {
                        $failtext = $res['sub_code'] . "[T] ";
                    }
                }
                $fail_paper_code[$loopcount] = $failtext;
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
            <span class="block">S.No: ' . $stud_count . '</span>
            <span class="block">Enrollment Number: ' . $student['enrol_no'] . '</span>
            <span class="block">Student Name: ' . $student['first_name'] . " " . $student['middle_name'] . " " . $student['last_name'] . '</span>
            </span>
            <span class="block">Father\'s Name: ' . $student['father_name'] . '</span>

            <span class="block">Mother\'s Name: ' . $student['mother_name'] . '</span>
            <span class="block">Gender: ' . $student['gender'] . '</span>
            <span class="block">Status:');
            if($_SESSION['main_atkt']=="main"){
                echo("Regular");
            }
            else{
                echo("EX");
            }
            echo('</span> </div>
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
                            $get_ia_marks="SELECT marks FROM score WHERE roll_id=".$cur_rollid." AND sub_id=".$subid['sub_id']." AND component_id=5";
                            $get_ia_marks_run=mysqli_query($conn,$get_ia_marks);
                            $ia_marks=mysqli_fetch_assoc($get_ia_marks_run)['marks'];
                            if ($ia_marks < $practical_pass[2]) {
                                echo ("<td style='background: #EF6545'>" . $marks['end_sem'] . "</td>");
                                $fail = true;
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
                            $cur_failure_report.= $subject['sub_code'] . "[T] ";
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
                            echo ('<td id="cr'.$stud_count.'">Total Credits</td>
                        <td id="gpv'.$stud_count.'">Total GPV</td>');
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
                                    echo ('<td>' . $sgpa[$i] . '</td>');
                                }
                            }
                            break;

                        case 4:
                            echo ("<td colspan='2' style='font-weight:700;'>SGPA: $cur_sgpa</td>");
                            echo ("<td>Result</td>");
                            for ($i = 0; $i < $semcount; $i++) {
                                if (empty($result_pass_fail[$i])) {
                                    echo ('<td> - </td>');
                                } else {
                                    echo ("<td>" . $result_pass_fail[$i] . "</td>");
                                }
                            }
                            break;

                        case 5:
                            echo ("<td colspan='2' style='font-weight:700;'>Result : ");
                            if ($cur_sgpa >= 4.0) {
                                echo ("PASS");
                            } else {
                                echo ("FAIL");
                            }
                            echo ('</td>');
                            echo ("<td>Fail In Paper Code</td>");
                            foreach ($fail_paper_code as $failure) {
                                if (empty($result)) {
                                    echo ('<td> - </td>');
                                } else {
                                    echo ("<td>$failure</td>");
                                }
                            }
                            break;

                        case 6:
                            echo ('<td colspan="2" id="fail'.$stud_count.'" style="font-weight:700;">Fail In Subject Code :</td>');
                            break;
                        case 7:
                            echo ("<td colspan='2' style='font-weight:700;'>CGPA : $cur_cgpa</td>");
                            break;
                    }
                    echo ('</tr>');
                    $rowcount++;
                    $subid_count++;
                }
            }
        }
        echo('<script>
        total_cr='.$total_credits.';
        total_gpv='.$total_gpv.';
        failure_report="Fail In Subject Code: '.$cur_failure_report.'";
        </script>');
        echo('<script>set_rem_tr_values('.$stud_count.')</script>');            
        $stud_count++;
        echo ('</table></div>');
    }
    ?>
    </div>

    <?php
    $obj = new footer();
    $obj->disp_footer();
    $logout_modal = new modals();
    $logout_modal->display_logout_modal();
    ?>
</body>

</html>