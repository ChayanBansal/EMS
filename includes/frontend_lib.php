<?php
$docroot=$_SERVER['DOCUMENT_ROOT']."/ems/";
?>
<link rel="stylesheet" href="/ems/bootstrap/css/bootstrap.css">
<script src="/ems/js/jquery.js"></script>
<script src="/ems/bootstrap/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="/ems/css/front_styles.css">
<link href="https://fonts.googleapis.com/css?family=Cabin|Exo+2|Kanit|Muli|Open+Sans|Raleway|Roboto|PT+Sans" rel="stylesheet">
<link rel="stylesheet" href="/ems/font-awesome/css/font-awesome.css">
<?php
class head{
    var $title="Symbiosis University of Applied Sciences";
    var $logo="/ems/images/logo2.jpg";
    var $rtitle="Examination Portal";
    function displayheader(){
        echo(' <div class="container">
        <div class="logo"><img src="'.$this->logo.'" alt="Suas Indore"></div>
        <div class="title">'.$this->title.'</div>
        <div class="text">'.$this->rtitle.'</div>
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
class footer{
    function disp_footer(){
    echo('<div class="footer">
                <div class="uni_name">
                    <a href="http://www.suas.ac.in">Symbiosis University of Applied Sciences</a>
                </div>
                <div class="copyright">
                    © '.date("Y").'
                </div>
                <div class="developers">
                    <a href="#">Developers</a>
                </div>
            </div>');
}
}
?>
