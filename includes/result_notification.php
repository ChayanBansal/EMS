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

    if($type==='1') //Main
    {
        $get_ac_session_id="SELECT ac_session_id FROM $main.academic_sessions WHERE from_year=$from_year AND course_id=$course_id AND current_semester=$semester";
        $get_ac_session_id_run=mysqli_query($conn,$get_ac_session_id);
        if($get_ac_session_id!=FALSE)
        {
            echo($get_ac_session_id);
            foreach($get_ac_session_id_run as $session_id)
            {
                $ac_session_id=$session_id["ac_session_id"];
                echo(" ac session: ".$ac_session_id);
                $get_students="SELECT r.roll_id, r.atkt_flag, r.enrol_no, s.email_id, s.first_name, s.last_name FROM $main.roll_list r, $main.students s WHERE s.ac_session_id=$ac_session_id AND s.enrol_no=r.enrol_no AND r.semester=$semester";
                $get_students_run=mysqli_query($conn,$get_students);
                echo($get_students);
                if($get_students_run!=FALSE)
                {
                    
                    //Load composer's autoloader
                    require 'phpmailer/vendor/autoload.php';
                    function Mail_text($conn,$main,$email, $enrol_no, $roll_id ,$atkt_flag,$f_name, $l_name){
                        echo($main.$email. $enrol_no." roll id: ". $roll_id ." atkt_flag: ".$atkt_flag." name".$f_name. $l_name);
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
                        }
                        .title{
                            font-size: 24px;
                            color: #2A458E;
                            font-family: "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Geneva, Verdana, sans-serif;
                            font-weight: 400;
                            line-height: 33px;
                        }
                        .mcontainer{
                            padding: 10px;
                            display: flex;
                          justify-content: center;
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
                        <div class="title">Symbiosis University Of Applied Sciences</div>
                        <hr id="hr">
                        <div class="portal">Result Notification</div>
                        <div class="text">
                            Enrollment Number'.$enrol_no.'<br>
                            Name:'.$f_name.' '.$l_name.'<br>';
                            if($atkt_flag==='1')
                            {
                                $get_atkt_subjects="SELECT DISTINCT(sub_id) FROM failure_report WHERE roll_id=$roll_id";
                                $get_atkt_subjects_run=mysqli_query($conn,$get_atkt_subjects);
                                if($get_atkt_subjects_run!=FALSE)
                                {
                                    if(mysqli_num_rows($get_atkt_subjects_run)>0)
                                    {
                                        $get_sub_detail="SELECT s.sub_name, s.sub_code, sd.practical_flag FROM subjects s, sub_distribution sd WHERE s.ac_sub_code=sd.ac_sub_code AND sd.sub_id IN(".implode("','",$get_atkt_subjects_run) .")";
                                        $get_sub_detail_run=mysqli_query($conn,$get_sub_detail);
                                        if($get_sub_detail_run!=FALSE)
                                        {
                                            $mail.='Fail in:<ol>';
                                            foreach($get_sub_detail_run as $sub_detail)
                                            {
                                                $mail.='<li>'. $sub_detail["sub_code"].' '. $sub_detail["sub_name"];
                                                if($sub_detail["sub_code"]==='1')
                                                {
                                                    $mail.=' [PRACTICAL]';
                                                }
                                                elseif($sub_detail["sub_code"]==='0')
                                                {
                                                    $mail.=' [THEORY]';
                                                }
                                                elseif($sub_detail["sub_code"]==='2')
                                                {
                                                    $mail.=' [IE]';
                                                }
                                                '</li>';
                                            }
                                            $mail.='</ol><br>';
                                        }
                                    }
                                }
                            }
                            else
                            {
                                $mail.='SGPA: ';
                                $get_sgpa="SELECT sgpa FROM $main.exam_summary WHERE roll_id=$roll_id";
                                $get_sgpa_run=mysqli_query($conn, $get_sgpa);
                                if($get_sgpa_run!=FALSE)
                                {
                                    foreach($get_sgpa_run as $st_sgpa)
                                    {
                                        $mail.=$st_sgpa["sgpa"];
                                    }
                                }
                            }
                        $mail.='</div>
                         
                            </div>
                        </div>
                        </body>
                        </html>';
                        echo($mail);
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
                        $mail->Subject = 'Operator Registration Confirmation';
                        foreach($get_students_run as $student)
                        {
                            echo($student["email_id"].'<br>');
                            $mail->addAddress($student["email_id"], $student["enrol_no"]);
                            $mail->Body    = Mail_text($conn,$main, $student["email_id"], $student["enrol_no"], $student["roll_id"] , $student["atkt_flag"],$student["first_name"], $student["last_name"]);
                            $mail->send();
                            echo("after send()");
                        }
                    }
                    catch(Exception $e)
                    {
                        $alert=new alert();
                        $alert->exec("Unable to send e-mail!", "warning");
                    }
                }
                else
                {
                    echo("get students query not executed");
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
else
{
    echo("Not set");
}
mysqli_close($conn);
?>