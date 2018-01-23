<?php
require('config.php');
session_start();
if (isset($_POST['tr_edit_close'])) {
    $close_request = "UPDATE edit_tr_request SET status=3 WHERE request_id=" . $_POST['tr_edit_close'];
    $close_request_run = mysqli_query($conn, $close_request);
}
if (isset($_POST['tr_edit_submit'])) {
    $request_id = $_POST['tr_edit_submit'];
    $get_request_details = "SELECT * FROM edit_tr_request WHERE request_id=" . $request_id;
    $get_request_details_run = mysqli_query($conn, $get_request_details);
    if ($get_request_details_run) {
        $req_details = mysqli_fetch_assoc($get_request_details_run);
        $subcode = $req_details['sub_code'];
        $enroll = "SELECT enrol_no FROM roll_list WHERE roll_id=" . $req_details['roll_id'];
        $enroll = mysqli_query($conn, $enroll);
        $enroll = mysqli_fetch_assoc($enroll)['enrol_no'];
        $rollid = $req_details['roll_id'];
    }
} else {
    //header('location: 404.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update TR</title>
    <link rel="stylesheet" href="/ems/css/style.css">
    <style>
         .remarks{
            border: 1px dashed #581CA0 !important;
            border-radius: 7px;
            padding: 20px;
        }
        #controls{
            width: 100%;
            text-align: center;
        }
    button[type=submit]{
        border: none;
        background: rgba(26, 87, 182,0.7);
        color: white;
        padding: 1.5rem;
        font-family: 'Roboto', sans-serif;  
        font-size: 2rem;
        text-transform: uppercase;
        transition: all 400ms;
    }
    
    button[type=submit]:hover{
        animation: moveup 300ms 1 ease-in-out;
        animation-fill-mode: forwards;
        background: rgba(255,255,255,0.8);
        color: #1A57B6;    
        box-shadow: 4px 4px 4px rgba(0,0,0,0.6);
        cursor: pointer;
    }
    .subtitle{
        padding: 10px;
        font-family: 'Open Sans';
        text-transform: uppercase;
        border-bottom: 1px dotted black;
        
    }
    table.table-bordered > thead > tr >th{
        border: 1px solid #204F93 !important;
    }
    table tr td,table tr th{
        text-align: center;
        font-size: 1.6rem;
    }
    table.table-bordered > tbody > tr >td{
        border: 1px solid #204F93 !important;
    }
    </style>
    <script src="/ems/js/feed_validation.js"></script>
    <script>
        function remove_readonly(value)
        {
            if(document.getElementById(value).hasAttribute("readonly"))
            {
                $("#"+value).removeAttr("readonly");
            }
            else
            {
                $("#"+value).attr("readonly",'');
            }
        }
    </script>
</head>
<body>

<?php
require("config.php");
require("frontend_lib.php");
require("class_lib.php");
$validate = new validate();
$validate->conf_logged_in();
$obj = new head();
$obj->displayheader();
$obj->dispmenu(4, ["home", "index", "useroptions", "developers"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", 'glyphicon glyphicon-th', "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "Options", "About Us"]);
$dashboard = new dashboard();
$dashboard->display($_SESSION['operator_name'], ["Change Password", "Sign Out"], ["change_password", "index"], "Contact Super Admin");
$options=new useroptions();
$options->update_tr($conn);
$input = new input_field();
$input_btn = new input_button();
?>
 <div id="err" style="position: fixed; top: 0; width: 100%"></div>
 <form action="" method="post">
     <div class="feed-container">
        <div class="subselected">
        <div class="subtitle">
           Update TR Entries For
            </div>
            <div class="subtitle">
            Enrollment No: <?= $enroll ?>   
        </div>
        <div class="subtitle">
           Subject Code: <?= $subcode ?>
        </div>
            </div>
     <table class="table table-striped table-responsive table-bordered">
     <thead>
      <tr>
        <th>Component Name</th>
        <th>Previous Marks Entered</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody id="checking_table">
     <?php 
    $get_comp = "SELECT component_name,component_id FROM component WHERE component_id IN(SELECT component_id FROM component_distribution WHERE sub_id IN(SELECT sub_id FROM sub_distribution WHERE sub_code='" . $subcode . "'))";
    $get_comp_run = mysqli_query($conn, $get_comp);
    while ($comp = mysqli_fetch_assoc($get_comp_run)) {
        switch ($comp['component_id']) {
            case 1:
                if ($req_details['cat_flag'] == 1) {
                    echo ('<td>' . $comp['component_name'] . '</td>');
                    $get_sub_id = "SELECT sub_id FROM component_distribution WHERE component_id=1 AND sub_id IN(SELECT sub_id from sub_distribution WHERE sub_code='$subcode')";
                    $get_sub_id = mysqli_query($conn, $get_sub_id);
                    $subid = mysqli_fetch_assoc($get_sub_id)['sub_id'];
                    $max_marks = "SELECT max_marks FROM component_distribution WHERE component_id=1 AND sub_id=$subid";
                    $max_marks = round(mysqli_fetch_assoc(mysqli_query($conn, $max_marks))['max_marks']);
                    $get_tr_marks = "SELECT marks FROM score WHERE roll_id=$rollid AND sub_id=$subid AND component_id=1";
                    $get_tr_marks = mysqli_query($conn, $get_tr_marks);
                    $marks = mysqli_fetch_assoc($get_tr_marks)['marks'];
                    echo ('<td><input class="form-control" id="cat_marks" type="number" name="cat_marks" min="0" max="' . $max_marks . '" value="' . $marks . '" required readonly onkeyup="validate(this,' . $max_marks . ')" onfocusout="validate_focus(this,' . $max_marks . ')"></td>');
                    echo ('<td><button class="btn btn-default form-control" type="button" value="cat_marks" onClick="remove_readonly(this.value)" >Change</button></td>');
                    echo ('</tr>');
                }
                break;
            case 2:
                if ($req_details['end_theory_flag'] == 1) {
                    echo ('<td>' . $comp['component_name'] . '</td>');
                    $get_sub_id = "SELECT sub_id FROM component_distribution WHERE component_id=2 AND sub_id IN(SELECT sub_id from sub_distribution WHERE sub_code='$subcode')";
                    $get_sub_id = mysqli_query($conn, $get_sub_id);
                    $subid = mysqli_fetch_assoc($get_sub_id)['sub_id'];
                    $max_marks = "SELECT max_marks FROM component_distribution WHERE component_id=1 AND sub_id=$subid";
                    $max_marks = round(mysqli_fetch_assoc(mysqli_query($conn, $max_marks))['max_marks']);

                    $get_tr_marks = "SELECT marks FROM score WHERE roll_id=$rollid AND sub_id=$subid AND component_id=2";
                    $get_tr_marks = mysqli_query($conn, $get_tr_marks);
                    $marks = mysqli_fetch_assoc($get_tr_marks)['marks'];
                    echo ('<td><input class="form-control" id="end_th_marks" type="number" name="end_th_marks" min="0" max="' . $max_marks . '" value="' . $marks . '" required readonly onkeyup="validate(this,' . $max_marks . ')" onfocusout="validate_focus(this,' . $max_marks . ')"></td>');
                    echo ('<td><button class="btn btn-default form-control" type="button" value="end_th_marks" onClick="remove_readonly(this.value)" >Change</button></td>');
                    echo ('</tr>');
                }
                break;

            case 3:
                if ($req_details['cap_flag'] == 1) {
                    echo ('<td>' . $comp['component_name'] . '</td>');
                    $get_sub_id = "SELECT sub_id FROM component_distribution WHERE component_id=3 AND sub_id IN(SELECT sub_id from sub_distribution WHERE sub_code='$subcode')";
                    $get_sub_id = mysqli_query($conn, $get_sub_id);
                    $subid = mysqli_fetch_assoc($get_sub_id)['sub_id'];
                    $max_marks = "SELECT max_marks FROM component_distribution WHERE component_id=1 AND sub_id=$subid";
                    $max_marks = round(mysqli_fetch_assoc(mysqli_query($conn, $max_marks))['max_marks']);

                    $get_tr_marks = "SELECT marks FROM score WHERE roll_id=$rollid AND sub_id=$subid AND component_id=3";
                    $get_tr_marks = mysqli_query($conn, $get_tr_marks);
                    $marks = mysqli_fetch_assoc($get_tr_marks)['marks'];
                    echo ('<td><input class="form-control" id="cap_marks" type="number" name="cap_marks" min="0" max="' . $max_marks . '" value="' . $marks . '" required readonly onkeyup="validate(this,' . $max_marks . ')" onfocusout="validate_focus(this,' . $max_marks . ')"></td>');
                    echo ('<td><button class="btn btn-default form-control" type="button" value="cap_marks" onClick="remove_readonly(this.value)" >Change</button></td>');
                    echo ('</tr>');
                }
                break;

            case 4:
                if ($req_details['end_practical_flag'] == 1) {
                    echo ('<td>' . $comp['component_name'] . '</td>');
                    $get_sub_id = "SELECT sub_id FROM component_distribution WHERE component_id=4 AND sub_id IN(SELECT sub_id from sub_distribution WHERE sub_code='$subcode')";
                    $get_sub_id = mysqli_query($conn, $get_sub_id);
                    $subid = mysqli_fetch_assoc($get_sub_id)['sub_id'];
                    $max_marks = "SELECT max_marks FROM component_distribution WHERE component_id=1 AND sub_id=$subid";
                    $max_marks = round(mysqli_fetch_assoc(mysqli_query($conn, $max_marks))['max_marks']);

                    $get_tr_marks = "SELECT marks FROM score WHERE roll_id=$rollid AND sub_id=$subid AND component_id=4";
                    $get_tr_marks = mysqli_query($conn, $get_tr_marks);
                    $marks = mysqli_fetch_assoc($get_tr_marks)['marks'];
                    echo ('<td><input class="form-control" id="end_pr_marks" type="number" name="end_pr_marks" min="0" max="' . $max_marks . '" value="' . $marks . '" required readonly onkeyup="validate(this,' . $max_marks . ')" onfocusout="validate_focus(this,' . $max_marks . ')"></td>');
                    echo ('<td><button class="btn btn-default form-control" type="button" value="end_pr_marks" onClick="remove_readonly(this.value)" >Change</button></td>');
                    echo ('</tr>');
                }
                break;

            case 5:
                if ($req_details['ia_flag'] == 1) {
                    echo ('<td>' . $comp['component_name'] . '</td>');
                    $get_sub_id = "SELECT sub_id FROM component_distribution WHERE component_id=5 AND sub_id IN(SELECT sub_id from sub_distribution WHERE sub_code='$subcode')";
                    $get_sub_id = mysqli_query($conn, $get_sub_id);
                    $subid = mysqli_fetch_assoc($get_sub_id)['sub_id'];
                    $max_marks = "SELECT max_marks FROM component_distribution WHERE component_id=1 AND sub_id=$subid";
                    $max_marks = round(mysqli_fetch_assoc(mysqli_query($conn, $max_marks))['max_marks']);

                    $get_tr_marks = "SELECT marks FROM score WHERE roll_id=$rollid AND sub_id=$subid AND component_id=5";
                    $get_tr_marks = mysqli_query($conn, $get_tr_marks);
                    $marks = mysqli_fetch_assoc($get_tr_marks)['marks'];
                    echo ('<td><input class="form-control" id="ia_marks" type="number" name="ia_marks" min="0" max="' . $max_marks . '" value="' . $marks . '" required readonly onkeyup="validate(this,' . $max_marks . ')" onfocusout="validate_focus(this,' . $max_marks . ')"></td>');
                    echo ('<td><button class="btn btn-default form-control" type="button" value="ia_marks" onClick="remove_readonly(this.value)" >Change</button></td>');
                    echo ('</tr>');
                }
                break;

            case 6:
                if ($req_details['ie_flag'] == 1) {
                    echo ('<td>' . $comp['component_name'] . '</td>');
                    $get_sub_id = "SELECT sub_id FROM component_distribution WHERE component_id=1 AND sub_id IN(SELECT sub_id from sub_distribution WHERE sub_code='$subcode')";
                    $get_sub_id = mysqli_query($conn, $get_sub_id);
                    $subid = mysqli_fetch_assoc($get_sub_id)['sub_id'];
                    $max_marks = "SELECT max_marks FROM component_distribution WHERE component_id=1 AND sub_id=$subid";
                    $max_marks = round(mysqli_fetch_assoc(mysqli_query($conn, $max_marks))['max_marks']);
                    $get_tr_marks = "SELECT marks FROM score WHERE roll_id=$rollid AND sub_id=$subid AND component_id=6";
                    $get_tr_marks = mysqli_query($conn, $get_tr_marks);
                    $marks = mysqli_fetch_assoc($get_tr_marks)['marks'];
                    echo ('<td><input class="form-control" id="ie_marks" type="number" name="ie_marks" min="0" max="' . $max_marks . '" value="' . $marks . '" required readonly onkeyup="validate(this,' . $max_marks . ')" onfocusout="validate_focus(this,' . $max_marks . ')"></td>');
                    echo ('<td><button class="btn btn-default form-control" type="button" value="ie_marks" onClick="remove_readonly(this.value)" >Change</button></td>');
                    echo ('</tr>');
                }
                break;
        }
    }
    ?>
    </tbody>
  </table>
  <div class="remarks">
      <span id="controls"><center><?php
        echo ('<button type="submit" class="btn btn-primary" name="tr_update_done" value="'.$request_id.'">Submit Update</button>'); ?>
        </span>
      </center></div>
      
  </div>
  </div>
    </form>
    
<?php
$obj = new footer();
$obj->disp_footer();
?>
</body>
</html>