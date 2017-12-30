<?php
    require('config.php');
    require('class_lib.php');
    session_start();
    if(isset($_POST['check_done']))
    {
        try{
            mysqli_autocommit($conn,FALSE);
            mysqli_begin_transaction($conn);
            $create_check_id="INSERT INTO checking(operator_id, remark) VALUES(".$_SESSION['operator_id'].",'".$_POST['remark']."')"; //check_id	operator_id	timestamp	remark
            $create_check_id_run=mysqli_query($conn,$create_check_id);
            $check_id=mysqli_insert_id($conn);

        $update_score = "SELECT st.enrol_no, r.roll_id FROM students st, score sc, roll_list r WHERE sc.roll_id=r.roll_id AND r.enrol_no=st.enrol_no AND sc.transaction_id=" . $_SESSION['check_transaction_id'] . " AND st.enrol_no IN
            (SELECT enrol_no FROM students WHERE from_year=" . $_SESSION['from_year'] . " AND course_id=" . $_SESSION['current_course_id'] . ")";
        $update_score_run = mysqli_query($conn, $update_score);

        while ($new_score = mysqli_fetch_assoc($update_score_run)) {
            $update_record = "UPDATE score SET marks=" . $_POST[$new_score['enrol_no']] . ", check_id=" . $check_id . " WHERE roll_id=" . $new_score['roll_id'] ." AND transaction_id=". $_SESSION['check_transaction_id'];
            $update_record_run = mysqli_query($conn, $update_record);
        }

        $update_auditing = "UPDATE auditing SET check_id=".$check_id." WHERE transaction_id=" . $_SESSION['check_transaction_id'];
        $update_auditing_run = mysqli_query($conn, $update_auditing);
        mysqli_commit($conn);
        header('location: useroptions.php');
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $al = new alert();
        $al->exec("Not able to execute the updation. Please try again!", "danger");
    }
}

?>