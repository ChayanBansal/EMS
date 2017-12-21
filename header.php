<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="menu_styles.css">
<?php
class head{
    var $title="Symbiosis University of Applied Sciences";
    var $logo="SUASLogo.png";
    var $rtitle="EMS";
    function displayheader(){
        echo(' <div class="container">
        <div class="logo" style="width: 50%; text-align: center"><img src="'.$this->logo.'" alt="Suas Indore"></div>
        
        <div class="text" style="width: 50%; text-align: center">'.$this->rtitle.'</div>
        </div>');
    }
    function dispmenu($n,$href,$class,$tooltip){
        echo('<div class="menu-contain">
        <div class="menu">
        ');
        $i=0;
        foreach($class as $bclass){
            echo(' <div class="item"><a href="'.$href[$i].'"><i class="'.$bclass.'"></i><span style="font-size: 14px" id="menu_span">'.$tooltip[$i].'</span></a></div>');
            $i++;
        } 
        echo('    
        </div>
    </div>');
    }
}
$obj=new head();
$obj->displayheader();
$obj->dispmenu(4,["","",""],["glyphicon glyphicon-home","glyphicon glyphicon-user","glyphicon glyphicon-info-sign"],["Home","Log In","About Us"]);
?>
