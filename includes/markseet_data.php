<?php 
    $roll_id = $_SESSION['roll_id'];
    $from_year = $_SESSION['from_year'];
    $semester = $_SESSION['semester'];

    $get_stud_detail="SELECT `enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `course_id`, `from_year`, `current_sem`, `cgpa` FROM students WHERE enrol_no = 
                    (SELECT enrol_no FROM roll_list WHERE roll_id = $roll_id)";
    $get_stud_detail_run=mysqli_query($conn,$get_stud_detail);
    $get_subjects_opted="SELECT sub_code, sub_name FROM subjects WHERE (course_id=$course_id AND semester=$semester) AND ((elective_flag=0) OR (elective_flag=1 AND sub_code IN (SELECT sub_code FROM elective_map WHERE enrol_no=$enrol_no))";
    $get_subjects_opted_run=mysqli_query($conn,$get_subjects_opted);
    while($sub=mysqli_fetch_assoc($get_subjects_opted_run))
    {
        
    }
?>