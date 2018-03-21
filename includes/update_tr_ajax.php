<?php
require('config.php');
require('class_lib.php');
if (isset($_POST['tr_subcode'])) {
    $get_comp = "SELECT component_id,component_name FROM component WHERE component_id IN(SELECT component_id FROM component_distribution WHERE sub_id IN(SELECT sub_id FROM sub_distribution WHERE sub_code IN(SELECT sub_code FROM subjects WHERE sub_code='" . $_POST['tr_subcode'] . "')))";
    $get_comp_run = mysqli_query($conn, $get_comp);
    if ($get_comp_run) {
        $check_box = new input_field();
        while ($comp = mysqli_fetch_assoc($get_comp_run)) {
            echo ('<label class="checkbox-inline" style="font-weight: normal !important">
                  ');
            $check_box->display_w_value("", "", "checkbox","tr_update_check".$comp['component_id'],"",$comp['component_id'],0);
                echo ($comp['component_name'].'</label>');
        }
    }
    else{
        echo("Error! Unable to fetch components!");
    }
}
if(isset($_POST['sub_view'])){
    $cid=$_POST['course_id'];
    $get_ay="SELECT distinct(from_year) FROM academic_sessions WHERE course_id=$cid";
    $get_ay_run=mysqli_query($conn,$get_ay);
    if(mysqli_num_rows($get_ay_run)==0){
        echo("<option>No subjects found!</option>");
    }
    else{
        echo("<option disabled selected>Select academic year</option>");
        while($year=mysqli_fetch_assoc($get_ay_run)){
            echo('<option value="'.$year['from_year'].'">'.$year['from_year'].'</option>');
        }
    }
    
}
if(isset($_POST['sub_view_sem'])){
    $get_sem="SELECT current_semester as semester FROM academic_sessions WHERE course_id=".$_POST['course_id']." AND from_year=".$_POST['year'];
    $get_sem_run=mysqli_query($conn,$get_sem);
    if(mysqli_num_rows($get_sem_run)==0){
        echo("<option>No subjects found!</option>");
    }
    else{
        echo("<option disabled selected>Select semester</option>");
        while($sem=mysqli_fetch_assoc($get_sem_run)){
            echo('<option value="'.$sem['semester'].'">'.$sem['semester'].'</option>');    
        }
    }
    echo($get_sem);
}
if(isset($_POST['sub_view_disp'])){
    $get_subject="SELECT sub_code,sub_name,elective_flag,ie_flag FROM subjects WHERE ac_session_id IN(SELECT ac_session_id FROM academic_sessions WHERE course_id=".$_POST['course_id']." AND from_year=".$_POST['year']." AND current_semester=".$_POST['sem'].")";
    $get_subject_run=mysqli_query($conn,$get_subject);
    echo($_POST['course_id'].$_POST['year']);
    $i=1;
    while($subject=mysqli_fetch_assoc($get_subject_run)){
        $theory_cr="SELECT credits_allotted as credits FROM sub_distribution WHERE sub_code='".$subject['sub_code']."' AND practical_flag=0";
        $theory_cr=mysqli_query($conn,$theory_cr);
        if(mysqli_num_rows($theory_cr)==0){
            $tcr="-";
        }
        else{
            $tcr=mysqli_fetch_assoc($theory_cr)['credits'];
        }
        $prac_cr="SELECT credits_allotted as credits FROM sub_distribution WHERE sub_code='".$subject['sub_code']."' AND practical_flag=1";
        $prac_cr=mysqli_query($conn,$prac_cr);
        if(mysqli_num_rows($prac_cr)==0){
            $pcr="-";
        }
        else{
            $pcr=mysqli_fetch_assoc($prac_cr)['credits'];
        }
        echo('<tr style="text-align:center">
        <td>'.$subject['sub_code'].'</td>
        <td>'.$subject['sub_name'].'</td>
        <td>'.$tcr.'</td>
        <td>'.$pcr.'</td>');
        if($subject['ie_flag']==1){
            echo('<td>Yes <i class="glyphicon glyphicon-ok" style="color: darkgreen"></i></td>');    
        }else{
            echo('<td>No <i class="glyphicon glyphicon-remove" style="color: red"></i></td>');         
        }
        if($subject['elective_flag']==1){
            echo('<td>Yes<i class="glyphicon glyphicon-ok" style="color: darkgreen"></i></td>');    
        }else{
            echo('<td>No <i class="glyphicon glyphicon-remove" style="color: red"></i></td>');         
        }
        echo('<td><button class="btn btn-default" type="button" data-sub-code="'.$subject['sub_code'].'" data-sub-name="'.$subject['sub_name'].'" onclick="show_update_sub(this)" data-toggle="modal" data-target="#updatesubjectdialog"><i class="glyphicon glyphicon-edit"></i></button></td>
        </tr>');
        $i++;
    }
}
?>