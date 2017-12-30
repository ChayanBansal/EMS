<?php
require('config.php');
session_start();
if (isset($_POST["check_button"])) {
    $_SESSION['check_transaction_id'] = $_POST['check_button'];
    $get_check_detail = "SELECT A.*, T.operator_id, T.remark FROM auditing A, transactions T WHERE A.transaction_id=T.transaction_id AND A.transaction_id=" . $_SESSION['check_transaction_id'];
    $get_check_detail_run = mysqli_query($conn, $get_check_detail);
    while ($check_detail = mysqli_fetch_assoc($get_check_detail_run)) {
        $_SESSION['from_year'] = $check_detail['from_year'];
        $_SESSION['semester'] = $check_detail['semester'];
        $_SESSION['sub_code'] = $check_detail['sub_code'];
        $_SESSION['component_id'] = $check_detail['component_id'];
        $_SESSION['checked_by_operator_id'] = $check_detail['operator_id'];
        $_SESSION['remark'] = $check_detail['remark'];
    }
    if($check_detail['check_id']!="")
    {
        $_SESSION['already_checked']=true;
        header('location: useroptions.php');
    }
    $get_sub_name = "SELECT sub_name FROM subjects WHERE sub_code='" . $_SESSION['sub_code'] . "'";
    $get_sub_name_run = mysqli_query($conn, $get_sub_name);
    $result_sub_name = mysqli_fetch_assoc($get_sub_name_run);
    $_SESSION['sub_name'] = $result_sub_name['sub_name'];

    $get_component_name = "SELECT component_name FROM component WHERE component_id=" . $_SESSION['component_id'];
    $get_component_name_run = mysqli_query($conn, $get_component_name);
    $result_component_name = mysqli_fetch_assoc($get_component_name_run);
    $_SESSION['component_name'] = $result_component_name['component_name'];

    $get_operator_name = "SELECT operator_name FROM operators WHERE operator_id=" . $_SESSION['checked_by_operator_id'];
    $get_operator_name_run = mysqli_query($conn, $get_operator_name);
    $result_operator_name_run = mysqli_fetch_assoc($get_operator_name_run);
    $_SESSION['checked_by_operator_name'] = $result_operator_name_run['operator_name'];

    $get_maximum_marks = "SELECT max_marks FROM component_distribution WHERE component_id=" . $_SESSION['component_id'] . " AND sub_id IN(SELECT sub_id FROM sub_distribution WHERE sub_code='" . $_SESSION['sub_code'] . "')";
    $get_maximum_marks_run = mysqli_query($conn, $get_maximum_marks);
    $result_max_marks = mysqli_fetch_assoc($get_maximum_marks_run);
    $_SESSION['max_marks'] = $result_max_marks['max_marks'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check & Verify</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .remarks{
            border: 4px solid #581CA0 !important;
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
    <script src="../js/feed_validation.js"></script>
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
$obj = new head();
$obj->displayheader();
$obj->dispmenu(4, ["home.php", "index.php", "useroptions.php", "developers.php"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", 'glyphicon glyphicon-th', "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "Options", "About Us"]);
$dashboard = new dashboard();
$dashboard->display($_SESSION['operator_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "Contact Super Admin");

$input = new input_field();
$input_btn = new input_button();
?>
 <div id="err"></div>
 <form action="update_marks.php<?php /*echo($_SESSION['PHP_SELF']);*/?>" method="post">
     <div class="feed-container">
        <div class="subselected">
        <div class="subtitle">
           Showing results For
            </div>
            <div class="subtitle">
            <?=$_SESSION['sub_name']?>   
        </div>

        <div class="subtitle">
            <?=$_SESSION['component_name']?>   
        </div>
             </div>
     <table class="table table-striped table-responsive table-bordered">
     <caption> <input class="form-control input-lg" id="searchbarchecking" type="text" placeholder="Search students.."></caption>
     <thead>
      <tr>
        <th>Enrollment Number</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Lastname</th>
        <th>Father Name</th>
        <th>Marks</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody id="checking_table">
     <?php 
        $get_fed_marks="SELECT st.enrol_no, st.first_name, st.middle_name, st.last_name, st.father_name, sc.marks, r.roll_id FROM students st, score sc, roll_list r WHERE sc.roll_id=r.roll_id AND r.enrol_no=st.enrol_no AND sc.transaction_id=".$_SESSION['check_transaction_id']." AND st.enrol_no IN
                        (SELECT enrol_no FROM students WHERE from_year=".$_SESSION['from_year']." AND course_id=".$_SESSION['current_course_id'].")";
        $get_fed_marks_run=mysqli_query($conn,$get_fed_marks);
        while($fed_marks=mysqli_fetch_assoc($get_fed_marks_run))
        {
            echo('<tr>');
                echo('<td>'.$fed_marks['enrol_no'].'</td>');
                echo('<td>'.$fed_marks['first_name'].'</td>');
                echo('<td>'.$fed_marks['middle_name'].'</td>');
                echo('<td>'.$fed_marks['last_name'].'</td>');
                echo('<td>'.$fed_marks['father_name'].'</td>');
                echo('<td><input class="form-control" id="'.$fed_marks['enrol_no'].'" type="number" name="'.$fed_marks['enrol_no'].'" min="0" max="'.$_SESSION['max_marks'].'" value="'.$fed_marks['marks'].'" required readonly></td>');
                echo('<td><button class="btn btn-default form-control" type="button" value="'.$fed_marks['enrol_no'].'" onClick="remove_readonly(this.value)" >Change</button></td>');
            echo('</tr>');
        }
     ?>
    </tbody>
  </table>
  <div class="remarks">
      <?php
        $textarea = new input_field();
        $btn = new input_button();
        ?>
      <div>
          <label for="review">Additional Remarks</label>
      <?php
        $textarea->display_textarea("review", "reviewtext form-control", "remark", "", "3", "100", 1);

        ?>
      <span id="controls"><center><?php
                                    echo('<input type="submit" class="btn btn-primary" name="check_done" value="Submit All">');//$btn->display_btn("", "btn btn-primary", "submit", "check_done", "", "Submit All"); ?></span> <!--($id, $class, $type, $name, $onclick, $value-->
      </center></div>
      
  </div>
  </div>
    </form>

    
<?php
$obj = new footer();
$obj->disp_footer();
?>

</body>
<script>
    function setvalues(el){
        var fname=el.getAttribute("data-first-name");
        var lname=el.getAttribute("data-last-name");
        document.getElementById("stud_name").value=fname+" "+lname;
    }
    $(document).ready(function(){
  $("#searchbarchecking").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#checking_table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});

</script>
</html>