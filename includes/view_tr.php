<?php
session_start();
$_SESSION['from_year'] = 2016;//$_POST['batch'];
$_SESSION['course_id'] = 3;//$_POST['course_id'];
$_SESSION['semester'] = 3;//$_POST['semester'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            font-size: 1.6rem;
        }
        
        th {
            background: #2A458E;
            color: white;
            font-weight: 600;
            text-align: center;
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
            align-items: center;
            position: absolute;
            width: 100%;
            height: 100%;
            padding: 20px;
        }
        
        table caption {
            font-size: 1.6rem;
            border: 1px dashed;
        }
        
        .caption-container {
            display: flex;
            width: 4000px;
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
<div class="contain" style="width: 4000px; overflow:auto">
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
            echo ('<table class="table table-striped table-bordered">
            <td>S.No: <span class="info">' . $stud_count . '</span>
            </td>
            <td>Enrollment Number: <span class="info">' . $student['enrol_no'] . '</span>
            <td>Student Name: <span class="info">' . $student['first_name'] . " " . $student['middle_name'] . " " . $student['last_name'] . '</span>
            </td>
            <td class="block">Father\'s Name: <span class="info">' . $student['father_name'] . '</span>
            </td>
            <td class="block">Mother\'s Name: <span class="info">' . $student['mother_name'] . '</span>
            </td>
            <td class="block">Gender: <span class="info">' . $student['gender'] . '</span>
            </td>
            <td class="block">Status: <span class="info">' . $student['status'] . '</span>
            </td>
            <tr>
            <th style="vertical-align:middle">Paper Code</th>
            <th style="vertical-align:middle">Paper Name</th>
            <th style="vertical-align:middle">Maximum Marks
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
            <th style="vertical-align:middle;width:40%" colspan="' . ($semcount+1) . '">Previous Semester Details</th>
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
                    if ($subid['practical_flag'] == 1) {
                        echo ('<td>P</td>');
                    } else if ($subid['practical_flag'] == 2) {
                        echo ('<td>IE</td>');
                    } else {
                        echo ('<td>T</td>');
                    }
                    $get_cap_qry = "SELECT * FROM tr WHERE roll_id=" . $cur_rollid . " AND sub_id=" . $subid['sub_id'];
                    $get_cap_qry_run = mysqli_query($conn, $get_cap_qry);
                    $marks = mysqli_fetch_assoc($get_cap_qry_run);
                    echo ('
                    <td>');
                    if (is_null($marks['end_sem'])) {
                        echo ('-');
                    } else {
                        echo ($marks['end_sem']);
                    }
                    echo ('</td>
                    <td>');
                    if (is_null($marks['cat_cap_ia'])) {
                        echo ('-');
                    } else {
                        echo ($marks['cat_cap_ia']);
                    }
                    echo ('</td>
                    <td>');
                    if (is_null($marks['total'])) {
                        echo ('-');
                    } else {
                        echo ($marks['total']);
                    }
                    echo ('</td>
                    <td>' . $marks['percent'] . '</td>
                    <td>' . $marks['grade'] . '</td>
                    <td>' . $marks['gp'] . '</td>
                    <td>' . $marks['cr'] . '</td>
                    <td>' . $marks['gpv'] . '</td>
                    ');
                    $total_credits += $marks['cr'];
                    $total_gpv += $marks['gpv'];

                    switch ($rowcount) {
                        case 1:
                            echo ('<td>Total Credits</td>
                        <td>Total GPV</td>');
                            echo ('<th style="vertical-align:middle">Semester</th>');
                            $convert = new conversion();
                            for ($i = 1; $i <= $semcount; $i++) {
                                echo ('<th>' . $convert->numberToRomanRepresentation($i) . '</th>');
                            }
                            break;

                        case 3:
                            echo ('<td colspan="2"> Semester ' . $convert->numberToRomanRepresentation($_SESSION['semester']) . '</td>
                            <td>SGPA</td>
                            ');
                            for($i=0;$i<$semcount;$i++) {
                                if (empty($sgpa[$i])) {
                                    echo ('<td> - </td>');
                                } else {
                                    echo ('<td>'.$sgpa[$i].'</td>');
                                }
                            }
                            break;

                        case 4:
                            echo ("<td colspan='2'>SGPA: $cur_sgpa</td>");
                            echo ("<td>Result</td>");
                            for($i=0;$i<$semcount;$i++) {
                                if (empty($result_pass_fail[$i])) {
                                    echo ('<td> - </td>');
                                } else {
                                    echo ("<td>".$result_pass_fail[$i]."</td>");
                                }
                            }
                            break;

                        case 5:
                            echo ("<td colspan='2'>Result: ");
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
                            echo ("<td colspan='2'>CGPA: $cur_cgpa</td>");
                            break;
                    }
                    echo ('</tr>');
                    $rowcount++;
                    $subid_count++;
                }
            }
        }
        $stud_count++;
        echo ('</table>');
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