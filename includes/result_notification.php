<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require("config.php");
require("class_lib.php");
//AJAX CALL PROCESSING
if(isset($_POST["getSemester"]))
{
    if($_POST["getSemester"]==='1')
    {
        if(isset($_POST["type"]) AND isset($_POST["course_id"]) AND isset($_POST["from_year"]))
        {
            $input_clear = new input_check();
            $type=$input_clear->input_safe($conn,$_POST['type']);
            $course_id=$input_clear->input_safe($conn,$_POST['course_id']);
            $from_year=$input_clear->input_safe($conn,$_POST['from_year']);
            
            if($type==='1') //Main
            {
                $get_semester="SELECT current_semester FROM academic_sessions WHERE from_year=$from_year AND course_id=$course_id";
            }
            else if($type==='2') //retotal
            {
                $get_semester="SELECT current_semester FROM academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND ac_session_id IN(SELECT ac_session_id FROM retotal_sessions)";
            }
            else if($type==='3') //reval
            {
                $get_semester="SELECT current_semester FROM academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND ac_session_id IN(SELECT ac_session_id FROM reval_sessions)";
            }
            else if($type==='4') //atkt
            {
                $get_semester="SELECT current_semester FROM academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND ac_session_id IN(SELECT ac_session_id FROM atkt_sessions)";
            }

            $get_semester_run=mysqli_query($conn,$get_semester);
            if($get_semester_run!=FALSE)
            {
                if(mysqli_num_rows($get_semester_run)>0)
                {
                    foreach($get_semester_run as $semester)
                    {
                        echo("<option value=".$semester["current_semester"].">".$semester["current_semester"]."</option>");
                    }
                }
                else
                {
                    echo("<option value='' disabled> No records to show </option>");
                }
            }
            else
            {
                echo("<option value='' disabled> No records to show </option>");
            }
        }
    }
    else
    {
        echo("<option value='' disabled> No records to show </option>");
    }
}

else if(isset($_POST["getFromYear"]))
{
    if($_POST["getFromYear"]==='1')
    {
        if(isset($_POST["type"]) AND isset($_POST["course_id"]))
        {
            $input_clear = new input_check();
            $type=$input_clear->input_safe($conn,$_POST['type']);
            $course_id=$input_clear->input_safe($conn,$_POST['course_id']);
            
            if($type==='1') //Main
            {
                $get_from_year="SELECT DISTINCT(from_year) FROM academic_sessions WHERE course_id=$course_id";
            }
            else if($type==='2') //retotal
            {
                $get_from_year="SELECT DISTINCT(from_year) FROM academic_sessions WHERE course_id=$course_id AND ac_session_id IN(SELECT ac_session_id FROM retotal_sessions)";
            }
            else if($type==='3') //reval
            {
                $get_from_year="SELECT DISTINCT(from_year) FROM academic_sessions WHERE course_id=$course_id AND ac_session_id IN(SELECT ac_session_id FROM reval_sessions)";
            }
            else if($type==='4') //atkt
            {
                $get_from_year="SELECT DISTINCT(from_year) FROM academic_sessions WHERE course_id=$course_id AND ac_session_id IN(SELECT ac_session_id FROM atkt_sessions)";
            }

            $get_from_year_run=mysqli_query($conn,$get_from_year);
            if($get_from_year_run!=FALSE)
            {
                if(mysqli_num_rows($get_from_year_run)>0)
                {
                    foreach($get_from_year_run as $from_year)
                    {
                        echo("<option value=".$from_year["from_year"].">".$from_year["from_year"]."</option>");
                    }
                }
            }
        }
    }
    else
    {
        echo("<option value='' disabled> No records to show</option>");
    }
}
//AJAX CALL PROCESSING END


elseif(isset($_POST["notify_students"]))
{
    
    $input_clear = new input_check();
    $type=$input_clear->input_safe($conn,$_POST['rn_type']);
    $course_id=$input_clear->input_safe($conn,$_POST['rn_course']);
    $from_year=$input_clear->input_safe($conn,$_POST['rn_from_year']);
    $semester=$input_clear->input_safe($conn,$_POST['rn_semester']);
    $get_course_name="SELECT course_name FROM $main.courses WHERE course_id=$course_id";
    $get_course_name_run=mysqli_query($conn,$get_course_name);
    if($get_course_name_run!=FALSE)
    {
        $course_name_result=mysqli_fetch_assoc($get_course_name_run);
        $course_name=$course_name_result["course_name"];
        if($type==='1') //Main
        {
            $get_ac_session_id="SELECT ac_session_id FROM $main.academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND current_semester=$semester";
            $get_ac_session_id_run=mysqli_query($conn,$get_ac_session_id);
            if($get_ac_session_id!=FALSE)
            {
                
                foreach($get_ac_session_id_run as $session_id)
                {
                    $ac_session_id=$session_id["ac_session_id"];
                    
                    $date=date("Y-m-d");
                    $insert_into_issue_summary="INSERT INTO $main.issue_summary(session_id,notification_date,type_flag) VALUES($ac_session_id, '".$date."', 1)";
                    $insert_into_issue_summary_run=mysqli_query($conn,$insert_into_issue_summary);
                    if($insert_into_issue_summary_run!=FALSE)
                    {
                        $get_students="SELECT r.roll_id, r.atkt_flag, r.enrol_no, s.email_id, s.first_name, s.last_name FROM $main.roll_list r, $main.students s WHERE s.ac_session_id=$ac_session_id AND s.enrol_no=r.enrol_no AND r.semester=$semester";
                        $get_students_run=mysqli_query($conn,$get_students);
                        
                        if($get_students_run!=FALSE)
                        {
                            
                            //Load composer's autoloader
                            require 'phpmailer/vendor/autoload.php';
                            function Mail_text($conn,$main,$email, $enrol_no, $roll_id ,$atkt_flag,$f_name, $l_name, $course_name, $from_year, $semester, $date){
                                
                                $mail="";
                                //require("frontend_lib.php");
                                $mail.='<html>
                                <head>
                                <style>
                                body
                                {
                                    text-align:center;
                                    
                                }
                                .text{
                                    color: #000000;
                                    line-height: 150%;
                                    margin: 10px;
                                font-family: Georgia, Times, "Times New Roman", serif;
                                font-size: 16px;
                                text-align: left;
                                display: flex;
                                justify-content: space-between;
                                }
                                .title{
                                    font-size: 20px;
                                    color: #2A458E;
                                    font-family: "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Geneva, Verdana, sans-serif;
                                    font-weight: 400;
                                    line-height: 33px;
                                    display:flex;
                                    justify-content: center;
                                    
                                }
                                .mcontainer{
                                    padding: 10px;
                                    display: flex;
                                justify-content: center;
                                border: 10px solid navy;
                                }
                                .mailcontainer{
                                    font-size: 24px !important;
                                    width: 610px !important;
                                    min-height: 70px !important;
                                    padding: 5px !important;
                                    text-align: center;
                                    background: white;
                                    font-family: "Open Sans", sans-serif;
                                    align-items: center;
                                    margin-bottom:30px;
                                
                                }
                                .portal{
                                    font-size: 18px;
                                line-height: 27px;
                                color: #555555;;
                                border-bottom: 1px solid black;
                                margin: 15px;
                                display: flex;
                                justify-content: space-between;
                                }
                                #hr{
                                    color: #1978C8;
                                    border: 2px solid #1978C8;
                                    width: 100%;
                                }
                            
                                
                                .details{
                                    margin: 10px;
                                    padding: 10px;
                                    border: 2px dashed black;
                                    font-weight: bolder;
                                    font-family: "Open Sans", sans-serif;
                                    text-decoration: none;
                                    font-size: 16px;
                                    line-height: 33px;
                                    width: 100%;
                                    margin: 20px;
                                }
                                .note{
                                    line-height: 15px;
                                font-size: 16px;
                                color: #555555;
                                font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                                text-align: left;
                                }
                                ol li{
                                    line-height: 18px;
                                    margin: 10px;
                                }
                                </style>
                                </head>
                                <body>
                                <div class="mcontainer">
                                <div class="mailcontainer">
                                <div class="title"><span>Symbiosis University Of Applied Sciences</span><br><span>Office of COE</span></div>
                                <hr id="hr">
                                <div class="portal">Result Notification - MAIN <span>'.$date.'</span></div>
                                <div class="text">

                                <table>
                                        <tr>
                                            <td>Enrollment </td>
                                            <td>'.$enrol_no.'</td>
                                        </tr>
                                        <tr>
                                            <td>Name </td>
                                            <td>'.$f_name.' '.$l_name.'</td>
                                        </tr>
                                        <tr>
                                            <td>Course </td>
                                            <td>'.$course_name.'</td>
                                        </tr>
                                        <tr>
                                            <td>Start Year (Batch) </td>
                                            <td>'.$from_year.'</td>
                                        </tr>
                                        <tr>
                                            <td>Semester </td>
                                            <td>'.$semester.'</td>
                                        </tr>';
                                                                
                                    if($atkt_flag==='1')
                                    {
                                        $get_atkt_subjects="SELECT DISTINCT(sub_id) FROM failure_report WHERE roll_id=$roll_id";
                                        $get_atkt_subjects_run=mysqli_query($conn,$get_atkt_subjects);
                                        if($get_atkt_subjects_run!=FALSE)
                                        {
                                            if(mysqli_num_rows($get_atkt_subjects_run)>0)
                                            {
                                                $atkt_subjects=mysqli_fetch_assoc($get_atkt_subjects_run);
                                                $get_sub_detail="SELECT s.sub_name, s.sub_code, sd.practical_flag FROM subjects s, sub_distribution sd WHERE s.ac_sub_code=sd.ac_sub_code AND sd.sub_id IN(".implode(',',$atkt_subjects) .")";
                                                $get_sub_detail_run=mysqli_query($conn,$get_sub_detail);
                                                if($get_sub_detail_run!=FALSE)
                                                {
                                                    $mail.='<tr>
                                                    <td>Fail in </td> <td><ol>';
                                                    foreach($get_sub_detail_run as $sub_detail)
                                                    {
                                                        $mail.='<li>'. $sub_detail["sub_code"].' '. $sub_detail["sub_name"];
                                                        if($sub_detail["practical_flag"]==='1')
                                                        {
                                                            $mail.=' [PRACTICAL]';
                                                        }
                                                        elseif($sub_detail["practical_flag"]==='0')
                                                        {
                                                            $mail.=' [THEORY]';
                                                        }
                                                        elseif($sub_detail["practical_flag"]==='2')
                                                        {
                                                            $mail.=' [IE]';
                                                        }
                                                        '</li>';
                                                    }
                                                    $mail.='</ol></td>
                                                    </tr>';
                                                }
                                            }
                                        }
                                    }
                                    else
                                    {
                                        $mail.='<tr>
                                        <td>SGPA </td>
                                        ';
                                        $get_sgpa="SELECT sgpa FROM $main.exam_summary WHERE roll_id=$roll_id";
                                        $get_sgpa_run=mysqli_query($conn, $get_sgpa);
                                        if($get_sgpa_run!=FALSE)
                                        {
                                            foreach($get_sgpa_run as $st_sgpa)
                                            {
                                                $mail.='<td>'.$st_sgpa["sgpa"].'</td>
                                                </tr>';
                                            }
                                        }
                                    }
                                    
                                $mail.="</table>
                                
                            

                                </div>
                            
                                </div>
                            </div>
                            </body>
                            </html>";
                                
                                return $mail;
                            }
                            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                            try {
                                //Server settings
                                //$mail->SMTPDebug = 1;                                 // Enable verbose debug output	//DELETE THIS
                                $mail->isSMTP();                                      // Set mailer to use SMTP
                                $mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
                                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                                $mail->Username = 'ems.suas.2017@gmail.com';                 // SMTP username
                                $mail->Password = 'ems@2017';                           // SMTP password
                                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                                $mail->Port = 587;                                    // TCP port to connect to
                                //Recipients
                                $mail->setFrom('ems.suas.2017@gmail.com', 'Examination Portal - SUAS Indore');                  
                                $mail->isHTML(true);                                  // Set email format to HTML
                                $mail->Subject = 'Result Notification - SUAS';
                                $get_student_array=mysqli_fetch_assoc($get_students_run);
                                $total=count($get_student_array);
                                $temp=0;
                                foreach($get_students_run as $student)
                                {
                                    
                                    $mail->addAddress($student["email_id"], $student["enrol_no"]);
                                    $mail->Body    = Mail_text($conn,$main, $student["email_id"], $student["enrol_no"], $student["roll_id"] , $student["atkt_flag"],$student["first_name"], $student["last_name"], $course_name, $from_year, $semester, $date);
                                    $mail->send();
                                    $temp++;
                                }

                                if($temp===$total)
                                {
                                    session_start();
                                    $_SESSION["result_notification"]=true;
                                    header("super_home.php");
                                }
                            }
                            catch(Exception $e)
                            {
                                $alert=new alert();
                                $alert->exec("Unable to send e-mail!", "warning");
                                session_start();
                                $_SESSION["result_notification"]=false;
                                header("super_home.php");
                            }
                        }
                        else
                        {
                            echo("get students query not executed");
                        }
                }
                }

            }
            else
            {
                echo("academic session query not executed ");
            }
        }
        else if($type==='2') //retotal
        {
            $get_retotal_session_id="SELECT retotal_session_id, ac_session_id FROM $retotal.retotal_sessions WHERE ac_session_id IN(SELECT ac_session_id FROM $main.academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND current_semester=$semester";
        }
        else if($type==='3') //reval
        {
            $get_session_id="SELECT current_semester FROM academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND ac_session_id IN(SELECT ac_session_id FROM reval_sessions)";
        }
        else if($type==='4') //atkt
        {
            $get_session_id="SELECT current_semester FROM academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND ac_session_id IN(SELECT ac_session_id FROM atkt_sessions)";
        }
        else
        {
            echo("Type Not set");
        }
    }
    
    

}
else
{
    echo("Not set");
}
mysqli_close($conn);
?>