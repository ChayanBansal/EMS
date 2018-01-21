   function disable_on_submitbtn() {
       var btn = document.querySelector('button[type="submit"]');
       btn.classList.add("disabled");
       btn.style.pointerEvents = "none";
       return true;
   }

   function disable_on_submitinput() {
       var btn = document.querySelector('input[type="submit"]');
       btn.classList.add("disabled");
       var uname = document.getElementById("username").value;
       var i = 0;
       var x = true;
       for (i = 0; i < uname.length; i++) {
           if (uname.charAt(i) == '*' || uname.charAt(i) == '$' || uname.charAt(i) == '&' || uname.charAt(i) == '#') {
               x = false;
           }
       }
       if (x == false) {
           document.getElementById("err").innerHTML = '<div class="alert alert-danger fade in" id="err" style="z-index:200; width: 100%">Special Characters like *,&,$,# not allowed in Username<span class="close" data-dismiss="alert" style="font-size:2.6rem">&times</span></div>';
           return x;
       } else {
           return x;
       }

   }
   /*  function show_conf_dialog(stop){
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
     }*/