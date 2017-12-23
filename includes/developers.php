<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Developers</title>
    <style>
     .devp_contain{
        width: 100%;
        top: 50px;
        height: 100%;
    }
    .well{
        text-align: center;
        margin-bottom: 50px;
    }
    .name{
        padding: 10px;
        font-family: 'Roboto', sans-serif;
        font-size: 24px;
    }
    .email{
        font-family: 'Raleway', sans-serif;
        font-size: 18px;
    }
    .phone{
        font-family: 'Exo 2', sans-serif;
        font-size: 18px;
    }
    img{
        transition: all 300ms ease-in-out;
        cursor: pointer;
       
    }
    .quote{
        font-family: 'Alegreya', serif;
        font-size:50px;
        text-align:center;
        padding:20px;
        margin-bottom:150px;
    }
    @media (max-width:992px){
        img{
            filter: none;
        }
    }
    </style>
</head>
<body>
    <?php
    require($_SERVER['DOCUMENT_ROOT']."/ems/includes/frontend_lib.php");
    require($_SERVER['DOCUMENT_ROOT']."/ems/includes/class_lib.php");
    $head=new head();
    $head->displayheader();
    $head->dispmenu(1,["home.php"],["glyphicon glyphicon-home"],["Home"]);
     $foot=new footer();
    $foot->disp_footer();
    ?>
    <div class="devp_contain col-md-12">
        <div class="well well-lg col-md-4">
            <a href="images/chayan_bansal.jpg"><img src="/ems/images/chayan_bansal.jpg" alt="" height="300" class="img-rounded"></a> 
            <div class="name">Chayan Bansal</div>
            <div class="email"><i class="glyphicon glyphicon-envelope"></i> <a href="mailto:bansalc10@gmail.com"> bansalc10@gmail.com </a></div>
            <div class="phone"><i class="glyphicon glyphicon-earphone"></i>+91-9644959600 </div>
        </div>
        <div class="well well-lg col-md-4">
            <a href="images/raghav_mundhra.jpg"><img src="/ems/images/raghav_mundhra.jpg" alt="" height="300" class="img-rounded"> </a> 
            <div class="name">Raghav Mundhra</div>
            <div class="email"><i class="glyphicon glyphicon-envelope"></i> <a href="mailto:raghav.mundhra3011@gmail.com">raghav.mundhra3011@gmail.com</a></div>
            <div class="phone"><i class="glyphicon glyphicon-earphone"></i>+91-9981625830</div>
        </div>
        <div class="well well-lg col-md-4">
            <a href="images/samyak_jain.jpg"><img src="/ems/images/samyak_jain.jpg" alt="" height="300" class="img-rounded"></a> 
            <div class="name">Samyak Jain</div>
            <div class="email"><i class="glyphicon glyphicon-envelope"></i> <a href="mailto:jainsamyak330@gmail.com">jainsamyak330@gmail.com</a></div>
            <div class="phone"><i class="glyphicon glyphicon-earphone"></i>+91-8085479525</div>
        </div>
        <div class="quote col-sm-12">
        <q>Be as simple as you can be....You'll be astonished to see how uncomplicated and happy your life can become.</q>
        </div>
    </div>
</body>
</html>