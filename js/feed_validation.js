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