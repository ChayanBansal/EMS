<?php
session_start();
$_SESSION['superflag']=FALSE;
?>
<?php

if(isset($_POST['username'])){
    if(md5($_POST['username'])=="088c6475bae0675d3de5721bf4a11993"){
        $_SESSION['superflag']=TRUE;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Examination Portal</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    require("frontend_lib.php");
    require("class_lib.php");
    $obj=new head();
    $obj->displayheader();
    $obj->dispmenu(4,["","",""],["glyphicon glyphicon-home","glyphicon glyphicon-log-in","glyphicon glyphicon-info-sign"],["Home","Log In","About Us"]);
    $formobj=new form();
    $formobj->display("","","","","","","","");
    ?>

    <?php
        $obj=new footer();
        $obj->disp_footer();
        ?>

</body>
<script>
        function change(){
            var d=document.getElementById("f1");
            d.style.borderBottomColor="darkblue";
           
        
        }
        function change2(){
            var d=document.getElementById("f1");
            d.style.borderBottomColor="#C9D7E3";
        }
        function change4(){
            var d=document.getElementById("f2");
            d.style.borderBottomColor="#C9D7E3";
        }
        function change3(){
            var d=document.getElementById("f2");
            d.style.borderBottomColor="darkblue";
        }
        </script>
</html>
<?php
//Backend scripting
$op_login=new form_receive();
$op_login->login();
?>