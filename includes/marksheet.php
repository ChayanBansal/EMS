<?php 
session_start();
require('config.php');
/* Note: In the following code, ****Status is considered as Regular**** */
/* Requirements:
        1) roll_id
        2) semester
        3) course_id
    
    Uses:
        1) students
        2) roll_list
        3) branches
        4) exam_month_year
        5) subjects
        6) sub_distribution
        7) tr
        8) exam_summary
        9) academic_sessions

    Point to be noted: javaScript variables having name (rowspan_+'SUBJECT CODE') is used for changing the rowspan of the subjects which only have one component(Theory/Practical).
*/
    if(isset($_POST['print_roll_id']))
    {
        $roll_id = $_POST['print_roll_id'];
        $semester = $_SESSION['semester'];
        $course_id = $_SESSION['course_id'];

        $get_stud_detail="SELECT `enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `ac_session_id`, `cgpa` FROM ems.students WHERE enrol_no = 
                        (SELECT enrol_no FROM ems.roll_list WHERE roll_id = $roll_id)";
        $get_stud_detail_run=mysqli_query($conn,$get_stud_detail);
        $stud=mysqli_fetch_assoc($get_stud_detail_run);
        //$stud['enrol_no'] $stud['first_name'] $stud['middle_name'] $stud['last_name'] $stud['father_name'] $stud['mother_name'] $stud['course_id'] $stud['from_year'] $stud['current_sem'] $stud['cgpa']

        //getting school name
        $get_school_name="SELECT school_name FROM ems.schools WHERE school_id= (SELECT school_id FROM ems.courses WHERE course_id=$course_id)";
        $get_school_name_run = mysqli_query($conn,$get_school_name);
        $school_name=mysqli_fetch_assoc($get_school_name_run);

        $get_prog_br="SELECT program, branch FROM ems.branches WHERE course_id=$course_id";
        $get_prog_br_run=mysqli_query($conn,$get_prog_br);
        $prog_br=mysqli_fetch_assoc($get_prog_br_run);
        //$prog_br['progam'] $prog_br['branch']

        $get_exam_month="SELECT month_year FROM ems.exam_month_year WHERE session_id =" .$stud["ac_session_id"];
                    //(SELECT ac_session_id FROM academic_sessions WHERE course_id=$course_id AND from_year=".$stud['from_year']." AND current_semester=$semester)";
        $get_exam_month_run=mysqli_query($conn,$get_exam_month);
        $exam_month=mysqli_fetch_assoc($get_exam_month_run);//$exam_month['month_year']
        

        //Updating no_prints in roll_list
        $update_prints="UPDATE ems.roll_list set no_prints=(no_prints+1) WHERE roll_id=$roll_id";
        $update_prints_run=mysqli_query($conn,$update_prints);
       
    }
//the output starts here
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Marksheet</title>
    <style>
        table {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
        
        tr,
        td {
            padding: 5px;
        }
        
        .t1 table {
            border: none;
            color: rgb(0, 6, 83);
        }
        
        .t2 table {
            border: none;
            color: rgb(0, 6, 83);
        }
        
        .t3 {
            padding: 5px;
        }
        
        .t3 td,
        th,
        table {
            border-collapse: collapse;
            border: 1px solid rgb(22, 31, 160);
            padding: 10px;
        }
        
        .t3 td {
            text-align: center;
            padding: 15px;
        }
        
        th {
            color: #A42116;
        }
        
        .upper {
            width: 100%;
            display: flex;
            justify-content: space-around;
        }
        
        .lower {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        table caption {
            border: 1px solid rgb(22, 31, 160);
            border-top: none !important;
        }
        
        .caption-container {
            display: flex;
            justify-content: space-around;
            font-weight: 600;
        }
        
        .block {
            padding: 10px;
        }
        #blue {
            color: rgb(0, 6, 83);
        }
        
        @media print {
            body {
                margin: 0.1cm;
                margin-top: 0.25cm !important;
                margin-right: 0.3cm !important;
                margin-left: 0 !important;
            }
            .first1 {
                position: absolute;
                top: 1.72cm;
                right: 1.8cm !important;
            }
            .s_image {
                max-height: 2.4cm;
                max-width: 2.4cm;
            }
            .stud_img {
                height: 2.4cm;
                width: 2.3cm;
            }
            .main1 {
                height: 16.5cm;
            }
            .upper {
                position: absolute;
                top: 6.3cm;
                width: 85%;
                left: 1.8cm;
            }
            .t1 {
                width: 40%;
                float: left;
                font-size: 13px;
                color: rgb(0, 20, 100);
            }
            .t2 {
                width: 50%;
                font-size: 13px;
                color: rgb(0, 20, 100);
            }
            .t1 td {
                vertical-align: top;
                padding: 2px;
                padding-right: 3px;
                padding-left: 3px;
                width: 30%;
            }
            .t2 td {
                vertical-align: top;
                padding: 2px;
                padding-right: 10px;
                padding-left: 20px;
            }
            .lower {
                position: absolute;
                top: 10.3cm;
            }
            .t3 {
                position: relative;
                width: 86%;
                max-height: 10cm;
            }
            .t3 table {
                width: 100%;
                height: 11.3cm;
            }
            .t3 th {
                padding: 0px;
                color: #c61809;
                font-weight: 700;
                font-size: 12px;
            }
            .t3 td {
                padding: 1px;
                font-size: 12px;
                color: rgb(0, 20, 100);
            }
            .block {
                padding: 1px;
                font-size: 14px;
                font-weight: 600;
            }
        }
    </style>
</head>
<body onload='history.replaceState("", "", "printing");window.print();window.history.back();'><!--window.print(); window.history.back(); history.replaceState("", "", "printing"); window.history.back()-->
    <div class="first1">
    <div class="s_image"><img src="/ems/stud_img/<?=$stud['enrol_no']?><?php
    if(file_exists("../stud_img/".$stud['enrol_no'].".png")){
        echo(".png");
    }else{
        echo(".jpg");
    }
    ?>" alt="" class="stud_img"></div>
    </div>
    <div class="main1">
        <div class="upper">
            <div class="t1">
                <table class="marksheet">
                    <tr>
                        <td style="">Enrollment No.:</td>
                        <td><?php echo($stud['enrol_no']); ?></td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td><?php echo($stud['first_name']);
                            if($stud['middle_name']=="") //Done for space between middle name and first name
                            {
                                //Do nothing
                            }
                            else
                            {
                                echo(" ".$stud['middle_name']);
                            }
                            echo(" ".$stud['last_name']."
                        </td>
                    </tr>");
                    echo("
                    <tr>
                        <td>Father's Name:</td>
                        <td>".$stud['father_name']."</td>
                    </tr>
                    <tr>
                        <td>Mother's Name:</td>
                        <td>".$stud['mother_name']."</td>
                    </tr>
                    <tr>
                        <td>Institute:</td>
                        <td>School Of ".$school_name["school_name"]."</td>
                    </tr>
                </table>
            </div>
            <div class='t2'>
                <table>
                    <tr>
                        <td>Program:</td>
                        <td>".$prog_br['program']."</td>
                    </tr>
                    <tr>
                        <td>Branch:</td>
                        <td>".$prog_br['branch']."</td>
                    </tr>
                    <tr>
                        <td>Semester:</td>
                        <td>$semester</td>
                    </tr>
                    <tr>
                        <td>Examination:</td>
                        <td>".strtoupper($exam_month['month_year'])."</td>
                    </tr>
                    <tr>
                        <td>Status:</td>
                        <td>Regular</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class='lower'>
            <div class='t3'>
                <table>
                    <tr>
                        <th rowspan='2'>PAPER CODE</th>
                        <th rowspan='2'>NAME OF PAPER</th>
                        <th rowspan='2'>TH;PR</th>
                        <th colspan='2'>CREDITS</th>
                        <th rowspan='2'>GRADE</th>
                    </tr>
                    <tr>
                        <th>ALLOTTED</th>
                        <th>EARNED</th>
                    </tr>");

    $get_subjects_opted="SELECT ac_sub_code, sub_code, sub_name, ie_flag FROM ems.subjects WHERE (ac_session_id=".$stud['ac_session_id'].") AND ((elective_flag=0) OR (elective_flag=1 AND sub_code IN (SELECT sub_code FROM ems.elective_map WHERE enrol_no='".$stud['enrol_no']."')))";
    $get_subjects_opted_run=mysqli_query($conn,$get_subjects_opted);
    while($sub=mysqli_fetch_assoc($get_subjects_opted_run)) //$sub['sub_code'] $sub['sub_name'] $sub['ie_flag']
    {
        if($sub['ie_flag']==1)
        {
            $audit_code=$sub['sub_code'];
            $audit_name=$sub['sub_name'];
            $get_sub_id="SELECT sub_id, practical_flag FROM ems.sub_distribution WHERE ac_sub_code='".$sub['ac_sub_code']."'";
            $get_sub_id_run=mysqli_query($conn,$get_sub_id);
            $sub_id=mysqli_fetch_assoc($get_sub_id_run); //$sub['sub_id']

            $get_percent="SELECT percent FROM ems.tr WHERE roll_id=$roll_id AND sub_id=".$sub_id['sub_id'];
            $get_percent_run=mysqli_query($conn,$get_percent);
            $percent=mysqli_fetch_assoc($get_percent_run);//$percent['percent']

            if($percent['percent']<40)
            {
                $audit_pf="Fail";
            }
            else
            {
                $audit_pf="Pass";
            }
        }
        else if($sub['ie_flag']==0)
        {
            $rowspan;
            $get_sub_id_count="SELECT COUNT(sub_id) as count FROM ems.sub_distribution WHERE ac_sub_code='".$sub['ac_sub_code']."'";
            $get_sub_id_count_run=mysqli_query($conn,$get_sub_id_count);
            $sub_id_count=mysqli_fetch_assoc($get_sub_id_count_run);
            echo('<tr>
            <td rowspan="'.$sub_id_count['count'].'" class="'.$sub['sub_code'].'" id="blue">'.$sub['sub_code'].'</td>  
            <td rowspan="'.$sub_id_count['count'].'" class="'.$sub['sub_code'].'" id="blue">'.$sub['sub_name'].'</td>'); //These two have same class, i.e, sub_code
            
            $get_sub_id="SELECT sub_id, practical_flag, credits_allotted FROM ems.sub_distribution WHERE ac_sub_code='".$sub['ac_sub_code']."'";
            $get_sub_id_run=mysqli_query($conn,$get_sub_id);

            echo('<script> var rowspan_'.$sub['sub_code'].'=0; </script>'); //JS variable for rowspan
            
            while($sub_id=mysqli_fetch_assoc($get_sub_id_run))//$sub_id['sub_id'] $sub_id['practical_flag'] $sub_id['credits_allotted']
            {
                
                $get_cr_grade="SELECT cr, grade FROM ems.tr WHERE roll_id=$roll_id AND sub_id=".$sub_id['sub_id'];
                $get_cr_grade_run=mysqli_query($conn,$get_cr_grade);
                $cr_grade=mysqli_fetch_assoc($get_cr_grade_run);//$cr_grade['cr'] $cr_grade['grade']

                if($sub_id['practical_flag']==1)
                {
                    echo('<script> rowspan_'.$sub['sub_code'].'++; </script>');
                    echo('<td id="blue">P</td>'); //Practical P
                }
                else if($sub_id['practical_flag']==0)
                {
                    echo('<script> rowspan_'.$sub['sub_code'].'++; </script>');
                    echo('<td id="blue">T</td>');//Theory T
                }
                echo('<script> 
                        if(rowspan_'.$sub['sub_code'].'==1)        
                        {
                            document.getElementByClass("rowspan_'.$sub['sub_code'].'").rowSpan = "1";
                        }
                 </script>');
                echo('<td>'.$sub_id['credits_allotted'].'</td>'); //Alloted Credits {**We have spelling mistake in the database of alloted: Remember**}
                echo('<td>'.$cr_grade['cr'].'</td>'); //Credits earned
                echo('<td>'.$cr_grade['grade'].'</td>'); //Grade
                echo('</tr>');
            }
        }
    }
?>
                 <caption align="bottom">
                 <div class="caption-container">
                     <div class="block">Result: 
                         <span class="info" id="info" style="font-weight:700;">
                             <?php 
                                $get_sgpa="SELECT sgpa FROM ems.exam_summary WHERE roll_id=$roll_id";
                                $get_sgpa_run=mysqli_query($conn,$get_sgpa);
                                $sgpa=mysqli_fetch_assoc($get_sgpa_run);//$sgpa['sgpa']

                                $get_fail_count="SELECT COUNT(component_id) AS fail_count FROM ems.failure_report WHERE roll_id=$roll_id";
                                $get_fail_count_run=mysqli_query($conn,$get_fail_count);
                                $fail_count=mysqli_fetch_assoc($get_fail_count_run);
                                //$fail_count['fail_count']

                                if($fail_count['fail_count']!=0)
                                {
                                    echo('FAIL');
                                    echo("<script>document.getElementById('info').style.color = 'red';</script>");
                                }
                                else
                                {
                                    echo('PASS');
                                    echo("<script>document.getElementById('info').style.color = 'green';</script>");
                                }

                                /*
                                $get_fail_count="SELECT COUNT(component_id) AS fail_count FROM failure_report WHERE roll_id=$roll_id";
                                $get_fail_count_run=mysqli_query($conn,$get_fail_count);
                                $fail_count=mysqli_fetch_assoc($get_fail_count_run);
                                */
                             ?>
                         </span>
                     </div>
                     <div class="block">SGPA: 
                         <span class="info">
                            <?php 
                                echo($sgpa['sgpa']);
                            ?>
                         </span>
                     </div>
                     <div class="block">CGPA: 
                         <span class="info">
                            <?php
                                echo('--');
                                //echo($stud['cgpa']);
                            ?>
                         </span>
                     </div>
             </caption>
             <?php
             if(isset($audit_pf))
             {
                echo(' <caption align="bottom">
                    <div class="caption-container">
                        <div class="block">');
                            
                                echo($audit_pf.' in '.$audit_code.' ('.$audit_name.') <span class="info"></span>');
                            
                            echo('</div>
                    </div>
                </caption>');
             }
             ?>
         </table>
     </div>
 </div>
</div>
</body>

</html>
