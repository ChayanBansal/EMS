<?php
// getting semester 
session_start();
require('config.php');
require('class_lib.php');
if ($_POST['getType'] == 1) {
    if ($_POST['from_year']) {
        $from_year = $_POST['from_year'];
        $get_semester = "SELECT current_semester FROM academic_sessions WHERE from_year=" . $from_year . " AND course_id=" . $_SESSION['current_course_id'];
        $get_semester_run = mysqli_query($conn, $get_semester);
        $result = mysqli_fetch_assoc($get_semester_run);
        if ($result['current_semester'] == 1) {
            echo ('<option value="" disabled selected>Select Type</option>');
            echo ('<option value="main" >Main</option>');
        } else {
            echo ('<option value="" disabled selected>Select Type</option>');
            echo ('<option value="main" >Main</option>');
            echo ('<option value="atkt" >ATKT</option>');
        }
    }
}
if ($_POST['getSemester'] == 1) {
    if ($_POST['from_year'] and $_POST['main_atkt']) {
        echo ('<option value="" disabled selected>Select Semester</option>');
        $from_year = $_POST['from_year'];
        $examType = $_POST['main_atkt'];
        if ($examType == 'main') {
            $get_semester = "SELECT current_semester FROM academic_sessions WHERE from_year=" . $from_year . " AND course_id=" . $_SESSION['current_course_id'];
            $get_semester_run = mysqli_query($conn, $get_semester);
            $result = mysqli_fetch_assoc($get_semester_run);
            $_SESSION['selected_semester'] = $result['current_semester'];
            $temp = $result['current_semester'];
            echo ('<option name="selected_semester" value="' . $temp . '" >' . $temp . '</option>');
        } else if ($examType == 'atkt') {
            $get_atkt_sem = "SELECT DISTINCT(semester) FROM atkt_list WHERE enrol_no IN(SELECT enrol_no FROM students WHERE course_id=" . $_SESSION['current_course_id'] . " AND from_year=" . $from_year . ")";
            $get_atkt_run = mysqli_query($conn, $get_atkt_sem);
            while ($atkt_sem = mysqli_fetch_assoc($get_atkt_run)) {
                echo ('<option name="selected_semester" value="' . $atkt_sem['semester'] . '">' . $atkt_sem['semester'] . '</option>');
            }
        }
    }
}

if ($_POST['getSubject'] == 1) {
    if ($_POST['from_year'] and $_POST['main_atkt'] and $_POST['semester']) {
        echo ('<option value="">Select Subject</option>');
        if ($_POST['main_atkt'] == 'main') {
            $get_sub_main = "SELECT sub_code, sub_name FROM subjects WHERE course_id=" . $_SESSION['current_course_id'] . " AND semester=" . $_POST['semester'] . " AND from_year=" . $_POST['from_year'];
            $get_sub_main_run = mysqli_query($conn, $get_sub_main);
            while ($main_sub = mysqli_fetch_assoc($get_sub_main_run)) {
                echo ('<option value="' . $main_sub['sub_code'] . '">' . $main_sub['sub_name'] . '</option>');
            }
        } else if ($_POST['main_atkt'] == 'main') {
            $get_atkt_sub = "SELECT sub_code, sub_name FROM subjects WHERE sub_code IN 
                            (SELECT DISTINCT(sub_code) FROM sub_distribution WHERE sub_id IN
                            (SELECT sub_id FROM atkt_subjects WHERE roll_id IN
                            (SELECT roll_id FROM atkt_list WHERE semester=" . $_POST['semester'] . " AND enrol_no IN
                            (SELECT enrol_no FROM students WHERE course_id=" . $_SESSION['current_course_id'] . " AND from_year=" . $_POST['from_year'] . " AND current_sem=" . $_POST['semester'] . "))))";
            $get_atkt_sub_run = mysqli_query($conn, $get_atkt_sub);
            while ($atkt_sub = mysqli_fetch_assoc($get_atkt_sub_run)) {
                echo ('<option value="' . $atkt_sub['sub_code'] . '">' . $atkt_sub['sub_name'] . '</option>');
            }
        }
    }
}

//data: 'getSubject=0'+'&semester='+semester+'&from_year='+batch+'&main_atkt='+main_atkt+'&getType=0&getComponent=1&getSemester=0'+'&sub_code='+sub_code,
if ($_POST['getComponent']) {
    echo ('<option value="" disabled selected>Select Component</option>');
    if ($_POST['from_year'] and $_POST['main_atkt'] and $_POST['semester'] and $_POST['sub_code']) {
        if ($_POST['main_atkt'] == 'main') {
            $get_sub_comp = "SELECT component_id, component_name FROM component WHERE component_id IN 
                                (SELECT component_id FROM component_distribution WHERE sub_id IN
                                (SELECT sub_id FROM sub_distribution WHERE sub_code='" . $_POST['sub_code'] . "'))"; 
                                /*SELECT component_id, component_name FROM component WHERE component_id IN 
                                (SELECT component_id FROM component_distribution WHERE sub_id IN
                                (SELECT sub_id FROM sub_distribution WHERE sub_code='BTCS003003'))*/
            $get_sub_comp_run = mysqli_query($conn, $get_sub_comp);
            while ($sub_comp = mysqli_fetch_assoc($get_sub_comp_run)) {
                $sub_code = $_POST['sub_code'];
                $check_filled = "SELECT COUNT(*) FROM score WHERE sub_id IN(SELECT sub_id FROM sub_distribution WHERE sub_code='" . $sub_code . "') AND component_id=" . $sub_comp['component_id'] . " AND roll_id IN 
                                (SELECT roll_id FROM roll_list WHERE enrol_no IN (SELECT enrol_no FROM students WHERE from_year=" . $_POST['from_year'] . " AND course_id=" . $_SESSION['current_course_id'] . "))";
                $check_filled_run = mysqli_query($conn, $check_filled);
                $count = mysqli_fetch_assoc($check_filled_run);
                if ($count['COUNT(*)'] == 0) {
                    echo ('<option value="' . $sub_comp['component_id'] . '">' . $sub_comp['component_name'] . '</option>');
                } else {
                    echo ('<option class="fa" value="' . $sub_comp['component_id'] . '" disabled>' . $sub_comp['component_name'] . ' (Already filled &#xf00c; )</option>');
                }
            }
        } else if ($_POST['main_atkt'] == 'atkt') {
            $get_atkt_sub_comp = "SELECT component_id, component_name FROM component WHERE component_id IN
            (SELECT DISTINCT(component_id) FROM atkt_subjects WHERE roll_id IN
            (SELECT roll_id FROM atkt_list WHERE enrol_no IN
            (SELECT enrol_no FROM students WHERE course_id=" . $_SESSION['current_course_id'] . " AND from_year=" . $_POST['from_year'] . " AND current_sem=" . $_POST['semester'] . ")))";
        }
    }
}
if (isset($_POST['get_ay'])) {
    $get_course_years = "SELECT distinct(from_year) FROM students WHERE course_id=" . $_POST['get_ay'];
    $get_course_years_run = mysqli_query($conn, $get_course_years);
    if ($get_course_years_run) {
        while ($row = mysqli_fetch_assoc($get_course_years_run)) {
            echo ('<option value="' . $row['from_year'] . '" >' . $row['from_year'] . '</option>   
                ');
        }
    }
}

?>