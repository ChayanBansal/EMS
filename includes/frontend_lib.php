<link rel="stylesheet" href="/ems/bootstrap/css/bootstrap.css">
<script src="/ems/js/jquery.js"></script>
<script src="/ems/bootstrap/js/bootstrap.min.js"></script>
<script src="/ems/js/global_script.js"></script>
<link rel="stylesheet" href="/ems/css/front_styles.css">
<link href="https://fonts.googleapis.com/css?family=Cabin|Exo+2|Kanit|Muli|Open+Sans|Raleway|Roboto|PT+Sans" rel="stylesheet">
<link rel="stylesheet" href="/ems/font-awesome/css/font-awesome.css">
<?php
class head
{
    var $title = "Symbiosis University of Applied Sciences";
    var $logo = "/ems/images/logo2.jpg";
    var $rtitle = "Examination Portal";
    function displayheader()
    {
        echo (' <div class="container">
        <div class="logo"><img src="' . $this->logo . '" alt="Suas Indore"></div>
        <div class="title">' . $this->title . '</div>
        <div class="text">' . $this->rtitle . '</div>
        </div>');
    }
    function dispmenu($n, $href, $class, $tooltip)
    {
        echo ('<div class="menu-contain">
        <div class="menu">
        ');
        $i = 0;
        foreach ($class as $bclass) {
            echo (' <div class="item"><a href="' . $href[$i] . '"><i class="' . $bclass . '"></i><span style="font-size: 14px" id="menu_span">' . $tooltip[$i] . '</span></a></div>');
            $i++;
        }
        echo ('    
        </div>
    </div>');
    }
}
class footer
{
    function disp_footer()
    {
        echo ('<div class="footer">
                <div class="uni_name">
                    <a href="http://www.suas.ac.in">Symbiosis University of Applied Sciences</a>
                </div>
                <div class="copyright">
                    © ' . date("Y") . '
                </div>
                <div class="developers">
                    <a href="#">Developers</a>
                </div>
            </div>');
    }
}
class modals{
    function display_logout_modal(){
        echo('   
        <!-- Modal -->
        <div class="modal fade" id="logoutModal" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Inactivity Detected!</h4>
              </div>
              <div class="modal-body" style="text-align: center; font-size: 2rem">
                  <p>Do you wish to continue?</p>
                <p style=" text-align:center"><b>Automatic logout in: <span id="logout_timer" style="color:red">00:60</span> </b></p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" onclick="location.href=`/ems/includes/logout.php`" data-dismiss="modal">LogOut Now <i class="glyphicon glyphicon-new-window"></i></button>
                <button type="button" class="btn btn-success" onclick="startTimer(); show_conf_dialog(`stop`);" data-dismiss="modal">Keep Me Logged In <i class="glyphicon glyphicon-arrow-right"></i></button>
              </div>
            </div>');
    }
}
?>
