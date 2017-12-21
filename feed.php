
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feed Marks</title>
    <link rel="stylesheet" href="style.css"> 
    <script>
        function showres() {
            var selectElement = document.getElementById("erno");
            selectElement.onclick = function() {
                var erno = selectElement.options[selectElement.selectedIndex].value;
                document.getElementById("enrol").value = erno;
            }
        }
    function validate(ele,max){
        if(ele.value>max){
            document.getElementById("err").innerHTML='<div class="alert alert-danger fade in" id="err">Invalid Value! Please check again..<span class="close" data-dismiss="alert" style="font-size:2.6rem">&times</span></div>';
        }
        if(ele.value<0){
            alert("Invalid entry!");            
        }
        else if(ele.value>=0 && ele.value<=max){
            document.getElementById("err").innerHTML="";
        }
    }
    function validate_focus(ele,max){
        if(ele.value>max){
            ele.focus();
        }
        if(ele.value<0){
            ele.focus();            
        }
    }
    </script>
     <style>
        body {
            margin: 0;
            font-family: 'Open Sans', sans-serif;
        }
        
        table {
            width: 75%;
            height: 100%;
        }
        
        td {
            text-align: center;
            padding: 15px;
            font-size: 20px;
            font-family: 'Open Sans', sans-serif;
        }
        
        th{
            background: #2A458E;
            color: white;
            height: 100%;
            padding: 15px !important;
            text-align: center !important;
            font-size: 20px;
            font-weight: 600;
            font-family: 'Raleway', sans-serif;
        }
        table,
        th,
        tr,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        table{
            margin: 20px;
        }
        tr:nth-child(odd) {
            background-color: #E1E9FF;
        }
        
        .feed-container{
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .details{
            display:flex;
            width: 100%;
            margin: 20px;
            justify-content: space-around;
            font-size: 20px;
            font-family: 'Roboto', sans-serif;
        }
        .stinfo{
            border: 1px solid black;
            padding: 10px;
        }
        .overlayfed{
            position: absolute;
            padding: 30px;
            z-index: 10;
        background: rgba(0,0,0,0.8);
        display: flex;
        color: white;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        }
    .ok{
        font-size: 80px;
        color: #1E8213;
    }
    .okinfo{
        font-size: 24px;
        text-align: center;
    }
    </style>
</head>
<body>
    <?php
    session_start();
    require("config.php");
    require("frontend_lib.php");
    require("class_lib.php");
    $authorize=new validate();
    $authorize->conf_logged_in();
    $obj=new head();
    $obj->displayheader();
    $obj->dispmenu(4,["home.php","index.php","useroptions.php","developers.php"],["glyphicon glyphicon-home","glyphicon glyphicon-log-out",'glyphicon glyphicon-th',"glyphicon glyphicon-info-sign"],["Home","Log Out","Options","About Us"]);
    $dashboard=new dashboard();
    $dashboard->display($_SESSION['operator_name'],["Change Password","Sign Out"],["change_password.php","index.php"],"Contact Super Admin");
   ?>
   <div id="err"></div>
   <?php
   $search_from=new search();
   $search_from->search_roll_2($conn);
    $initialise=new initial();
    $initialise->initialise($conn);
    $click=new click();
    $click->next_prev_submit();
    $search_txt=new search();
    $search_txt->search_roll($conn);
    $data_table=new data_table();
    $data_table->get_details($conn);
    $search=new show_enroll();
    $search->set_enrol_session($conn);
    $data_table->feed($conn);
    $search->display();
    $data_table->print_table(); 
   ?>
   
    <?php

        $obj=new footer();
        $obj->disp_footer();
    ?>
</body>
</html>