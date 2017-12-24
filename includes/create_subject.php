<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Subject</title>
    <link rel="stylesheet" href="/ems/css/style.css">
    <style>
    input[type="checkbox"]{
        zoom: 1.001;
      }
      .disabled:hover{
          cursor: not-allowed;
      }
    </style>
</head>
<body>
    <?php
    session_start();
    require("config.php");
    require("frontend_lib.php");
    require("class_lib.php");
    $obj = new head();
    $obj->displayheader();
    $obj->dispmenu(3, ["/ems/includes/super_home.php", "/ems/includes/index.php", "/ems/includes/developers.php"], ["glyphicon glyphicon-home", "glyphicon glyphicon-log-out", "glyphicon glyphicon-info-sign"], ["Home", "Log Out", "About Us"]);
    $dashboard = new dashboard();
    $dashboard->display_super_dashboard($_SESSION['super_admin_name'], ["Change Password", "Sign Out"], ["change_password.php", "index.php"], "");
    $input = new input_field();

    ?>
    <form action="" method="post">
    <div class="feed-container">
    <table class="table table-striped table-responsive table-bordered">
   <caption>Course: <?= $_SESSION['course_inserted'] ?></caption>
    <thead>
     <tr>
       <th>Subject Code</th>
       <th>Subject Name</th>
       <th>Semester</th>
       <th>Subject Type</th>
       <th>Theory Credits</th>
       <th>Practical Credits</th>
       <th>Total Credits</th>
       <th>Internal Examination</th>
     </tr>
   </thead>
   <tbody>
     <tr>
       <td><?php
            $input->display_table("subcode", "form-control", "text", "subcode", "", 1, 0, 0, 0, 0);
            ?></td>
       <td><?php
            $input->display_table("subname", "form-control", "text", "subname", "", 1, 0, 0, 0, 0);
            ?></td>
       <td>
           <select name="semester" id="" class="form-control">
                <?php
                for ($i = 1; $i <= $_SESSION['semester']; $i++) {
                    echo ('<option value="' . $i . '">' . $i . '</option>"');
                }
                ?>
                
           </select>
       </td>
       <td>
       <select name="type" id="" class="form-control">
                
       <option value="theory">Theory</option>
          <option value="practical">Practical</option>
       <option value="both">Both</option>         
           </select>
       </td>
       
       <td><?php
            $input->display_table("theory", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
        <td><?php
            $input->display_table("practical", "form-control", "number", "enrol", "", 1, 0, 60, 0, 60)
            ?></td>
       <td><label for="" id="total" class="form-control disabled"></label></td>
       <td style="text-align: center"><?php
                                        $input->display_table("ie", "form-control", "checkbox", "enrol", "", 1, 0, 0, 0, 0)
                                        ?></td>
     </tbody>
  </table>
    </div>
</form>
<?php
$obj = new footer();
$obj->disp_footer();
?>
</body>
</html>