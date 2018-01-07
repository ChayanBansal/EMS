<?php
    session_start();
    require('config.php');
    if(isset($_POST['tab_submit']))
    {
        $semester=$_POST['tab_submit'];//Button's value which is clicked 
        $from_year=$_SESSION['from_year']; //Selected batch relevant to the tr
        $course_id=$_SESSION['course_id']; //Selected course's id

        /*mysqli_autocommit($conn,FALSE);
        mysqli_begin_transaction($conn);*/
        $get_roll_id="SELECT roll_id, enrol_no FROM roll_list WHERE semester=".$semester." AND enrol_no IN 
                    (SELECT enrol_no FROM students WHERE course_id=".$course_id." AND current_sem=".$semester." AND from_year=".$from_year.")"; //CHECK the name of the column current_sem
        $get_roll_id_run=mysqli_query($conn,$get_roll_id);
    
        while($roll_id=mysqli_fetch_assoc($get_roll_id_run)) //$roll_id['roll_id'] $roll_id['enrol_no']
        {
            $total_credits_earned = 0; 
            $cr = 0;
            $total_earned_gpv = 0;
                    
            $get_sub_id="SELECT sub_id, practical_flag, credits_allotted FROM sub_distribution WHERE sub_code IN (SELECT sub_code FROM subjects WHERE course_id=".$course_id." AND semester=".$semester.")";
            $get_sub_id_run=mysqli_query($conn,$get_sub_id); 
            
            while($sub_id=mysqli_fetch_assoc($get_sub_id_run)) //$sub_id['sub_id'] $sub_id['practical_flag'] $sub_id['credits_allotted']
            {
                if(($sub_id['practical_flag']==0) OR ($sub_id['practical_flag']==1))
                {
                    if($sub_id['practical_flag']==0) //for theory sub_id
                    {
                        $get_comp_marks="SELECT component_id, marks FROM score WHERE roll_id=".$roll_id['roll_id']." AND sub_id=".$sub_id['sub_id'];
                        $get_comp_marks_run=mysqli_query($conn,$get_comp_marks);
                        while($comp_marks=mysqli_fetch_assoc($get_comp_marks_run)) //$comp_marks['component_id'] $comp_marks['marks']
                        {
                            if($comp_marks['component_id']==1)
                            {
                                $cat_cap_ia=$comp_marks['marks'];
                            }
                            else if($comp_marks['component_id']==2)
                            {
                                $end_sem=$comp_marks['marks'];
                            }
                            else
                            {
                                echo('If else condition satisfied here, then there might be an error in the database (because a theory subject_id can only have two above mentioned components)');
                            }

                            $get_passing_marks="SELECT passing_marks FROM component_distribution WHERE sub_id=".$sub_id['sub_id']." AND component_id=".$comp_marks['component_id'];
                            $get_passing_marks_run=mysqli_query($conn,$get_passing_marks);
                            $passing_marks=mysqli_fetch_assoc($get_passing_marks_run); //$passing_marks['passing_marks']
                            if($comp_marks['marks'] < $passing_marks['passing_marks'])
                            {
                                $update_roll_list="UPDATE roll_list SET atkt_flag=1 WHERE roll_id=".$roll_id['roll_id'];//Updating atkt_flag
                                $update_roll_list_run=mysqli_query($conn,$update_roll_list);

                                $insert_failure_report="INSERT INTO failure_report(roll_id, sub_id, component_id) 
                                                                            VALUES(".$roll_id['roll_id'].", ".$sub_id['sub_id'].", ".$comp_marks['component_id'].")";
                                $insert_failure_report=mysqli_query($conn,$insert_failure_report);
                            }
                        }
                    }
                    else if($sub_id['practical_flag']==1) //for practical sub_id
                    {   
                        $cat_cap_ia=0;
                        $get_comp_marks="SELECT component_id, marks FROM score WHERE roll_id=".$roll_id['roll_id']." AND sub_id=".$sub_id['sub_id'];
                        $get_comp_marks_run=mysqli_query($conn,$get_comp_marks);
                        while($comp_marks=mysqli_fetch_assoc($get_comp_marks_run)) //$comp_marks['component_id'] $comp_marks['marks']
                        {
                            if($comp_marks['component_id']==3)
                            {
                                $cat_cap_ia = $cat_cap_ia + $comp_marks['marks'];
                            }
                            else if($comp_marks['component_id']==4)
                            {
                                $end_sem=$comp_marks['marks'];
                            }
                            else if($comp_marks['component_id']==5)
                            {
                                $cat_cap_ia = $cat_cap_ia + $comp_marks['marks'];
                            }
                            else
                            {
                                echo('If else condition satisfied here, then there might be an error in the database (because a practical subject_id can only have two above mentioned components)');
                            }

                            $get_passing_marks="SELECT passing_marks FROM component_distribution WHERE sub_id=".$sub_id['sub_id']." AND component_id=".$comp_marks['component_id'];
                            $get_passing_marks_run=mysqli_query($conn,$get_passing_marks);
                            $passing_marks=mysqli_fetch_assoc($get_passing_marks_run); //$passing_marks['passing_marks']
                            if($comp_marks['marks'] < $passing_marks['passing_marks'])
                            {
                                $update_roll_list="UPDATE roll_list SET atkt_flag=1 WHERE roll_id=".$roll_id['roll_id'];//Updating atkt_flag
                                $update_roll_list_run=mysqli_query($conn,$update_roll_list);

                                $insert_failure_report="INSERT INTO failure_report(roll_id, sub_id, component_id) 
                                                                            VALUES(".$roll_id['roll_id'].", ".$sub_id['sub_id'].", ".$comp_marks['component_id'].")";
                                $insert_failure_report=mysqli_query($conn,$insert_failure_report);
                            }
                        }
                    }

                    $total = $cat_cap_ia + $end_sem;
                    $percentage = (($total*100)/100);

                    if ($percentage >= 91 and $percentage <= 100) 
                    {
                        $grade = 'O';
                        $gp = 10;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage >= 81 and $percentage < 91) 
                    {
                        $grade = 'A+';
                        $gp = 9;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage >= 71 and $percentage < 81) 
                    {
                        $grade = 'A';
                        $gp = 8;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage >= 61 and $percentage < 71) 
                    {
                        $grade = 'B+';
                        $gp = 7;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage >= 51 and $percentage < 61) 
                    {
                        $grade = 'B';
                        $gp = 6;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage >= 41 and $percentage < 51) 
                    {
                        $grade = 'C';
                        $gp = 5;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage == 40) 
                    {
                        $grade = 'P';
                        $gp = 4;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage < 40) 
                    {
                        $grade = 'F';
                        $gp = 0;
                        $cr = 0;
                        $gpv = $gp * $cr;
                    }

                    $insert_tr="INSERT INTO tr (roll_id, sub_id, cat_cap_ia, end_sem, total, percent, grade, gp, cr, gpv) 
                        VALUES(".$roll_id['roll_id'].", ".$sub_id['sub_id'].", ".$cat_cap_ia.", ".$end_sem.", ".$total.", ".$percentage.", '".$grade."', ".$gp.", ".$cr.", ".$gpv.")";
                    $insert_tr_run=mysqli_query($conn,$insert_tr);
                    echo($insert_tr);
                    //An entry in a practical or theory subject done till here 
                    $total_credits_earned = $total_credits_earned + $cr;
                    $total_earned_gpv = $total_earned_gpv + $gpv;
                }
                else if($sub_id['practical_flag']==2) //for IE sub_id
                {
                    $get_comp_marks="SELECT component_id, marks FROM score WHERE roll_id=".$roll_id['roll_id']." AND sub_id=".$sub_id['sub_id'];
                    $get_comp_marks_run=mysqli_query($conn,$get_comp_marks);
                    while($comp_marks=mysqli_fetch_assoc($get_comp_marks_run)) //$comp_marks['component_id'] $comp_marks['marks']
                    {
                        if($comp_marks['component_id']==6)
                        {
                            $ie = $comp_marks['marks'];
                        }
                        else
                        {
                            echo('If else condition satisfied here, then there might be an error in the database (because an IE subject_id can only have one component)');
                        }

                        $get_passing_marks="SELECT passing_marks FROM component_distribution WHERE sub_id=".$sub_id['sub_id']." AND component_id=".$comp_marks['component_id'];
                        $get_passing_marks_run=mysqli_query($conn,$get_passing_marks);
                        $passing_marks=mysqli_fetch_assoc($get_passing_marks_run); //$passing_marks['passing_marks']
                        if($comp_marks['marks'] < $passing_marks['passing_marks'])
                        {
                            $update_roll_list="UPDATE roll_list SET atkt_flag=1 WHERE roll_id=".$roll_id['roll_id'];//Updating atkt_flag
                            $update_roll_list_run=mysqli_query($conn,$update_roll_list);

                            $insert_failure_report="INSERT INTO failure_report(roll_id, sub_id, component_id) 
                                                                        VALUES(".$roll_id['roll_id'].", ".$sub_id['sub_id'].", ".$comp_marks['component_id'].")";
                            $insert_failure_report=mysqli_query($conn,$insert_failure_report);
                        }
                    }    
                        $total = $ie;
                        $percentage = (($total*100)/100);
                    
                    if ($percentage >= 91 and $percentage <= 100) 
                    {
                        $grade = 'O';
                        $gp = 10;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage >= 81 and $percentage < 91) 
                    {
                        $grade = 'A+';
                        $gp = 9;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage >= 71 and $percentage < 81) 
                    {
                        $grade = 'A';
                        $gp = 8;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage >= 61 and $percentage < 71) 
                    {
                        $grade = 'B+';
                        $gp = 7;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage >= 51 and $percentage < 61) 
                    {
                        $grade = 'B';
                        $gp = 6;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage >= 41 and $percentage < 51) 
                    {
                        $grade = 'C';
                        $gp = 5;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage == 40) 
                    {
                        $grade = 'P';
                        $gp = 4;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } 
                    else if ($percentage < 40) 
                    {
                        $grade = 'F';
                        $gp = 0;
                        $cr = 0;
                        $gpv = $gp * $cr;
                    }
                    
                    $insert_tr="INSERT INTO tr (roll_id, sub_id, ie, total, percent, grade, gp, cr, gpv) 
                        VALUES(".$roll_id['roll_id'].", ".$sub_id['sub_id'].", ".$ie.", ".$total.", ".$percentage.", '".$grade."', ".$gp.", ".$cr.", ".$gpv.")";
                    $insert_tr_run=mysqli_query($conn,$insert_tr);
                    //An entry in a Internal Examination(IE) subject done here 

                    $total_credits_earned = $total_credits_earned + $cr;
                    $total_earned_gpv = $total_earned_gpv + $gpv;
                }
            }

            // exam summary
            $sgpa = $total_earned_gpv / $total_credits_earned;

            $insert_exam_summary="INSERT INTO exam_summary(roll_id, total_credits_earned, total_gpv_earned, sgpa) 
                                        VALUES(".$roll_id['roll_id'].", ".$total_credits_earned.", ".$total_earned_gpv.", ".$sgpa.")";
            $insert_exam_summary_run=mysqli_query($conn,$insert_exam_summary);

            //Updating CGPA
            $get_cur_cgpa="SELECT cgpa FROM students WHERE enrol_no=".$roll_id['enrol_no'];
            $get_cur_cgpa=mysqli_query($conn,$get_cur_cgpa);
            $cur_cgpa=mysqli_fetch_assoc($get_cur_cgpa);//$cur_cgpa['cgpa']

            $new_cgpa = ($cur_cgpa['cgpa'] + $sgpa)/2;

            $update_cgpa="UPDATE students SET cgpa=".$new_cgpa." WHERE enrol_no=".$roll_id['enrol_no'];
            $update_cgpa_run=mysqli_query($conn,$update_cgpa);

            if($insert_exam_summary_run==TRUE)
            {
                $_SESSION['tr_generated']=TRUE;
                //mysqli_commit($conn);
                //mysqli_close($conn);
            }
            else
            {
                $_SESSION['tr_generated']=FALSE;
                //mysqli_rollback($conn);
                //mysqli_close($conn);
                
                header('location: super_home');
            }
        }
    }
    else
    {
        header('location: 404.html');
    }
?>