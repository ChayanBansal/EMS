<?php
require('config.php');
require('class_lib.php');
if(isset($_POST['session_display'])){
    $input=new input_field();
    switch($_POST['type']){
        case 'main':
        echo('<div class="form-group">
                <label for="name">Academic Year</label>
                <input type="number" name="session_year" min="2016" class="form-control" required>
            </div>
                <div class="form-group">
                <label for="type">Course Name</label>
                <select name="session_course" id="type" class="form-control" required>
                ');
                $get_details_qry = "SELECT course_id,course_name from courses";
                $get_details_qry_run = mysqli_query($conn, $get_details_qry);
                if ($get_details_qry_run) {
                  while ($row = mysqli_fetch_assoc($get_details_qry_run)) {
                    echo ('
                        <option value="' . $row['course_id'] . '">' . $row['course_name'] . '</option>
                        ');
                  }
                } else {
                  $alert = new alert();
                  $alert->exec("Unable to fetch session courses....", "warning");
                }
                echo('</select>
                </div>
                <div class="form-group">
                <label for="semester">Semester</label>
                ');
                $input->display_table("semester", "form-control", "number", "session_semester", "", 1, 0, 8, 0, 8);
                echo('
                </div>
            </div>');
            break;
        case 'reval':
        case 'atkt':
        case 'retotal':
        echo('<div class="form-group">
                <label for="name">Academic Year</label>
                <select name="session_year" id="type" class="form-control" required onclick="get_session_display_sem(this.value)">
                ');
            $get_session_batch="SELECT distinct(from_year) FROM academic_sessions";
            $get_session_batch_run=mysqli_query($conn,$get_session_batch);
            while($batch=mysqli_fetch_assoc($get_session_batch_run)){
                echo ('
                <option value="' . $batch['from_year'] . '">' . $batch['from_year'] . '</option>
                ');
            }
            echo('</select>
                </div>
                <div class="form-group">
                <label for="type">Course Name</label>
                <select name="session_course" id="session_course" class="form-control" required>
                <option disabled>Select Course</option>');
                echo('</select>
                </div>
                <div class="form-group">
                <label for="semester">Semester</label>
                ');
                $input->display_table("semester", "form-control", "number", "session_semester", "", 1, 0, 8, 0, 8);
                echo('
                </div>
            </div>');
        
        break;
        

    }
}

if(isset($_POST['session_year'])){
    $year=$_POST['year'];
    $get_courses="SELECT course_name,course_id FROM courses WHERE course_id IN(SELECT distinct(course_id) FROM academic_sessions WHERE from_year=$year)";
    $get_courses_run=mysqli_query($conn,$get_courses);
    echo('<option disabled selected>Select Course</option>');
    while($course=mysqli_fetch_assoc($get_courses_run)){
        echo ('
                <option value="' . $course['course_id'] . '">' . $course['course_name'] . '</option>
                ');
    }
}

?>