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
            document.getElementById("logout_timer").innerHTML="00:60";
            var timer=60;
            window.wintimer=window.setInterval(function(){
                document.getElementById("logout_timer").innerHTML="00:"+timer;
                timer--;
                if(timer==0){
                    location.href="/ems/includes/logout.php";
                }
                console.log(timer);
            },1000);
            $('#logoutModal').modal({backdrop: 'static', keyboard: false})  
            $('#logoutModal').modal('show');
    }
    function stopTimer(){
        clearInterval(wintimer);
    }
    function startTimer(){
        window.setTimeout(function(){
            show_conf_dialog();
        },300000);
    }