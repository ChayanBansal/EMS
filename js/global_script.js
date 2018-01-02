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
    function disable_on_submitbtn(){
        var btn=document.querySelector('button[type="submit"]');
        btn.classList.add("disabled");
        btn.style.pointerEvents="none";
        return true;
    }
    function disable_on_submitinput(){
        var btn=document.querySelector('input[type="submit"]');
        btn.classList.add("disabled");
        return true;
    }
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
        window.timeout=setTimeout(function(){
            stopTimer();
            show_conf_dialog();
            clearTimeout(timeout);
        },1800000);
    }