<?php
session_start();
require('config.php');
if (isset($_POST['tab_main_submit'])) //MAIN TR Generation
{
    $semester = $_POST['tab_main_submit'];//Button's value which is clicked 
    $from_year = $_SESSION['from_year']; //Selected batch relevant to the tr
    $course_id = $_SESSION['course_id']; //Selected course's id

    mysqli_autocommit($conn, false);
    mysqli_begin_transaction($conn);
    $get_ac_session_id = "SELECT ac_session_id FROM academic_sessions WHERE current_semester=$semester AND from_year=$from_year AND course_id=$course_id";
    $get_ac_session_id_run = mysqli_query($conn, $get_ac_session_id);
    if (mysqli_num_rows($get_ac_session_id_run) > 0) {
        $result = mysqli_fetch_assoc($get_ac_session_id_run);
        $ac_session_id = $result['ac_session_id'];

        $get_roll_id = "SELECT roll_id, enrol_no FROM roll_list WHERE semester=" . $semester . " AND enrol_no IN 
                        (SELECT enrol_no FROM students WHERE ac_session_id=$ac_session_id)"; //CHECK the name of the column current_sem
        $get_roll_id_run = mysqli_query($conn, $get_roll_id);

        while ($roll_id = mysqli_fetch_assoc($get_roll_id_run)) //$roll_id['roll_id'] $roll_id['enrol_no']
        {
            $total_credits_earned = 0;
            $cr = 0;
            $total_earned_gpv = 0;

            $get_sub_id = "SELECT sub_id, practical_flag, credits_allotted FROM sub_distribution WHERE ac_sub_code IN 
                            (
                                (SELECT ac_sub_code FROM subjects WHERE ac_session_id=$ac_session_id AND ((elective_flag=0) OR (elective_flag=1 AND ac_sub_code IN 
                                        (SELECT ac_sub_code FROM elective_map WHERE enrol_no='" . $roll_id['enrol_no'] . "')))))";
            $get_sub_id_run = mysqli_query($conn, $get_sub_id);
            $total_credits_allotted = 0;
            while ($sub_id = mysqli_fetch_assoc($get_sub_id_run)) //$sub_id['sub_id'] $sub_id['practical_flag'] $sub_id['credits_allotted']
            {
                $total_credits_allotted = $total_credits_allotted + $sub_id['credits_allotted'];
                if (($sub_id['practical_flag'] == 0) or ($sub_id['practical_flag'] == 1)) {
                    if ($sub_id['practical_flag'] == 0) //for theory sub_id
                    {
                        $ia = 0;
                        $get_comp_marks = "SELECT component_id, marks FROM score WHERE roll_id=" . $roll_id['roll_id'] . " AND sub_id=" . $sub_id['sub_id'];
                        $get_comp_marks_run = mysqli_query($conn, $get_comp_marks);
                        while ($comp_marks = mysqli_fetch_assoc($get_comp_marks_run)) //$comp_marks['component_id'] $comp_marks['marks']
                        {
                            if ($comp_marks['component_id'] == 1) {
                                $cat_cap = $comp_marks['marks'];
                            } else if ($comp_marks['component_id'] == 2) {
                                $end_sem = $comp_marks['marks'];
                            } else {
                                echo ('If else condition satisfied here, then there might be an error in the database (because a theory subject_id can only have two above mentioned components)');
                            }

                            $get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $sub_id['sub_id'] . " AND component_id=" . $comp_marks['component_id'];
                            $get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
                            $passing_marks = mysqli_fetch_assoc($get_passing_marks_run); //$passing_marks['passing_marks']
                            if ($comp_marks['marks'] < $passing_marks['passing_marks']) {
                                $update_roll_list = "UPDATE roll_list SET atkt_flag=1 WHERE roll_id=" . $roll_id['roll_id'];//Updating atkt_flag
                                $update_roll_list_run = mysqli_query($conn, $update_roll_list);
                                if (!$update_roll_list_run) {
                                    mysqli_rollback($conn);
                                }
                                $insert_failure_report = "INSERT INTO failure_report(roll_id, sub_id, component_id) 
                                                                                VALUES(" . $roll_id['roll_id'] . ", " . $sub_id['sub_id'] . ", " . $comp_marks['component_id'] . ")";
                                $insert_failure_report = mysqli_query($conn, $insert_failure_report);
                                if (!$insert_failure_report) {
                                    mysqli_rollback($conn);
                                }
                            }
                        }
                    } else if ($sub_id['practical_flag'] == 1) //for practical sub_id
                    {
                        $cat_cap = 0;
                        $ia = 0;
                        $get_comp_marks = "SELECT component_id, marks FROM score WHERE roll_id=" . $roll_id['roll_id'] . " AND sub_id=" . $sub_id['sub_id'];
                        $get_comp_marks_run = mysqli_query($conn, $get_comp_marks);
                        while ($comp_marks = mysqli_fetch_assoc($get_comp_marks_run)) //$comp_marks['component_id'] $comp_marks['marks']
                        {
                            if ($comp_marks['component_id'] == 3) {
                                $cat_cap = $comp_marks['marks'];
                            } else if ($comp_marks['component_id'] == 4) {
                                $end_sem = $comp_marks['marks'];
                            } else if ($comp_marks['component_id'] == 5) {
                                $ia = $comp_marks['marks'];
                            } else {
                                echo ('If else condition satisfied here, then there might be an error in the database (because a practical subject_id can only have two above mentioned components)');
                            }

                            $get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $sub_id['sub_id'] . " AND component_id=" . $comp_marks['component_id'];
                            $get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
                            $passing_marks = mysqli_fetch_assoc($get_passing_marks_run); //$passing_marks['passing_marks']
                            if ($comp_marks['marks'] < $passing_marks['passing_marks']) {
                                $update_roll_list = "UPDATE roll_list SET atkt_flag=1 WHERE roll_id=" . $roll_id['roll_id'];//Updating atkt_flag
                                $update_roll_list_run = mysqli_query($conn, $update_roll_list);
                                if (!$update_roll_list_run) {
                                    mysqli_rollback($conn);
                                }

                                $insert_failure_report = "INSERT INTO failure_report(roll_id, sub_id, component_id) 
                                                                                VALUES(" . $roll_id['roll_id'] . ", " . $sub_id['sub_id'] . ", " . $comp_marks['component_id'] . ")";
                                $insert_failure_report = mysqli_query($conn, $insert_failure_report);
                                if (!$insert_failure_report) {
                                    mysqli_rollback($conn);
                                }
                            }
                        }
                    }

                    $total = $cat_cap + $end_sem + $ia;
                    $percentage = (($total * 100) / 100);

                    if ($percentage >= 91 and $percentage <= 100) {
                        $grade = 'O';
                        $gp = 10;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage >= 81 and $percentage < 91) {
                        $grade = 'A+';
                        $gp = 9;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage >= 71 and $percentage < 81) {
                        $grade = 'A';
                        $gp = 8;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage >= 61 and $percentage < 71) {
                        $grade = 'B+';
                        $gp = 7;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage >= 51 and $percentage < 61) {
                        $grade = 'B';
                        $gp = 6;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage >= 41 and $percentage < 51) {
                        $grade = 'C';
                        $gp = 5;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage == 40) {
                        $grade = 'P';
                        $gp = 4;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage < 40) {
                        $grade = 'F';
                        $gp = 0;
                        $cr = 0;
                        $gpv = $gp * $cr;
                    }

                    if ($sub_id['practical_flag'] == 1) {
                        $insert_tr = "INSERT INTO tr (roll_id, sub_id, cat_cap, ia, end_sem, total, percent, grade, gp, cr, gpv) 
                                VALUES(" . $roll_id['roll_id'] . ", " . $sub_id['sub_id'] . ", " . $cat_cap . ", " . $ia . ", " . $end_sem . ", " . $total . ", " . $percentage . ", '" . $grade . "', " . $gp . ", " . $cr . ", " . $gpv . ")";
                        $insert_tr_run = mysqli_query($conn, $insert_tr);
                    } else {
                        $insert_tr = "INSERT INTO tr (roll_id, sub_id, cat_cap, end_sem, total, percent, grade, gp, cr, gpv) 
                                VALUES(" . $roll_id['roll_id'] . ", " . $sub_id['sub_id'] . ", " . $cat_cap . ", " . $end_sem . ", " . $total . ", " . $percentage . ", '" . $grade . "', " . $gp . ", " . $cr . ", " . $gpv . ")";
                        $insert_tr_run = mysqli_query($conn, $insert_tr);
                    }
                        //An entry in a practical or theory subject done till here 
                    $total_credits_earned = $total_credits_earned + $cr;
                    $total_earned_gpv = $total_earned_gpv + $gpv;
                } else if ($sub_id['practical_flag'] == 2) //for IE sub_id
                {
                    $get_comp_marks = "SELECT component_id, marks FROM score WHERE roll_id=" . $roll_id['roll_id'] . " AND sub_id=" . $sub_id['sub_id'];
                    $get_comp_marks_run = mysqli_query($conn, $get_comp_marks);
                    while ($comp_marks = mysqli_fetch_assoc($get_comp_marks_run)) //$comp_marks['component_id'] $comp_marks['marks']
                    {
                        if ($comp_marks['component_id'] == 6) {
                            $ie = $comp_marks['marks'];
                        } else {
                            echo ('If else condition satisfied here, then there might be an error in the database (because an IE subject_id can only have one component)');
                        }

                        $get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $sub_id['sub_id'] . " AND component_id=" . $comp_marks['component_id'];
                        $get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
                        $passing_marks = mysqli_fetch_assoc($get_passing_marks_run); //$passing_marks['passing_marks']
                        if ($comp_marks['marks'] < $passing_marks['passing_marks']) {
                            $update_roll_list = "UPDATE roll_list SET atkt_flag=1 WHERE roll_id=" . $roll_id['roll_id'];//Updating atkt_flag
                            $update_roll_list_run = mysqli_query($conn, $update_roll_list);
                            if (!$update_roll_list_run) {
                                mysqli_rollback($conn);
                            }
                            $insert_failure_report = "INSERT INTO failure_report(roll_id, sub_id, component_id) 
                                                                            VALUES(" . $roll_id['roll_id'] . ", " . $sub_id['sub_id'] . ", " . $comp_marks['component_id'] . ")";
                            $insert_failure_report = mysqli_query($conn, $insert_failure_report);
                            if (!$insert_failure_report) {
                                mysqli_rollback($conn);
                            }
                        }
                    }
                    $total = $ie;

                    $percentage = (($total * 100) / 100);
                    if ($percentage >= 91 and $percentage <= 100) {
                        $grade = 'O';
                        $gp = 10;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage >= 81 and $percentage < 91) {
                        $grade = 'A+';
                        $gp = 9;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage >= 71 and $percentage < 81) {
                        $grade = 'A';
                        $gp = 8;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage >= 61 and $percentage < 71) {
                        $grade = 'B+';
                        $gp = 7;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage >= 51 and $percentage < 61) {
                        $grade = 'B';
                        $gp = 6;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage >= 41 and $percentage < 51) {
                        $grade = 'C';
                        $gp = 5;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage == 40) {
                        $grade = 'P';
                        $gp = 4;
                        $cr = $sub_id['credits_allotted'];
                        $gpv = $gp * $cr;
                    } else if ($percentage < 40) {
                        $grade = 'F';
                        $gp = 0;
                        $cr = 0;
                        $gpv = $gp * $cr;
                    }

                    $insert_tr = "INSERT INTO tr (roll_id, sub_id, ie, total, percent, grade, gp, cr, gpv) 
                            VALUES(" . $roll_id['roll_id'] . ", " . $sub_id['sub_id'] . ", " . $ie . ", " . $total . ", " . $percentage . ", '" . $grade . "', " . $gp . ", " . $cr . ", " . $gpv . ")";
                    $insert_tr_run = mysqli_query($conn, $insert_tr);
                    if (!$insert_tr_run) {
                        mysqli_rollback($conn);
                    }

                    $total_credits_earned = $total_credits_earned + $cr;
                    $total_earned_gpv = $total_earned_gpv + $gpv;
                }
            }
                // exam summary
            $sgpa = $total_earned_gpv / $total_credits_allotted;

            $insert_exam_summary = "INSERT INTO exam_summary(roll_id, total_credits_earned, total_gpv_earned, sgpa) 
                                            VALUES(" . $roll_id['roll_id'] . ", " . $total_credits_earned . ", " . $total_earned_gpv . ", " . $sgpa . ")";
            $insert_exam_summary_run = mysqli_query($conn, $insert_exam_summary);

                //Updating CGPA
            $get_cur_cgpa = "SELECT cgpa FROM students WHERE enrol_no='" . $roll_id['enrol_no'] . "'";
            $get_cur_cgpa = mysqli_query($conn, $get_cur_cgpa);
            $cur_cgpa = mysqli_fetch_assoc($get_cur_cgpa);//$cur_cgpa['cgpa']
            $new_cgpa = ($cur_cgpa['cgpa'] + $sgpa) / 2;

            $update_tr_gen_flag = "UPDATE academic_sessions SET tr_gen_flag=1 WHERE ac_session_id=$ac_session_id";
            $update_tr_gen_flag_run = mysqli_query($conn, $update_tr_gen_flag);
                /*$update_cgpa="UPDATE students SET cgpa=".$new_cgpa." WHERE enrol_no='".$roll_id['enrol_no']."'";
                $update_cgpa_run=mysqli_query($conn,$update_cgpa);*/
            if ($insert_exam_summary_run == true && $update_tr_gen_flag_run) {
                $_SESSION['tr_generated'] = true;
                mysqli_commit($conn);

            } else {
                $_SESSION['tr_generated'] = false;
                mysqli_rollback($conn);
            }
        }
    }
    header('location: super_home.php');
} else if (isset($_POST['tab_atkt_submit'])) {
    //ATKT TR
    $semester = $_POST['tab_atkt_submit'];//Button's value which is clicked 
    $from_year = $_SESSION['from_year']; //Selected batch relevant to the tr
    $course_id = $_SESSION['course_id']; //Selected course's id

    mysqli_autocommit($conn, false);
    mysqli_begin_transaction($conn);
    $get_ac_session_id = "SELECT atkt_session_id,ac_session_id FROM atkt_sessions WHERE ac_session_id IN(SELECT ac_session_id FROM academic_sessions WHERE current_semester=$semester AND from_year=$from_year AND course_id=$course_id)";
    $get_ac_session_id_run = mysqli_query($conn, $get_ac_session_id);

    if (mysqli_num_rows($get_ac_session_id_run) > 0) {
        $result = mysqli_fetch_assoc($get_ac_session_id_run);
        $ac_session_id = $result['ac_session_id'];
        $atkt_sess_id = $result['atkt_session_id'];

        $error = false;

        $get_atkt_roll_list = "SELECT atkt_roll_id,roll_id FROM atkt_roll_list WHERE atkt_session_id=$atkt_sess_id";
        $get_atkt_roll_list_run = mysqli_query($conn, $get_atkt_roll_list);

        while ($roll_id = mysqli_fetch_assoc($get_atkt_roll_list_run)) {
            $get_tr = "SELECT * FROM tr WHERE roll_id=" . $roll_id['roll_id'];
            $get_tr_run = mysqli_query($conn, $get_tr);
            $total_credits_earned = 0;
            $total_earned_gpv = 0;
            $total_credits_allotted = 0;
            while ($row = mysqli_fetch_assoc($get_tr_run)) {

                $atkt_subjects = "SELECT count(*) FROM atkt_subjects WHERE atkt_roll_id=" . $roll_id['atkt_roll_id'] . " AND sub_id=" . $row['sub_id'];
                $atkt_subjects_run = mysqli_query($conn, $atkt_subjects);
                $cat_cap = $row['cat_cap'];
                $cat_cap = is_null($cat_cap) ? "NULL": $cat_cap;
                $end_sem = $row['end_sem'];
                $end_sem = is_null($end_sem) ? "NULL": $end_sem;
                $ia = $row['ia'];
                $ia = is_null($ia) ? "NULL": $ia ;
                $ie = $row['ie'];
                $ie = is_null($ie) ? "NULL":$ie;
                $get_sub_flag = "SELECT practical_flag,credits_allotted FROM sub_distribution WHERE sub_id=" . $row['sub_id'];
                $get_sub_flag_run = mysqli_query($conn, $get_sub_flag);
                $result = mysqli_fetch_assoc($get_sub_flag_run);
                $practical_flag = $result['practical_flag'];
                $total_credits_allotted += $result['credits_allotted'];

                if (mysqli_fetch_assoc($atkt_subjects_run)['count(*)'] > 0) {
                    // Take marks from score
                    $get_marks = "SELECT marks,component_id FROM score_atkt WHERE atkt_roll_id=" . $roll_id['atkt_roll_id'] . " AND sub_id=" . $row['sub_id'];
                    $get_marks_run = mysqli_query($conn, $get_marks);
                    while ($marks = mysqli_fetch_assoc($get_marks_run)) {
                        $get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $row['sub_id'] . " AND component_id=" . $marks['component_id'];
                        $get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
                        $passing_marks = mysqli_fetch_assoc($get_passing_marks_run)['passing_marks'];
                        if ($marks['marks'] < $passing_marks) {
                            $insert_atkt_failure = "INSERT INTO atkt_failure_report VALUES(" . $roll_id['atkt_roll_id'] . "," . $row['sub_id'] . "," . $marks['component_id'] . ")";
                            $insert_atkt_failure_run = mysqli_query($conn, $insert_atkt_failure);
                            if (!$insert_atkt_failure_run) {
                                $error = true;
                                mysqli_rollback($conn);
                                break;
                            }
                        }
                        switch ($marks['component_id']) {
                            case 1:
                                $cat_cap = $marks['marks'];
                                break;

                            case 2:
                                $end_sem = $marks['marks'];
                                break;

                            case 3:
                                $cat_cap = $marks['marks'];
                                break;

                            case 4:
                                $end_sem = $marks['marks'];
                                break;

                            case 5:
                                $ia = $marks['marks'];
                                break;

                            case 5:
                                $ie = $marks['marks'];
                                break;

                            default:
                                # code...
                                break;
                        }
                    }


                    $credits_allotted = $result['credits_allotted'];
                    if ($practical_flag == 0) {

                        $total = $cat_cap + $end_sem;
                        $percentage = (($total * 100) / 100);

                        if ($percentage >= 91 and $percentage <= 100) {
                            $grade = 'O';
                            $gp = 10;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 81 and $percentage < 91) {
                            $grade = 'A+';
                            $gp = 9;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 71 and $percentage < 81) {
                            $grade = 'A';
                            $gp = 8;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 61 and $percentage < 71) {
                            $grade = 'B+';
                            $gp = 7;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 51 and $percentage < 61) {
                            $grade = 'B';
                            $gp = 6;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 41 and $percentage < 51) {
                            $grade = 'C';
                            $gp = 5;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage == 40) {
                            $grade = 'P';
                            $gp = 4;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage < 40) {
                            $grade = 'F';
                            $gp = 0;
                            $cr = 0;
                            $gpv = $gp * $cr;
                        }
                        $total_credits_earned = $total_credits_earned + $cr;
                        $total_earned_gpv = $total_earned_gpv + $gpv;

                        $insert_atkt_tr = "INSERT INTO tr_atkt (atkt_roll_id,sub_id,cat_cap,end_sem,total,percent,grade,gp,cr,gpv) VALUES(" . $roll_id['atkt_roll_id'] . "," . $row['sub_id'] . ",$cat_cap,$end_sem,$total,$percentage,'$grade',$gp,$cr,$gpv)";
                        $insert_atkt_tr_run = mysqli_query($conn, $insert_atkt_tr);

                        if (!$insert_atkt_tr_run) {

                            $error = true;
                            mysqli_rollback($conn);
                            break;
                        }

                    } else if ($practical_flag == 1) {

                        $total = $cat_cap + $end_sem + $ia;
                        $percentage = (($total * 100) / 100);

                        if ($percentage >= 91 and $percentage <= 100) {
                            $grade = 'O';
                            $gp = 10;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 81 and $percentage < 91) {
                            $grade = 'A+';
                            $gp = 9;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 71 and $percentage < 81) {
                            $grade = 'A';
                            $gp = 8;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 61 and $percentage < 71) {
                            $grade = 'B+';
                            $gp = 7;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 51 and $percentage < 61) {
                            $grade = 'B';
                            $gp = 6;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 41 and $percentage < 51) {
                            $grade = 'C';
                            $gp = 5;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage == 40) {
                            $grade = 'P';
                            $gp = 4;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage < 40) {
                            $grade = 'F';
                            $gp = 0;
                            $cr = 0;
                            $gpv = $gp * $cr;
                        }
                        $total_credits_earned = $total_credits_earned + $cr;
                        $total_earned_gpv = $total_earned_gpv + $gpv;

                        $insert_atkt_tr = "INSERT INTO tr_atkt (atkt_roll_id,sub_id,cat_cap,ia,end_sem,total,percent,grade,gp,cr,gpv) VALUES(" . $roll_id['atkt_roll_id'] . "," . $row['sub_id'] . ",$cat_cap,$ia,$end_sem,$total,$percentage,'$grade',$gp,$cr,$gpv)";
                        $insert_atkt_tr_run = mysqli_query($conn, $insert_atkt_tr);

                        if (!$insert_atkt_tr_run) {

                            $error = true;
                            mysqli_rollback($conn);
                            break;
                        }


                    } else if ($practical_flag == 2) {

                        $total = $ie;
                        $percentage = (($total * 100) / 100);

                        if ($percentage >= 91 and $percentage <= 100) {
                            $grade = 'O';
                            $gp = 10;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 81 and $percentage < 91) {
                            $grade = 'A+';
                            $gp = 9;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 71 and $percentage < 81) {
                            $grade = 'A';
                            $gp = 8;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 61 and $percentage < 71) {
                            $grade = 'B+';
                            $gp = 7;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 51 and $percentage < 61) {
                            $grade = 'B';
                            $gp = 6;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 41 and $percentage < 51) {
                            $grade = 'C';
                            $gp = 5;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage == 40) {
                            $grade = 'P';
                            $gp = 4;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage < 40) {
                            $grade = 'F';
                            $gp = 0;
                            $cr = 0;
                            $gpv = $gp * $cr;
                        }
                        $total_credits_earned = $total_credits_earned + $cr;
                        $total_earned_gpv = $total_earned_gpv + $gpv;

                        $insert_atkt_tr = "INSERT INTO tr_atkt (atkt_roll_id,sub_id,end_sem,total,percent,grade,gp,cr,gpv) VALUES(" . $roll_id['atkt_roll_id'] . "," . $row['sub_id'] . ",$ie,$total,$percentage,'$grade',$gp,$cr,$gpv)";
                        $insert_atkt_tr_run = mysqli_query($conn, $insert_atkt_tr);

                        if (!$insert_atkt_tr_run) {
                            $error = true;
                            mysqli_rollback($conn);
                            break;
                        }

                    }


                } else {
                        //Take marks directly from Main TR
                    $insert_atkt_tr = "INSERT INTO tr_atkt VALUES(" . $roll_id['atkt_roll_id'] . "," . $row['sub_id'] . "," . $cat_cap . "," . $ia . "," . $end_sem . "," . $ie . "," . $row['total'] . "," . $row['percent'] . ",'" . $row['grade'] . "'," . $row['gp'] . "," . $row['cr'] . "," . $row['gpv'] . ")";
                    $insert_atkt_tr_run = mysqli_query($conn, $insert_atkt_tr);
                    if (!$insert_atkt_tr_run) {
                        $error = true;
                        mysqli_rollback($conn);
                        break;
                    } else {
                        $total_credits_earned = $total_credits_earned + $row['cr'];
                        $total_earned_gpv = $total_earned_gpv + $row['gpv'];
                    }
                }
            }


            $sgpa = $total_earned_gpv / $total_credits_allotted;

            $insert_exam_summary = "INSERT INTO atkt_exam_summary VALUES(" . $roll_id['atkt_roll_id'] . ", " . $total_credits_earned . ", " . $total_earned_gpv . ", " . $sgpa . ")";
            $insert_exam_summary_run = mysqli_query($conn, $insert_exam_summary);
            
            //????!!!!Doubtful Code!!!!
            //Updating CGPA
            /* $get_cur_cgpa = "SELECT cgpa FROM students WHERE enrol_no='" . $roll_id['enrol_no'] . "'";
            $get_cur_cgpa = mysqli_query($conn, $get_cur_cgpa);
            $cur_cgpa = mysqli_fetch_assoc($get_cur_cgpa);//$cur_cgpa['cgpa']
            $new_cgpa = ($cur_cgpa['cgpa'] + $sgpa) / 2;
             */

        }
        $update_tr_gen_flag = "UPDATE atkt_sessions SET tr_gen_flag=1 WHERE atkt_session_id=$atkt_sess_id";
        $update_tr_gen_flag_run = mysqli_query($conn, $update_tr_gen_flag);
                /*$update_cgpa="UPDATE students SET cgpa=".$new_cgpa." WHERE enrol_no='".$roll_id['enrol_no']."'";
                $update_cgpa_run=mysqli_query($conn,$update_cgpa);*/
        if ($insert_exam_summary_run == true && $update_tr_gen_flag_run && !$error) {
            $_SESSION['tr_generated_atkt'] = true;
            mysqli_commit($conn);

        } else {
            $_SESSION['tr_generated_atkt'] = false;
            mysqli_rollback($conn);
        }

    }
    header('location: super_home.php');


}
else if (isset($_POST['tab_retotal_submit'])) {
    //ATKT TR
    $semester = $_POST['tab_retotal_submit'];//Button's value which is clicked 
    $from_year = $_SESSION['from_year']; //Selected batch relevant to the tr
    $course_id = $_SESSION['course_id']; //Selected course's id

    mysqli_autocommit($conn, false);
    mysqli_begin_transaction($conn);
    $get_ac_session_id = "SELECT retotal_session_id,ac_session_id FROM retotal_sessions WHERE ac_session_id IN(SELECT ac_session_id FROM academic_sessions WHERE current_semester=$semester AND from_year=$from_year AND course_id=$course_id)";
    $get_ac_session_id_run = mysqli_query($conn, $get_ac_session_id);

    if (mysqli_num_rows($get_ac_session_id_run) > 0) {
        $result = mysqli_fetch_assoc($get_ac_session_id_run);
        $ac_session_id = $result['ac_session_id'];
        $retotal_sess_id = $result['retotal_session_id'];

        $error = false;

        $get_retotal_roll_list = "SELECT retotal_roll_id,roll_id FROM retotal_roll_list WHERE retotal_session_id=$retotal_sess_id";
        $get_retotal_roll_list_run = mysqli_query($conn, $get_retotal_roll_list);

        while ($roll_id = mysqli_fetch_assoc($get_retotal_roll_list_run)) {
            $get_tr = "SELECT * FROM tr WHERE roll_id=" . $roll_id['roll_id'];
            $get_tr_run = mysqli_query($conn, $get_tr);
            $total_credits_earned = 0;
            $total_earned_gpv = 0;
            $total_credits_allotted = 0;
            while ($row = mysqli_fetch_assoc($get_tr_run)) {

                $retotal_subjects = "SELECT count(*) FROM retotal_subjects WHERE retotal_roll_id=" . $roll_id['retotal_roll_id'] . " AND sub_id=" . $row['sub_id'];
                $retotal_subjects_run = mysqli_query($conn, $retotal_subjects);
                $cat_cap = $row['cat_cap'];
                $cat_cap = is_null($cat_cap) ? "NULL": $cat_cap;
                $end_sem = $row['end_sem'];
                $end_sem = is_null($end_sem) ? "NULL": $end_sem;
                $ia = $row['ia'];
                $ia = is_null($ia) ? "NULL": $ia ;
                $ie = $row['ie'];
                $ie = is_null($ie) ? "NULL":$ie;
                $get_sub_flag = "SELECT practical_flag,credits_allotted FROM sub_distribution WHERE sub_id=" . $row['sub_id'];
                $get_sub_flag_run = mysqli_query($conn, $get_sub_flag);
                $result = mysqli_fetch_assoc($get_sub_flag_run);
                $practical_flag = $result['practical_flag'];
                $total_credits_allotted += $result['credits_allotted'];
                $status_flag=1;
                if (mysqli_fetch_assoc($retotal_subjects_run)['count(*)'] > 0) {
                    // Take marks from score
                    $get_marks = "SELECT marks,component_id,status_flag FROM score_retotal WHERE retotal_roll_id=" . $roll_id['retotal_roll_id'] . " AND sub_id=" . $row['sub_id'];
                    $get_marks_run = mysqli_query($conn, $get_marks);
                    while ($marks = mysqli_fetch_assoc($get_marks_run)) {
                        $get_passing_marks = "SELECT passing_marks FROM component_distribution WHERE sub_id=" . $row['sub_id'] . " AND component_id=" . $marks['component_id'];
                        $get_passing_marks_run = mysqli_query($conn, $get_passing_marks);
                        $passing_marks = mysqli_fetch_assoc($get_passing_marks_run)['passing_marks'];
                        $status_flag=$marks['status_flag'];
                        if ($marks['marks'] < $passing_marks) {
                            $insert_retotal_failure = "INSERT INTO retotal_failure_report VALUES(" . $roll_id['retotal_roll_id'] . "," . $row['sub_id'] . "," . $marks['component_id'] . ")";
                            $insert_retotal_failure_run = mysqli_query($conn, $insert_retotal_failure);
                            if (!$insert_retotal_failure_run) {
                                $error = true;
                                mysqli_rollback($conn);
                                break;
                            }
                        }
                        switch ($marks['component_id']) {
                            case 1:
                                $cat_cap = $marks['marks'];
                                break;

                            case 2:
                                $end_sem = $marks['marks'];
                                break;

                            case 3:
                                $cat_cap = $marks['marks'];
                                break;

                            case 4:
                                $end_sem = $marks['marks'];
                                break;

                            case 5:
                                $ia = $marks['marks'];
                                break;

                            case 5:
                                $ie = $marks['marks'];
                                break;

                        }
                    }


                    $credits_allotted = $result['credits_allotted'];
                    if ($practical_flag == 0) {

                        $total = $cat_cap + $end_sem;
                        $percentage = (($total * 100) / 100);

                        if ($percentage >= 91 and $percentage <= 100) {
                            $grade = 'O';
                            $gp = 10;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 81 and $percentage < 91) {
                            $grade = 'A+';
                            $gp = 9;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 71 and $percentage < 81) {
                            $grade = 'A';
                            $gp = 8;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 61 and $percentage < 71) {
                            $grade = 'B+';
                            $gp = 7;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 51 and $percentage < 61) {
                            $grade = 'B';
                            $gp = 6;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 41 and $percentage < 51) {
                            $grade = 'C';
                            $gp = 5;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage == 40) {
                            $grade = 'P';
                            $gp = 4;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage < 40) {
                            $grade = 'F';
                            $gp = 0;
                            $cr = 0;
                            $gpv = $gp * $cr;
                        }
                        $total_credits_earned = $total_credits_earned + $cr;
                        $total_earned_gpv = $total_earned_gpv + $gpv;

                        $insert_retotal_tr = "INSERT INTO tr_retotal (retotal_roll_id,sub_id,cat_cap,end_sem,total,percent,grade,gp,cr,gpv,status_flag) VALUES(" . $roll_id['retotal_roll_id'] . "," . $row['sub_id'] . ",$cat_cap,$end_sem,$total,$percentage,'$grade',$gp,$cr,$gpv,$status_flag)";
                        $insert_retotal_tr_run = mysqli_query($conn, $insert_retotal_tr);

                        if (!$insert_retotal_tr_run) {

                            $error = true;
                            mysqli_rollback($conn);
                            break;
                        }

                    } else if ($practical_flag == 1) {

                        $total = $cat_cap + $end_sem + $ia;
                        $percentage = (($total * 100) / 100);

                        if ($percentage >= 91 and $percentage <= 100) {
                            $grade = 'O';
                            $gp = 10;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 81 and $percentage < 91) {
                            $grade = 'A+';
                            $gp = 9;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 71 and $percentage < 81) {
                            $grade = 'A';
                            $gp = 8;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 61 and $percentage < 71) {
                            $grade = 'B+';
                            $gp = 7;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 51 and $percentage < 61) {
                            $grade = 'B';
                            $gp = 6;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 41 and $percentage < 51) {
                            $grade = 'C';
                            $gp = 5;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage == 40) {
                            $grade = 'P';
                            $gp = 4;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage < 40) {
                            $grade = 'F';
                            $gp = 0;
                            $cr = 0;
                            $gpv = $gp * $cr;
                        }
                        $total_credits_earned = $total_credits_earned + $cr;
                        $total_earned_gpv = $total_earned_gpv + $gpv;

                        $insert_retotal_tr = "INSERT INTO tr_retotal (retotal_roll_id,sub_id,cat_cap,ia,end_sem,total,percent,grade,gp,cr,gpv,status_flag) VALUES(" . $roll_id['retotal_roll_id'] . "," . $row['sub_id'] . ",$cat_cap,$ia,$end_sem,$total,$percentage,'$grade',$gp,$cr,$gpv,$status_flag)";
                        $insert_retotal_tr_run = mysqli_query($conn, $insert_retotal_tr);

                        if (!$insert_retotal_tr_run) {

                            $error = true;
                            mysqli_rollback($conn);
                            break;
                        }


                    } /* else if ($practical_flag == 2) {

                        $total = $ie;
                        $percentage = (($total * 100) / 100);

                        if ($percentage >= 91 and $percentage <= 100) {
                            $grade = 'O';
                            $gp = 10;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 81 and $percentage < 91) {
                            $grade = 'A+';
                            $gp = 9;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 71 and $percentage < 81) {
                            $grade = 'A';
                            $gp = 8;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 61 and $percentage < 71) {
                            $grade = 'B+';
                            $gp = 7;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 51 and $percentage < 61) {
                            $grade = 'B';
                            $gp = 6;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage >= 41 and $percentage < 51) {
                            $grade = 'C';
                            $gp = 5;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage == 40) {
                            $grade = 'P';
                            $gp = 4;
                            $cr = $credits_allotted;
                            $gpv = $gp * $cr;
                        } else if ($percentage < 40) {
                            $grade = 'F';
                            $gp = 0;
                            $cr = 0;
                            $gpv = $gp * $cr;
                        }
                        $total_credits_earned = $total_credits_earned + $cr;
                        $total_earned_gpv = $total_earned_gpv + $gpv;

                        $insert_atkt_tr = "INSERT INTO tr_atkt (atkt_roll_id,sub_id,end_sem,total,percent,grade,gp,cr,gpv) VALUES(" . $roll_id['atkt_roll_id'] . "," . $row['sub_id'] . ",$ie,$total,$percentage,'$grade',$gp,$cr,$gpv)";
                        $insert_atkt_tr_run = mysqli_query($conn, $insert_atkt_tr);

                        if (!$insert_atkt_tr_run) {
                            $error = true;
                            mysqli_rollback($conn);
                            break;
                        }

                    } Left out for IE subject*/


                } else {
                        //Take marks directly from Main TR
                    $insert_retotal_tr = "INSERT INTO tr_retotal VALUES(" . $roll_id['retotal_roll_id'] . "," . $row['sub_id'] . "," . $cat_cap . "," . $ia . "," . $end_sem . "," . $ie . "," . $row['total'] . "," . $row['percent'] . ",'" . $row['grade'] . "'," . $row['gp'] . "," . $row['cr'] . "," . $row['gpv'] . ",1)";
                    $insert_retotal_tr_run = mysqli_query($conn, $insert_retotal_tr);
                    if (!$insert_retotal_tr_run) {
                    echo($insert_retotal_tr);
                        echo("Here");
                        $error = true;
                        mysqli_rollback($conn);
                        break;
                    } else {
                        $total_credits_earned = $total_credits_earned + $row['cr'];
                        $total_earned_gpv = $total_earned_gpv + $row['gpv'];
                    }
                }
            }


            $sgpa = $total_earned_gpv / $total_credits_allotted;

            $insert_exam_summary = "INSERT INTO retotal_exam_summary VALUES(" . $roll_id['retotal_roll_id'] . ", " . $total_credits_earned . ", " . $total_earned_gpv . ", " . $sgpa . ")";
            $insert_exam_summary_run = mysqli_query($conn, $insert_exam_summary);
            
            //????!!!!Doubtful Code!!!!
            //Updating CGPA
            /* $get_cur_cgpa = "SELECT cgpa FROM students WHERE enrol_no='" . $roll_id['enrol_no'] . "'";
            $get_cur_cgpa = mysqli_query($conn, $get_cur_cgpa);
            $cur_cgpa = mysqli_fetch_assoc($get_cur_cgpa);//$cur_cgpa['cgpa']
            $new_cgpa = ($cur_cgpa['cgpa'] + $sgpa) / 2;
             */

        }
        $update_tr_gen_flag = "UPDATE retotal_sessions SET tr_gen_flag=1 WHERE retotal_session_id=$retotal_sess_id";
        $update_tr_gen_flag_run = mysqli_query($conn, $update_tr_gen_flag);
                /*$update_cgpa="UPDATE students SET cgpa=".$new_cgpa." WHERE enrol_no='".$roll_id['enrol_no']."'";
                $update_cgpa_run=mysqli_query($conn,$update_cgpa);*/
        if ($insert_exam_summary_run == true && $update_tr_gen_flag_run && !$error) {
            $_SESSION['tr_generated_retotal'] = true;
            mysqli_commit($conn);

        } else {
            $_SESSION['tr_generated_retotal'] = false;
            mysqli_rollback($conn);
        }

    }
    header('location: super_home.php');


}
else {
    header('location: 404.html');
}
?>