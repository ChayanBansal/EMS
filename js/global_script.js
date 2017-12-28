      $(window).on("unload", function () {
        $.ajax({
            type: "POST",
            cache: false,
            url: "logout.php",
            data: ({  }),
            success: function (result) {
            },
            error: function (data) { location.reload(); }
        });
    });
    function show_conf_dialog(stop){
        if(stop=="stop"){
            clearInterval(wintimer);
            document.getElementById("logout_timer").innerHTML="00:60";
        }else{
            var timer=60;
            window.wintimer=window.setInterval(function(){
                document.getElementById("logout_timer").innerHTML="00:"+timer;
                timer--;
                if(timer==0){
                    location.href="/ems/includes/logout.php";
                }
            },1000);
            $('#logoutModal').modal('show');
        }
    }
    function startTimer(){
        window.setTimeout(function(){
            show_conf_dialog("");
        },30000);
    }
