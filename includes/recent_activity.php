<?php
    $get_month_data="SELECT transaction_id, operator_id, `timestamp` FROM transactions WHERE `timestamp` >= DATE_SUB(CURDATE(), INTERVAL DAYOFMONTH(CURDATE()) - 1 DAY)";
    $get_month_data_run=mysqli_query($conn,$get_month_data);
    while($data=mysqli_fetch_assoc($get_month_data_run))
    {
        $get_op_name="SELECT operator_name FROM operators WHERE operator_id=".$data['operator_id'];
        $get_op_namr_run=mysqli_query($conn,$get_op_name);
        $op_name=mysqli_fetch_assoc($get_op_namr_run);
        //$op_name['operator_name']

        $get_audit="SELECT component_id, sub_code, semester, atkt_flag, course_id, from_year FROM auditing WHERE transaction_id=".$data['transaction_id'];
        $get_audit_run=mysqli_query($conn,$get_audit);
        $audit=mysqli_fetch_assoc($get_audit_run);
        //$audit['component_id'] $audit['sub_code'] $audit['semester'] $audit['atkt_flag'] $audit['course_id'] $audit['from_year']

        $get_sub_name="SELECT sub_name FROM subjects WHERE sub_code='".$audit['sub_code']."'";
        $get_sub_run=mysqli_query($conn,$get_sub_name);
        $sub_name=mysqli_fetch_assoc($get_sub_run);
        //$sub_name['sub_name']

        $get_comp_name="SELECT component_name FROM component WHERE component_id=".$audit['component_id'];
        $get_comp_run=mysqli_query($conn,$get_comp_name);
        $sub_comp=mysqli_fetch_assoc($get_comp_run);
        //$comp_name['component_name']

        echo('<p>');
            echo();

    }

?>