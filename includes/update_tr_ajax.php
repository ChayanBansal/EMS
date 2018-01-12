<?php
require('config.php');
require('class_lib.php');
if (isset($_POST['tr_subcode'])) {
    $get_comp = "SELECT component_id,component_name FROM component WHERE component_id IN(SELECT component_id FROM component_distribution WHERE sub_id IN(SELECT sub_id FROM sub_distribution WHERE sub_code IN(SELECT sub_code FROM subjects WHERE sub_code='" . $_POST['tr_subcode'] . "')))";
    $get_comp_run = mysqli_query($conn, $get_comp);
    if ($get_comp_run) {
        $check_box = new input_field();
        while ($comp = mysqli_fetch_assoc($get_comp_run)) {
            echo ('<label class="checkbox-inline" style="font-weight: normal !important">
                  ');
            $check_box->display_w_value("", "", "checkbox","tr_update_check".$comp['component_id'],"",$comp['component_id'],0);
                echo ($comp['component_name'].'</label>');
        }
    }
    else{
        echo("Error! Unable to fetch components!");
    }
}
?>