//----Include-Function----
function include(url){ 
  document.write('<script src="js/'+ url + '"></script>'); 
  return false ;
}

jQuery(function(){
      jQuery('.sf-menu').mobileMenu();
    })
$(function(){
// IPad/IPhone
  var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
    ua = navigator.userAgent,
 
    gestureStart = function () {
        viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0";
    },
 
    scaleFix = function () {
      if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
        viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
        document.addEventListener("gesturestart", gestureStart, false);
      }
    };
scaleFix();

// Menu Android
if(window.orientation!=undefined){
 var regM = /ipod|ipad|iphone/gi,
  result = ua.match(regM)
 if(!result) {
  $('.sf-menu li').each(function(){

   if($(">ul", this)[0]){
    $(">a", this).toggle(
     function(){
      return false;
     },
     function(){
      window.location.href = $(this).attr("href");
     }
    );
   } 
  })
 }
}
});

/* DEVICE.JS AND SMOOTH SCROLLIG
========================================================*/
  include('device.min.js');
  include('jquery.mousewheel.min.js');
  include('jquery.simplr.smoothscroll.min.js');
  $(function () { 
    if ($('html').hasClass('desktop')) {
        $.srSmoothscroll({
          step:150,
          speed:800
        });
    }   
  });

/*========================================================*/



/* Stellar.js
========================================================*/
include('jquery.stellar.js');
$(window).load(function() { 
  if ($('html').hasClass('desktop')) {
      $.stellar({
        horizontalScrolling: false,
        verticalOffset: 20
      });
  }  
});
/*========================================================*/


$(document).ready(function() {
    $('.box3 .discript .btn').hover(
        function() {
            $(this).addClass('swing animated');
        },
        function() {
            $(this).removeClass('swing animated');
        }
    )})


/* ------ fi fixed position on Android -----*/
var ua=navigator.userAgent.toLocaleLowerCase(),
 regV = /ipod|ipad|iphone/gi,
 result = ua.match(regV),
 userScale="";
if(!result){
 userScale=",user-scalable=0"
}
document.write('<meta name="viewport" content="width=device-width,initial-scale=1.0'+userScale+'">')
/*--------------*/

/* Back to top */
$(window).load(function(){
  $().UItoTop({ easingType: 'easeOutQuart' });
})

/* Copyright */
  var currentYear = (new Date).getFullYear();
    $(document).ready(function() {
    $("#copyright-year").text( (new Date).getFullYear() );
    });