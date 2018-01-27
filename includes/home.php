<!DOCTYPE html>
<html lang="en">
<head>
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
    $validate=new validate();
    $validate->conf_logged_in();
    $obj=new head();
    $obj->displayheader();
    $obj->dispmenu(3,["/ems/includes/home","/ems/includes/logout","/ems/includes/developers"],["glyphicon glyphicon-home","glyphicon glyphicon-log-out","glyphicon glyphicon-info-sign"],["Home","Log Out","About Us"]);
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
    $.ajax({
        type: "POST",
        url: "roll_list_ajax",
        data: 'operation=1&course_id='+course,
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
    var course = document.getElementById('roll_course_list').value;
    $.ajax({
        type: "POST",
        url: "roll_list_ajax",
        data: 'operation=2&batch='+batch+'&course='+course,
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