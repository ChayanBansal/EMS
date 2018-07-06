<?php
// getting semester 
session_start();
require('config.php');
require('class_lib.php');

$alert = new alert();
if (isset($_POST['getBatch'])) {
    $safety = new input_check();
    $type = $safety->input_safe($conn, $_POST['type']);
    switch ($type) {
        case 'main':
            $get_ay = "SELECT distinct(from_year) FROM academic_sessions";
            $get_ay_run = mysqli_query($conn, $get_ay);
            if (mysqli_num_rows($get_ay_run) == 0) {
                echo ("<option disabled selected>No sessions found!</option>");
            } else {
                while ($year = mysqli_fetch_assoc($get_ay_run)) {
                    echo ('<option value="' . $year['from_year'] . '">' . $year['from_year'] . '</option>');
                }
            }
            break;
        case 'retotal':
            $get_ay = "SELECT distinct(from_year) FROM academic_sessions WHERE ac_session_id IN(SELECT ac_session_id FROM $retotal.retotal_sessions)";
            $get_ay_run = mysqli_query($conn, $get_ay);
            if (mysqli_num_rows($get_ay_run) == 0) {
                echo ("<option disabled selected>No sessions found!</option>");
            } else {
                while ($year = mysqli_fetch_assoc($get_ay_run)) {
                    echo ('<option value="' . $year['from_year'] . '">' . $year['from_year'] . '</option>');
                }
            }
            break;
        case 'reval':
            $get_ay = "SELECT distinct(from_year) FROM academic_sessions WHERE ac_session_id IN(SELECT ac_session_id FROM $reval.reval_sessions)";
            $get_ay_run = mysqli_query($conn, $get_ay);
            if (mysqli_num_rows($get_ay_run) == 0) {
                echo ("<option disabled selected>No sessions found!</option>");
            } else {
                while ($year = mysqli_fetch_assoc($get_ay_run)) {
                    echo ('<option value="' . $year['from_year'] . '">' . $year['from_year'] . '</option>');
                }
            }

            break;
        case 'atkt':
            $get_ay = "SELECT distinct(from_year) FROM academic_sessions WHERE ac_session_id IN(SELECT ac_session_id FROM $atkt.atkt_sessions)";
            $get_ay_run = mysqli_query($conn, $get_ay);
            if (mysqli_num_rows($get_ay_run) == 0) {
                echo ("<option disabled selected>No sessions found!</option>");
            } else {
                while ($year = mysqli_fetch_assoc($get_ay_run)) {
                    echo ('<option value="' . $year['from_year'] . '">' . $year['from_year'] . '</option>');
                }
            }
            break;

        default:
            die("Error Encountered!");
            break;
    }


}
if (isset($_POST['getSemester'])) {
    if ($_POST['from_year'] and $_POST['main_atkt']) {
        $from_year = $_POST['from_year'];
        $examType = $_POST['main_atkt'];
        switch ($examType) {
            case 'main':
                $get_semester = "SELECT current_semester FROM academic_sessions WHERE from_year=" . $from_year . " AND course_id=" . $_SESSION['current_course_id'] . " ORDER BY current_semester DESC";
                $get_semester_run = mysqli_query($conn, $get_semester);
                while ($result = mysqli_fetch_assoc($get_semester_run)) {
                    $temp = $result['current_semester'];
                    echo ('<option name="selected_semester" value="' . $temp . '" >' . $temp . '</option>');
                }
                $_SESSION['selected_semester'] = $result['current_semester'];


                break;
            case 'retotal':
                $get_semester = "SELECT current_semester FROM academic_sessions WHERE from_year=" . $from_year . " AND course_id=" . $_SESSION['current_course_id'] . " AND ac_session_id IN(SELECT ac_session_id FROM $retotal.retotal_sessions) ORDER BY current_semester DESC";
                $get_semester_run = mysqli_query($conn, $get_semester);
                $result = mysqli_fetch_assoc($get_semester_run);
                $_SESSION['selected_semester'] = $result['current_semester'];
                $temp = $result['current_semester'];
                echo ('<option name="selected_semester" value="' . $temp . '" >' . $temp . '</option>');

                break;
            case 'reval':
                $get_semester = "SELECT current_semester FROM academic_sessions WHERE from_year=" . $from_year . " AND course_id=" . $_SESSION['current_course_id'] . " AND ac_session_id IN(SELECT ac_session_id FROM $reval.reval_sessions) ORDER BY current_semester DESC";
                $get_semester_run = mysqli_query($conn, $get_semester);
                $result = mysqli_fetch_assoc($get_semester_run);
                $_SESSION['selected_semester'] = $result['current_semester'];
                $temp = $result['current_semester'];
                echo ('<option name="selected_semester" value="' . $temp . '" >' . $temp . '</option>');

                break;
            case 'atkt':
                $get_semester = "SELECT current_semester FROM academic_sessions WHERE from_year=" . $from_year . " AND course_id=" . $_SESSION['current_course_id'] . " AND ac_session_id IN(SELECT ac_session_id FROM $atkt.atkt_sessions) ORDER BY current_semester DESC";
                $get_semester_run = mysqli_query($conn, $get_semester);
                $result = mysqli_fetch_assoc($get_semester_run);
                $_SESSION['selected_semester'] = $result['current_semester'];
                $temp = $result['current_semester'];
                echo ('<option name="selected_semester" value="' . $temp . '" >' . $temp . '</option>');

                break;

            default:
                die("Error Encountered!");
                break;
        }
    }
}

if (isset($_POST['getSubject'])) {
    if ($_POST['from_year'] and $_POST['main_atkt'] and $_POST['semester']) {
        $examType = $_POST['main_atkt'];
        switch ($examType) {
            case 'main':
                $get_sub_main = "SELECT sub_code, sub_name FROM subjects WHERE ac_session_id IN (SELECT ac_session_id FROM academic_sessions WHERE course_id=" . $_SESSION['current_course_id'] . " AND current_semester=" . $_POST['semester'] . " AND from_year=" . $_POST['from_year'] . ")";
                $get_sub_main_run = mysqli_query($conn, $get_sub_main);
                while ($main_sub = mysqli_fetch_assoc($get_sub_main_run)) {
                    echo ('<option value="' . $main_sub['sub_code'] . '">' . $main_sub['sub_name'] . '</option>');
                }
                break;
            case 'retotal':
                $get_sub_retotal = "SELECT sub_code, sub_name FROM subjects WHERE ac_session_id IN (SELECT ac_session_id FROM academic_sessions WHERE course_id=" . $_SESSION['current_course_id'] . " AND current_semester=" . $_POST['semester'] . " AND from_year=" . $_POST['from_year'] . " AND ac_session_id IN(SELECT ac_session_id FROM $retotal.retotal_sessions) AND ac_sub_code IN(SELECT ac_sub_code FROM sub_distribution WHERE sub_id IN(SELECT distinct(sub_id) FROM $retotal.retotal_subjects)))";
                $get_sub_retotal_run = mysqli_query($conn, $get_sub_main);
                while ($retotal_sub = mysqli_fetch_assoc($get_sub_retotal_run)) {
                    echo ('<option value="' . $retotal_sub['sub_code'] . '">' . $retotal_sub['sub_name'] . '</option>');
                }
                break;
            case 'reval':
                $get_sub_reval = "SELECT sub_code, sub_name FROM subjects WHERE ac_session_id IN (SELECT ac_session_id FROM academic_sessions WHERE course_id=" . $_SESSION['current_course_id'] . " AND current_semester=" . $_POST['semester'] . " AND from_year=" . $_POST['from_year'] . " AND ac_session_id IN(SELECT ac_session_id FROM $reval.reval_sessions) AND ac_sub_code IN(SELECT ac_sub_code FROM sub_distribution WHERE sub_id IN(SELECT distinct(sub_id) FROM $reval.reval_subjects)))";
                $get_sub_reval_run = mysqli_query($conn, $get_sub_reval);
                while ($reval_sub = mysqli_fetch_assoc($get_sub_reval_run)) {
                    echo ('<option value="' . $reval_sub['sub_code'] . '">' . $reval_sub['sub_name'] . '</option>');
                }

                break;
            case 'atkt':
                $get_sub_atkt = "SELECT sub_code, sub_name FROM subjects WHERE ac_session_id IN (SELECT ac_session_id FROM academic_sessions WHERE course_id=" . $_SESSION['current_course_id'] . " AND current_semester=" . $_POST['semester'] . " AND from_year=" . $_POST['from_year'] . " AND ac_session_id IN(SELECT ac_session_id FROM $atkt.atkt_sessions) AND ac_sub_code IN(SELECT ac_sub_code FROM sub_distribution WHERE sub_id IN(SELECT distinct(sub_id) FROM $atkt.atkt_subjects)))";
                $get_sub_atkt_run = mysqli_query($conn, $get_sub_atkt);
                while ($atkt_sub = mysqli_fetch_assoc($get_sub_atkt_run)) {
                    echo ('<option value="' . $atkt_sub['sub_code'] . '">' . $atkt_sub['sub_name'] . '</option>');
                }

                break;

            default:
                die("Error Encountered!");
                break;
        }
    }
}

if (isset($_POST['getComponent'])) {
    if ($_POST['from_year'] and $_POST['main_atkt'] and $_POST['semester'] and $_POST['sub_code']) {
        $examType = $_POST['main_atkt'];
        $ac_sess_id = "SELECT ac_session_id FROM academic_sessions WHERE course_id=" . $_SESSION['current_course_id'] . " AND from_year=" . $_POST['from_year'] . " AND current_semester=" . $_POST['semester'];
        $ac_sess_id = mysqli_query($conn, $ac_sess_id);
        $ac_sess_id = mysqli_fetch_assoc($ac_sess_id)['ac_session_id'];
        switch ($examType) {
            case 'main':
                $get_sub_comp = "SELECT component_id, component_name FROM component WHERE component_id IN 
            (SELECT component_id FROM component_distribution WHERE sub_id IN
            (SELECT sub_id FROM sub_distribution WHERE ac_sub_code IN(SELECT ac_sub_code FROM subjects WHERE sub_code='" . $_POST['sub_code'] . "' AND ac_session_id=$ac_sess_id)))";
                $get_sub_comp_run = mysqli_query($conn, $get_sub_comp);
                while ($sub_comp = mysqli_fetch_assoc($get_sub_comp_run)) {
                    $sub_code = $_POST['sub_code'];
                    $check_filled = "SELECT COUNT(*) FROM score WHERE sub_id IN(SELECT sub_id FROM sub_distribution WHERE ac_sub_code IN(SELECT ac_sub_code FROM subjects WHERE sub_code='" . $sub_code . "' AND ac_session_id=$ac_sess_id)) AND component_id=" . $sub_comp['component_id'] . " AND roll_id IN (SELECT roll_id FROM roll_list WHERE enrol_no IN (SELECT enrol_no FROM students WHERE ac_session_id=$ac_sess_id))";
                    $check_filled_run = mysqli_query($conn, $check_filled);
                    $count = mysqli_fetch_assoc($check_filled_run);
                    if ($count['COUNT(*)'] == 0) {
                        echo ('<option value="' . $sub_comp['component_id'] . '">' . $sub_comp['component_name'] . '</option>');
                    } else {
                        echo ('<option class="fa" value="' . $sub_comp['component_id'] . '" disabled>' . $sub_comp['component_name'] . ' (Already filled &#xf00c; )</option>');
                    }
                }
                break;
            case 'retotal':
                $get_sub_comp = "SELECT component_id, component_name FROM component WHERE component_id IN 
            (SELECT component_id FROM component_distribution WHERE sub_id IN
            (SELECT sub_id FROM sub_distribution WHERE ac_sub_code IN(SELECT ac_sub_code FROM subjects WHERE sub_code='" . $_POST['sub_code'] . "' AND ac_session_id=$ac_sess_id))) AND (component_id IN(2)) ";
                $get_sub_comp_run = mysqli_query($conn, $get_sub_comp);
                while ($sub_comp = mysqli_fetch_assoc($get_sub_comp_run)) {
                    $sub_code = $_POST['sub_code'];
                    /*$check_filled = "SELECT COUNT(*) FROM $retotal.retotal_subjects WHERE sub_id IN(SELECT sub_id FROM sub_distribution WHERE ac_sub_code IN(SELECT ac_sub_code FROM subjects WHERE sub_code='" . $sub_code . "' AND ac_session_id=$ac_sess_id) AND component_id=" . $sub_comp['component_id'] . " AND roll_id IN 
                    (SELECT roll_id FROM roll_list WHERE enrol_no IN (SELECT enrol_no FROM students WHERE ac_session_id=$ac_sess_id))";
                    $check_filled_run = mysqli_query($conn, $check_filled);
                    $count = mysqli_fetch_assoc($check_filled_run);
                    if ($count['COUNT(*)'] == 0) {
                     */ echo ('<option value="' . $sub_comp['component_id'] . '">' . $sub_comp['component_name'] . '</option>');
                    /*} else {
                       echo ('<option class="fa" value="' . $sub_comp['component_id'] . '" disabled>' . $sub_comp['component_name'] . ' (Already filled &#xf00c; )</option>');
                    }*/
                }
                break;
            case 'reval':
                $get_sub_reval = "SELECT sub_code, sub_name FROM subjects WHERE ac_session_id IN (SELECT ac_session_id FROM academic_sessions WHERE course_id=" . $_SESSION['current_course_id'] . " AND current_semester=" . $_POST['semester'] . " AND from_year=" . $_POST['from_year'] . " AND ac_session_id IN(SELECT ac_session_id FROM $reval.reval_sessions) AND ac_sub_code IN(SELECT ac_sub_code FROM sub_distribution WHERE sub_id IN(SELECT distinct(sub_id) FROM $reval.reval_subjects)))";
                $get_sub_reval_run = mysqli_query($conn, $get_sub_reval);
                while ($reval_sub = mysqli_fetch_assoc($get_sub_reval_run)) {
                    echo ('<option value="' . $reval_sub['sub_code'] . '">' . $reval_sub['sub_name'] . '</option>');
                }

                break;
            case 'atkt':
                $ac_sess_id = "SELECT ac_session_id FROM academic_sessions WHERE course_id=" . $_SESSION['current_course_id'] . " AND from_year=" . $_POST['from_year'] . " AND current_semester=" . $_POST['semester'];
                $ac_sess_id = mysqli_query($conn, $ac_sess_id);
                $ac_sess_id = mysqli_fetch_assoc($ac_sess_id)['ac_session_id'];
                $get_comp_atkt = "SELECT component_id,component_name FROM component WHERE component_id IN(SELECT DISTINCT(component_id) FROM atkt_subjects WHERE atkt_roll_id IN(SELECT atkt_roll_id FROM atkt_sessions WHERE ac_session_id=$ac_sess_id) AND sub_id IN(SELECT sub_id FROM sub_distribution WHERE ac_sub_code IN(SELECT ac_sub_code FROM subjects WHERE sub_code='".$_POST['sub_code']."' AND ac_session_id=$ac_sess_id)))";
                $get_comp_atkt_run = mysqli_query($conn, $get_comp_atkt);
                while ($comp = mysqli_fetch_assoc($get_comp_atkt_run)) {
                    $check_filled = "SELECT count(*) FROM auditing WHERE type_flag=3 AND ac_sub_code IN(SELECT ac_sub_code FROM subjects WHERE sub_code='" . $_POST['sub_code'] . "' AND ac_session_id=$ac_sess_id) AND component_id=" . $comp['component_id'] . " AND session_id IN(SELECT atkt_session_id FROM atkt_sessions WHERE ac_session_id=$ac_sess_id)";
                    $check_filled_run = mysqli_query($conn, $check_filled);
                    if (mysqli_fetch_assoc($check_filled_run)['count(*)'] > 0) {
                        echo ('<option class="fa" disabled>' . $comp['component_name'] . ' (Already filled &#xf00c; )</option>');
                    } else {

                        echo ("<option value='" . $comp['component_id'] . "'>" . $comp['component_name'] . "</option>");
                    }
                }
                break;

            default:
                die("Error Encountered!");
                break;
        }
        if ($_POST['main_atkt'] == 'main') {

        } else if ($_POST['main_atkt'] == 'atkt') {
            $get_atkt_sub_comp = "SELECT component_id, component_name FROM component WHERE component_id IN
            (SELECT DISTINCT(component_id) FROM atkt_subjects WHERE roll_id IN
            (SELECT roll_id FROM atkt_list WHERE enrol_no IN
            (SELECT enrol_no FROM students WHERE course_id=" . $_SESSION['current_course_id'] . " AND from_year=" . $_POST['from_year'] . " AND current_sem=" . $_POST['semester'] . ")))";
        }
    }
}
if (isset($_POST['get_ay'])) {
    $get_course_years = "SELECT distinct(from_year) FROM academic_sessions WHERE course_id=" . $_POST['get_ay'];
    $get_course_years_run = mysqli_query($conn, $get_course_years);
    if ($get_course_years_run && mysqli_num_rows($get_course_years_run) > 0) {
        while ($row = mysqli_fetch_assoc($get_course_years_run)) {
            echo ('<option value="' . $row['from_year'] . '" >' . $row['from_year'] . '</option>   
                ');
        }
    } else {
        echo ('<option disabled>No academic session!</option>');
    }
}

?>

