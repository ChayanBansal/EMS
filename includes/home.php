<!DOCTYPE html>
<html lang="en">
<head>
    <link rel='shortcut icon' href='images/favicon.ico' type='image/x-icon'>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="/ems/css/style.css">
   
    <style>
    .c_ug_pg{
        margin-bottom: 100px;
    }
    .option{
        padding: 20px;
        padding-right: 40px;
        padding-left: 40px;
        margin: 20px;
        display: flex;
        flex-wrap: wrap;
        color: white;
        font-size: 2rem;
        flex-direction: column;
        align-items: center;
        font-family: 'PT Sans', sans-serif;
        width: 100%;
        background: #0041AE;
    }
    </style>
    
</head>
<body>
<?php
    session_start();
    require("config.php");
    require("frontend_lib.php");
    require("class_lib.php");
    require('../preloader/preload.php');
    
    if(isset($_SESSION['main_exam_registration']))
    {
        if($_SESSION['main_exam_registration']==1)
        {
            $roll_list_added_alert = new alert();
            $roll_list_added_alert->exec("Roll List Added","success");
        }
        else if($_SESSION['main_exam_registration']==0)
        {
            $roll_list_not_added_alert = new alert();
            $roll_list_not_added_alert->exec("Not able to add the roll list","danger");
        }
        unset($_SESSION['main_exam_registration']);
    }

    if(isset($_SESSION['academic_semester_registration']))
    {
        if($_SESSION['academic_semester_registration']==1)
        {
            $roll_list_added_alert = new alert();
            $roll_list_added_alert->exec("Students registeration for the Academic Semester successful","success");
        }
        else if($_SESSION['academic_semester_registration']==0)
        {
            $roll_list_not_added_alert = new alert();
            $roll_list_not_added_alert->exec("Students registeration for the Academic Semester unsuccessful","danger");
        }
        unset($_SESSION['academic_semester_registration']);
    }

    $validate=new validate();
    $validate->conf_logged_in();
    $obj=new head();
    $obj->displayheader();
    $obj->dispmenu(3,["/ems/includes/home","/ems/includes/logout","/ems/includes/developers"],["glyphicon glyphicon-home","glyphicon glyphicon-log-out","glyphicon glyphicon-info-sign"],["Home","Log Out","About Us"]);
    unset($_SESSION['current_course_id']);
    $dashboard=new dashboard();
    $dashboard->display($_SESSION['operator_name'],["Sign Out"],["index"],"Contact Super Admin");
    $ai=new course();
    $ai->display($conn);
    
    ?>

    <?php
        $obj=new footer();
        $obj->disp_footer();
        $logout_modal=new modals();
    $logout_modal->display_logout_modal();
    ?>
          <script>
     function roll_get_batch(course)
  {
      var type=document.getElementById("register_for_type").value;
    $.ajax({
        type: "POST",
        url: "roll_list_ajax",
        data: 'operation=1&course_id='+course+'&type='+type,
        success: function(data)
                {
                    $(document.getElementById('roll_batch_list')).html(data);  
                },
        error: function(e){
            $(document.getElementById('roll_batch_list')).html("Unable to load batches");
        }
        
    });
  }

  function roll_get_semester(batch)
  {
    var type=document.getElementById("register_for_type").value;
    var course = document.getElementById('roll_course_list').value;
    $.ajax({
        type: "POST",
        url: "roll_list_ajax",
        data: 'operation=2&batch='+batch+'&course='+course+'&type='+type,
        success: function(data)
                {
                    $(document.getElementById('roll_semester_list')).html(data);  
                },
        error: function(e){
            $(document.getElementById('roll_semester_list')).html("Unable to load semester");
        }
        
    });
  }
    </script>
</body>
</html>