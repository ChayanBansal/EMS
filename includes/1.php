<script>
    function logout(){
        var xmlhttp=new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        };
        xmlhttp.open("GET", "logout.php", true);
        xmlhttp.send();
    }
    
</script>
<body unload="logout()">
    
</body>