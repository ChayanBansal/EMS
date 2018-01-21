function validate(ele, max) {
    if (ele.value > max) {
        document.getElementById("err").innerHTML = '<div class="alert alert-danger fade in" id="err" style="z-index:200; width: 100%">Invalid Value! Please check again..<span class="close" data-dismiss="alert" style="font-size:2.6rem">&times</span></div>';
    }
    if (ele.value < 0) {
        document.getElementById("err").innerHTML = '<div class="alert alert-danger fade in" id="err" style="z-index:200; width: 100%">Invalid Value! Please check again..<span class="close" data-dismiss="alert" style="font-size:2.6rem">&times</span></div>';
    }
    else if (ele.value >= 0 && ele.value <= max) {
        document.getElementById("err").innerHTML = "";
    }
}
function validate_focus(ele, max) {
    if (ele.value > max) {
        ele.focus();
    }
    if (ele.value < 0) {
        ele.focus();
    }
}
function check_max(el,no){
    var pass=parseInt(document.getElementById("pass"+no).value);
    if(pass>=parseInt(el.value)){
        document.getElementById("err").innerHTML = '<div class="alert alert-info fade in" id="err" style="z-index:200; width: 100%">Passing marks cannot be greater than or equal to maximum marks<span class="close" data-dismiss="alert" style="font-size:2.6rem">&times</span></div>';
    }else{
        document.getElementById("err").innerHTML = "";
    }
}