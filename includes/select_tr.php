<?php
require('config.php');
if (isset($_POST['tr_getFromYear'])) {
    if ($_POST['tr_getFromYear'] == 1 and isset($_POST['course_id'])) {
        $get_from_year = "SELECT DISTINCT(from_year) FROM students WHERE course_id=" . $_POST['course_id'] . " AND enrol_no IN 
                        (SELECT enrol_no FROM roll_list WHERE roll_id IN
                        (SELECT DISTINCT(roll_id) FROM tr))";
        $get_from_year_run = mysqli_query($conn, $get_from_year);
        echo ('<option value="" disabled selected>Select Batch</option>');
        while ($from_year = mysqli_fetch_assoc($get_from_year_run)) {
            echo ('<option value="' . $from_year['from_year'] . '">' . $from_year['from_year'] . '</option>');
        }
    }
    //tr_getSemester=1&course_id='+tr_course_id+'&from_year='+tr_from_year+'&type='+tr_type
    if ($_POST['tr_getSemester'] == 1 and isset($_POST['course_id']) and isset($_POST['from_year']) and isset($_POST['type'])) {
        $get_semester = "SELECT DISTINCT(semester) FROM roll_list WHERE enrol_no IN (SELECT enrol_no FROM students WHERE course_id=" . $_POST['course_id'] . " AND from_year=" . $_POST['from_year'] . ")";
        $get_semester_run = mysqli_query($conn, $get_semester);
        while ($semester = mysqli_fetch_assoc($get_semester_run)) {
            echo ('<option value="' . $semester['semester'] . '">' . $semester['semester'] . '</option>');
        }
    }
}
if (isset($_POST['tr_gen_type'])) {
    if ($_POST['tr_type'] === "main") {
        $get_batch = "SELECT distinct(from_year) FROM academic_sessions";
        $get_batch_run = mysqli_query($conn, $get_batch);
        if (mysqli_num_rows($get_batch_run) == 0) {
            echo ('<option disabled selected">No sessions found!</option>');
        } else {
            while ($batch = mysqli_fetch_assoc($get_batch_run)) {
                echo ('<option value="' . $batch['from_year'] . '">' . $batch['from_year'] . '</option>');
            }
        }

    } else if ($_POST['tr_type'] === "atkt") {
        $get_batch = "SELECT distinct(from_year) FROM $main.academic_sessions WHERE ac_session_id IN(SELECT ac_session_id FROM $atkt.atkt_sessions)";
        $get_batch_run = mysqli_query($conn, $get_batch);
        if (mysqli_num_rows($get_batch_run) == 0) {
            echo ('<option disabled selected">No sessions found!</option>');
        } else {
            while ($batch = mysqli_fetch_assoc($get_batch_run)) {
                echo ('<option value="' . $batch['from_year'] . '">' . $batch['from_year'] . '</option>');
            }
        }

    }
}
if(isset($_POST['tr_gen_batch'])){
    if ($_POST['tr_type'] === "main") {
        $get_course = "SELECT course_id,course_name FROM courses WHERE course_id IN(SELECT distinct(course_id) FROM academic_sessions WHERE from_year=".$_POST['tr_batch'].")";
        $get_course_run = mysqli_query($conn, $get_course);
        if (mysqli_num_rows($get_course_run) == 0) {
            echo ('<option disabled selected">No courses found!</option>');
        } else {
            while ($batch = mysqli_fetch_assoc($get_course_run)) {
                echo ('<option value="' . $batch['course_id'] . '">' . $batch['course_name'] . '</option>');
            }
        }

    } else if ($_POST['tr_type'] === "atkt") {
        $get_course = "SELECT course_id,course_name FROM $main.courses WHERE course_id IN(SELECT distinct(course_id) FROM $main.academic_sessions WHERE from_year=".$_POST['tr_batch']." AND ac_session_id IN(SELECT ac_session_id FROM $atkt.atkt_sessions))";
        $get_course_run = mysqli_query($conn, $get_course);
        if (mysqli_num_rows($get_course_run) == 0) {
            echo ('<option disabled selected">No courses found!</option>');
        } else {
            while ($batch = mysqli_fetch_assoc($get_course_run)) {
                echo ('<option value="' . $batch['course_id'] . '">' . $batch['course_name'] . '</option>');
            }
        }

    }
}
?>