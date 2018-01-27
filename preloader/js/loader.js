window.addEventListener('load',function(){
    var loader=document.getElementById("preloader");
    loader.style.animation="fadeoutpreload 1300ms ease-in-out";
    window.setTimeout(function(){
        loader.style.display="none";
    },1200);
    loader.style.animationFillMode="forwards";
});