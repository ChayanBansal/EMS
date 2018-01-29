<?php
    require('config.php');
    if($_POST['feed_activity']==1)
    {
        $get_month_data="SELECT transaction_id, operator_id, `timestamp` FROM transactions WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(CURDATE()) - 1 DAY)";
        $get_month_data_run=mysqli_query($conn,$get_month_data);
        if($get_month_data_run)
        {
            while($data=mysqli_fetch_assoc($get_month_data_run))
            {
                $get_op_name="SELECT operator_name FROM operators WHERE operator_id=".$data['operator_id'];
                $get_op_namr_run=mysqli_query($conn,$get_op_name);
                $op_name=mysqli_fetch_assoc($get_op_namr_run);
                //$op_name['operator_name']

                $get_audit="SELECT component_id, sub_code, semester, atkt_flag, course_id, from_year FROM auditing WHERE transaction_id=".$data['transaction_id'];
                $get_audit_run=mysqli_query($conn,$get_audit);
                
                if($get_audit_run)
                {
                    $audit=mysqli_fetch_assoc($get_audit_run);
                    //$audit['component_id'] $audit['sub_code'] $audit['semester'] $audit['atkt_flag'] $audit['course_id'] $audit['from_year']

                    $get_sub_name="SELECT sub_name FROM subjects WHERE sub_code='".$audit['sub_code']."'";
                    $get_sub_run=mysqli_query($conn,$get_sub_name);
                    $sub_name=mysqli_fetch_assoc($get_sub_run);
                    //$sub_name['sub_name']

                    $get_comp_name="SELECT component_name FROM component WHERE component_id=".$audit['component_id'];
                    $get_comp_run=mysqli_query($conn,$get_comp_name);
                    $comp_name=mysqli_fetch_assoc($get_comp_run);
                    //$comp_name['component_name']

                    $get_course_name="SELECT course_name FROM courses WHERE course_id=".$audit['course_id'];
                    $get_course_run=mysqli_query($conn,$get_course_name);
                    $course_name=mysqli_fetch_assoc($get_course_run);
                    //$course_name['course_name']

                    echo('<li class="list-group-item" style="font-size:1.5rem">');
                        echo("<span style='color: #FF9702; font-size:1.5rem'>".$data['timestamp'].": </span><br>".$op_name['operator_name']." fed marks for batch ".$audit['from_year']." of ".$course_name['course_name']." of subject ".$sub_name['sub_name']." (".$audit['sub_code'].") of ".$comp_name['component_name']." (");
                            if($audit['atkt_flag']==1)
                            {
                                echo('ATKT) ');
                            }
                            else
                            {
                                echo('MAIN) ');
                            }
                    echo('</li>');
                }
            }
        }
    }
    if($_POST['feed_activity']==0)
    {
        $get_month_data="SELECT check_id, operator_id, `timestamp` FROM checking WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(CURDATE()) - 1 DAY)";
        $get_month_data_run=mysqli_query($conn,$get_month_data);
        if($get_month_data_run)
        {
            while($data=mysqli_fetch_assoc($get_month_data_run))
            {
                $get_op_name="SELECT operator_name FROM operators WHERE operator_id=".$data['operator_id'];
                $get_op_namr_run=mysqli_query($conn,$get_op_name);
                $op_name=mysqli_fetch_assoc($get_op_namr_run);
                //$op_name['operator_name']

                $get_audit="SELECT component_id, sub_code, semester, atkt_flag, course_id, from_year FROM auditing WHERE check_id=".$data['check_id'];
                $get_audit_run=mysqli_query($conn,$get_audit);
                
                if($get_audit_run)
                {
                    $audit=mysqli_fetch_assoc($get_audit_run);
                    //$audit['component_id'] $audit['sub_code'] $audit['semester'] $audit['atkt_flag'] $audit['course_id'] $audit['from_year']

                    $get_sub_name="SELECT sub_name FROM subjects WHERE sub_code='".$audit['sub_code']."'";
                    $get_sub_run=mysqli_query($conn,$get_sub_name);
                    $sub_name=mysqli_fetch_assoc($get_sub_run);
                    //$sub_name['sub_name']

                    $get_comp_name="SELECT component_name FROM component WHERE component_id=".$audit['component_id'];
                    $get_comp_run=mysqli_query($conn,$get_comp_name);
                    $comp_name=mysqli_fetch_assoc($get_comp_run);
                    //$comp_name['component_name']

                    $get_course_name="SELECT course_name FROM courses WHERE course_id=".$audit['course_id'];
                    $get_course_run=mysqli_query($conn,$get_course_name);
                    $course_name=mysqli_fetch_assoc($get_course_run);
                    //$course_name['course_name']

                    echo('<li class="list-group-item" style="font-size:1.5rem">');
                        echo("<span style='color: #FF9702; font-size:1.5rem'>".$data['timestamp'].": </span><br>".$op_name['operator_name']." checked marks for batch ".$audit['from_year']." of ".$course_name['course_name']." of subject ".$sub_name['sub_name']." (".$audit['sub_code'].") of ".$comp_name['component_name']." (");
                            if($audit['atkt_flag']==1)
                            {
                                echo('ATKT) ');
                            }
                            else
                            {
                                echo('MAIN) ');
                            }
                    echo('</li>');
                }
            }
        }
    }
?>