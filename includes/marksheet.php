<?php 
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

        $get_stud_detail="SELECT `enrol_no`, `first_name`, `middle_name`, `last_name`, `father_name`, `mother_name`, `course_id`, `from_year`, `current_sem`, `cgpa` FROM students WHERE enrol_no = 
                        (SELECT enrol_no FROM roll_list WHERE roll_id = $roll_id)";
        $get_stud_detail_run=mysqli_query($conn,$get_stud_detail);
        $stud=mysqli_fetch_assoc($get_stud_detail_run);
        //$stud['enrol_no'] $stud['first_name'] $stud['middle_name'] $stud['last_name'] $stud['father_name'] $stud['mother_name'] $stud['course_id'] $stud['from_year'] $stud['current_sem'] $stud['cgpa']

        $get_prog_br="SELECT progam, branch FROM branches WHERE course_id=$course_id";
        $get_prog_br_run=mysqli_query($conn,$get_prog_br);
        $prog_br=mysqli_fetch_assoc($get_prog_br_run);
        //$prog_br['progam'] $prog_br['branch']

        $get_prog_br="SELECT month_year FROM exam_month_year WHERE ac_session_id =
                    (SELECT ac_session_id FROM academic_sessions WHERE course_id=$course_id AND from_year=".$stud['from_year']." AND current_semester=$semester)";
        $get_prog_br_run=mysqli_query($conn,$get_prog_br);
        $prog_br=mysqli_fetch_assoc($get_prog_br_run);//$prog_br['month_year']
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
        }
        
        .t2 table {
            border: none;
        }
        
        .t3 {
            padding: 5px;
        }
        
        .t3 td,
        th,
        table {
            border-collapse: collapse;
            border: 1px solid blue;
            padding: 10px;
        }
        
        .t3 td {
            text-align: center;
            padding: 15px;
        }
        
        th {
            background: navy;
            color: white;
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
            position: absolute;
        }
        
        table caption {
            border: 1px solid blue;
        }
        
        .caption-container {
            display: flex;
            justify-content: space-around;
        }
        
        .block {
            padding: 10px;
        }
        
        @media print {
            .main {
                height: 16.5cm;
            }
            .upper {
                position: absolute;
                top: 6cm;
                width: 85%;
                left: 1.8cm;
            }
            .t1 {
                width: 40%;
                float: left;
                font-size: 12px;
            }
            .t2 {
                width: 40%;
                font-size: 12px;
            }
            .t1 td {
                vertical-align: top;
            }
            .t2 td {
                vertical-align: top;
            }
            .lower {
                position: absolute;
                top: 10.2cm;
            }
            .t3 {
                position: relative;
                width: 83%;
                max-height: 10cm;
            }
            .t3 table {
                width: 100%;
            }
            .t3 th {
                padding: 2px;
                color: black;
                font-weight: 700;
                font-size: 12px;
            }
            .t3 td {
                padding: 2px;
                font-size: 12px;
            }
            .block {
                padding: 2px;
                font-size: 12px;
                font-weight: 600;
            }
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="upper">
            <div class="t1">
                <table>
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
                        <td>School Of ".$prog_br['branch']."</td>
                    </tr>
                </table>
            </div>
            <div class='t2'>
                <table>
                    <tr>
                        <td>Program:</td>
                        <td>".$prog_br['progam']."</td>
                    </tr>
                    <tr>
                        <td>Branch:</td>
                        <td>".$prog_br['progam']."</td>
                    </tr>
                    <tr>
                        <td>Semester:</td>
                        <td>$semester</td>
                    </tr>
                    <tr>
                        <td>Examination:</td>
                        <td>".$prog_br['month_year']."</td>
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
                        <th>ALLOTED</th>
                        <th>EARNED</th>
                    </tr>");

    $get_subjects_opted="SELECT sub_code, sub_name, ie_flag FROM subjects WHERE (course_id=$course_id AND semester=$semester) AND ((elective_flag=0) OR (elective_flag=1 AND sub_code IN (SELECT sub_code FROM elective_map WHERE enrol_no=$enrol_no))";
    $get_subjects_opted_run=mysqli_query($conn,$get_subjects_opted);
    while($sub=mysqli_fetch_assoc($get_subjects_opted_run)) //$sub['sub_code'] $sub['sub_name'] $sub['ie_flag']
    {
        if($sub['ie_flag']==1)
        {
            $audit_code=$sub['sub_code'];
            $audit_name=$sub['sub_name'];
            $get_sub_id="SELECT sub_id, practical_flag FROM sub_distribution WHERE sub_code=".$sub['sub_code'];
            $get_sub_id_run=mysqli_query($conn,$get_sub_id);
            $sub_id=mysqli_fetch_assoc($get_sub_id_run); //$sub['sub_id']

            $get_percent="SELECT percent FROM tr WHERE roll_id=$roll_id AND sub_id=".$sub_id['sub_id'];
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
            echo('<tr>
            <td rowspan="2" class="'.$sub['sub_code'].'" >'.$sub['sub_code'].'</td>  
            <td rowspan="2" class="'.$sub['sub_code'].'" >'.$sub['sub_name'].'</td>'); //These two have same class, i.e, sub_code
            
            $get_sub_id="SELECT sub_id, practical_flag, credits_allotted FROM sub_distribution WHERE sub_code=".$sub['sub_code'];
            $get_sub_id_run=mysqli_query($conn,$get_sub_id);

            echo('<script> var rowspan_'.$sub['sub_code'].'=0; </script>'); //JS variable for rowspan
            
            while($sub_id=mysqli_fetch_assoc($get_sub_id_run))//$sub_id['sub_id'] $sub_id['practical_flag'] $sub_id['credits_allotted']
            {
                
                $get_cr_grade="SELECT cr, grade FROM tr WHERE roll_id=$roll_id AND sub_id=".$sub_id['sub_id'];
                $get_cr_grade_run=mysqli_query($conn,$get_cr_grade);
                $cr_grade=mysqli_fetch_assoc($get_cr_grade_run);//$cr_grade['cr'] $cr_grade['grade']

                if($sub_id['practical_flag']==1)
                {
                    echo('<script> rowspan_'.$sub['sub_code'].'++; </script>');
                    echo('<td>P</td>'); //Practical P
                }
                else if($sub_id['practical_flag']==0)
                {
                    echo('<script> rowspan_'.$sub['sub_code'].'++; </script>');
                    echo('<td>T</td>');//Theory T
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
                echo('   
                </tr>');
            }
        }
    }
?>
                 <caption align="bottom">
                 <div class="caption-container">
                     <div class="block">Result: 
                         <span class="info">
                             <?php 
                                $get_sgpa="SELECT sgpa FROM exam_summary WHERE roll_id=$roll_id";
                                $get_sgpa_run=mysqli_query($conn,$get_sgpa);
                                $sgpa=mysqli_fetch_assoc($get_sgpa_run);//$sgpa['sgpa']
                                if($sgpa['sgpa']<4)
                                {
                                    echo('FAIL');
                                }
                                else
                                {
                                    echo('PASS');
                                }
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
                                echo($stud['cgpa']);
                            ?>
                         </span>
                     </div>
             </caption>
             <caption align="bottom">
                 <div class="caption-container">
                     <div class="block">
                         <?php
                            echo($audit_pf.' in '.$audit_code.' ('.$audit_name.') <span class="info"></span>');
                         ?> 
                        </div>
                 </div>
             </caption>
         </table>
     </div>
 </div>
</div>
</body>

</html>
