<?php
require('config.php');
require('class_lib.php');
session_start();
if (isset($_POST['check_done'])) {
    try {
        $input_chk = new input_check();
        $remark = $input_chk->input_safe($conn, $_POST['remark']);
        mysqli_autocommit($conn, false);
        mysqli_begin_transaction($conn);
        if (empty($remark)) {
            throw new Exception("Unable to execute update! Please check all fields..");
        }
        $create_check_id = "INSERT INTO checking(operator_id, remark) VALUES(" . $_SESSION['operator_id'] . ",'" . $remark . "')"; //check_id	operator_id	timestamp	remark
        $create_check_id_run = mysqli_query($conn, $create_check_id);
        $check_id = mysqli_insert_id($conn);

        $update_score = "SELECT st.enrol_no, r.roll_id FROM students st, score sc, roll_list r WHERE sc.roll_id=r.roll_id AND r.enrol_no=st.enrol_no AND sc.transaction_id=" . $_SESSION['check_transaction_id'] . " AND st.enrol_no IN
            (SELECT enrol_no FROM students WHERE ac_session_id IN(SELECT ac_session_id FROM academic_sessions WHERE from_year=" . $_SESSION['from_year'] . " AND course_id=" . $_SESSION['current_course_id'] . "))";
        $update_score_run = mysqli_query($conn, $update_score);

        while ($new_score = mysqli_fetch_assoc($update_score_run)) {
            $new_score_marks = $input_chk->input_safe($conn, $_POST[$new_score['enrol_no']]);
            if (!isset($new_score_marks) or is_nan($new_score_marks)) {
                throw new Exception("Unable to execute update! Please check all fields..");
            }
            $update_record = "UPDATE score SET marks=" . $new_score_marks . ", check_id=" . $check_id . " WHERE roll_id=" . $new_score['roll_id'] . " AND transaction_id=" . $_SESSION['check_transaction_id'];
            $update_record_run = mysqli_query($conn, $update_record);
        }

        $update_auditing = "UPDATE auditing SET check_id=" . $check_id . " WHERE transaction_id=" . $_SESSION['check_transaction_id'] . " AND type_flag=0";
        $update_auditing_run = mysqli_query($conn, $update_auditing);
        if ($update_auditing_run) {
            mysqli_commit($conn);
            header('location: useroptions');
        } else {
            mysqli_rollback($conn);
        }
        mysqli_commit($conn);
        header('location: useroptions');
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $al = new alert();
        $al->exec("Not able to execute the updation. Please try again!", "danger");
        header('location: useroptions');
    }
} else if (isset($_POST['check_done_atkt'])) {
    try {
        $input_chk = new input_check();
        $remark = $input_chk->input_safe($conn, $_POST['remark']);
        mysqli_autocommit($conn, false);
        mysqli_begin_transaction($conn);
        if (empty($remark)) {
            throw new Exception("Unable to execute update! Please check all fields..");
        }
        $create_check_id = "INSERT INTO checking(operator_id, remark) VALUES(" . $_SESSION['operator_id'] . ",'" . $remark . "')"; //check_id	operator_id	timestamp	remark
        $create_check_id_run = mysqli_query($conn, $create_check_id);
        $check_id = mysqli_insert_id($conn);

        $update_score = "SELECT st.enrol_no, atktrl.atkt_roll_id FROM students st, score_atkt sc, atkt_roll_list atktrl, roll_list r WHERE sc.atkt_roll_id=atktrl.atkt_roll_id AND atktrl.roll_id=r.roll_id AND r.enrol_no=st.enrol_no AND sc.transaction_id=" . $_SESSION['check_transaction_id'] . " AND atktrl.atkt_session_id IN(SELECT atkt_session_id FROM atkt_sessions WHERE ac_session_id IN (SELECT ac_session_id from academic_sessions WHERE from_year=" . $_SESSION['from_year'] . " AND course_id=" . $_SESSION['current_course_id'] . "))";
        $update_score_run = mysqli_query($conn, $update_score);

        while ($new_score = mysqli_fetch_assoc($update_score_run)) {
            $new_score_marks = $input_chk->input_safe($conn, $_POST[$new_score['enrol_no']]);
            if (!isset($new_score_marks) or is_nan($new_score_marks)) {
                throw new Exception("Unable to execute update! Please check all fields..");
            }
            $update_record = "UPDATE score_atkt SET marks=" . $new_score_marks . ", check_id=" . $check_id . " WHERE atkt_roll_id=" . $new_score['atkt_roll_id'] . " AND transaction_id=" . $_SESSION['check_transaction_id'];
            $update_record_run = mysqli_query($conn, $update_record);
        }

        $update_auditing = "UPDATE auditing SET check_id=" . $check_id . " WHERE transaction_id=" . $_SESSION['check_transaction_id'] . " AND type_flag=3";
        $update_auditing_run = mysqli_query($conn, $update_auditing);
        if ($update_auditing_run) {
            mysqli_commit($conn);
            header('location: useroptions');
        } else {
            mysqli_rollback($conn);
        }
        mysqli_commit($conn);
        header('location: useroptions');
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $al = new alert();
        $al->exec("Not able to execute the updation. Please try again!", "danger");
        header('location: useroptions');
    }
} else if (isset($_POST['check_done_retotal'])) {
    try {
        $input_chk = new input_check();
        $remark = $input_chk->input_safe($conn, $_POST['remark']);
        mysqli_autocommit($conn, false);
        mysqli_begin_transaction($conn);
        if (empty($remark)) {
            throw new Exception("Unable to execute update! Please check all fields..");
        }
        $create_check_id = "INSERT INTO checking(operator_id, remark) VALUES(" . $_SESSION['operator_id'] . ",'" . $remark . "')"; //check_id	operator_id	timestamp	remark
        $create_check_id_run = mysqli_query($conn, $create_check_id);
        $check_id = mysqli_insert_id($conn);

        $update_score = "SELECT st.enrol_no, retotalrl.retotal_roll_id,retotalrl.roll_id FROM students st, score_retotal sc, retotal_roll_list retotalrl, roll_list r WHERE sc.retotal_roll_id=retotalrl.retotal_roll_id AND retotalrl.roll_id=r.roll_id AND r.enrol_no=st.enrol_no AND sc.transaction_id=" . $_SESSION['check_transaction_id'] . " AND retotalrl.retotal_session_id IN(SELECT retotal_session_id FROM retotal_sessions WHERE ac_session_id IN (SELECT ac_session_id from academic_sessions WHERE from_year=" . $_SESSION['from_year'] . " AND course_id=" . $_SESSION['current_course_id'] . "))";
        $update_score_run = mysqli_query($conn, $update_score);

        while ($new_score = mysqli_fetch_assoc($update_score_run)) {
            $new_score_marks = $input_chk->input_safe($conn, $_POST[$new_score['enrol_no']]);
            if (!isset($new_score_marks) or is_nan($new_score_marks)) {
                throw new Exception("Unable to execute update! Please check all fields..");
            }
            $get_prev_marks = "SELECT marks,status_flag FROM score_retotal WHERE roll_id=" . $new_score['roll_id'] . " AND component_id=" . $_SESSION['component_id'] . " AND transaction_id=" . $_SESSION['check_transaction_id'];
            $get_prev_marks_run = mysqli_query($conn, $get_prev_marks_run);
            $result = mysqli_fetch_assoc($get_prev_marks_run);
            $prev_marks = $result['marks'];
            $status_flag = $result['status_flag'];
            if ($new_score_marks > $prev_marks) {
                $status_flag = 2;
            } else if ($new_score_marks < $prev_marks) {
                $status_flag = 0;
            }
            $update_record = "UPDATE score_retotal SET marks=" . $new_score_marks . ", check_id=" . $check_id . ", status_flag=$status_flag WHERE retotal_roll_id=" . $new_score['retotal_roll_id'] . " AND transaction_id=" . $_SESSION['check_transaction_id'];
            $update_record_run = mysqli_query($conn, $update_record);
        }

        $update_auditing = "UPDATE auditing SET check_id=" . $check_id . " WHERE transaction_id=" . $_SESSION['check_transaction_id'] . " AND type_flag=1";
        $update_auditing_run = mysqli_query($conn, $update_auditing);
        if ($update_auditing_run) {
            mysqli_commit($conn);
            header('location: useroptions');
        } else {
            mysqli_rollback($conn);
        }
        mysqli_commit($conn);
        header('location: useroptions');
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $al = new alert();
        $al->exec("Not able to execute the updation. Please try again!", "danger");
        header('location: useroptions');
    }
}
?>