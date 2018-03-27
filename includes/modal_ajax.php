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

if(isset($_POST['prev_sub_load'])){
    $year=$_POST['year']-1;
    $course_id=$_POST['course'];
    $sem=$_POST['semester'];
    $get_prev_sub="SELECT * from subjects WHERE ac_session_id IN(SELECT ac_session_id FROM academic_sessions WHERE from_year=$year AND course_id=$course_id AND current_semester=$sem)";
    $get_prev_sub_run=mysqli_query($conn,$get_prev_sub);
    $i=1;
    $result = new \stdClass();
    $result->data=null;
    $result->status=0;
    $result->rowcount=0;
    if(mysqli_num_rows($get_prev_sub_run)!=0){
        while($subject=mysqli_fetch_assoc($get_prev_sub_run)){
            $result->data.='
            <tr>
            <td>
            <input type="text" name="subcode'.$i.'" id="subcode'.$i.'" class="form-control" required value="'.$subject['sub_code'].'">
            </td>
            <td>
            <input type="text" name="subname'.$i.'" id="subname'.$i.'" class="form-control" required value="'.$subject['sub_name'].'">
            </td>
            <td>
            <select name="type'.$i.'" id="type'.$i.'" class="form-control" onchange="check_credits(this,'.$i.')">            
            <option value="theory">Theory</option>
                <option value="practical">Practical</option>
            <option value="both" selected>Both</option>         
                </select>
            </td>
            
            <td>
            <input type="number" name="theory'.$i.'" id="theory'.$i.'" class="form-control" onkeyup="total('.$i.')" onchange="total('.$i.'); validate(this,100)" onfocusout="validate_focus(this,100)" required>
            </td>
            <td>
            <input type="number" name="practical'.$i.'" id="practical'.$i.'" class="form-control" onkeyup="total('.$i.')" onchange="total('.$i.'); validate(this,100)" onfocusout="validate_focus(this,100)" required> 
            </td>
            <td><input id="total'.$i.'" name="total'.$i.'" class="form-control disabled" readonly type="number"></td>
            <td style="text-align: center">
            ';
            if($subject['ie_flag']==1){
                $result->data.='<input type="checkbox" name="ie'.$i.'" id="ie'.$i.'" class="form-control" onchange="disable_credits(this,'.$i.')" checked>
                ';
            }
            else{
                $result->data.='<input type="checkbox" name="ie'.$i.'" id="ie'.$i.'" class="form-control" onchange="disable_credits(this,'.$i.')">
                ';
            }
            $result->data.='
            </td>
            <td style="text-align: center">
            ';
            if($subject['elective_flag']==1){
                $result->data.='<input type="checkbox" name="elective'.$i.'" id="elective'.$i.'" class="form-control" checked>
                ';
            }else{
                $result->data.='<input type="checkbox" name="elective'.$i.'" id="elective'.$i.'" class="form-control">
                ';
            }
            $result->data.='
            </td> 
            ';
            $i++;
        }
        $result->rowcount=--$i;
        $result->status=1;
    }
    echo(json_encode($result));
}


?>