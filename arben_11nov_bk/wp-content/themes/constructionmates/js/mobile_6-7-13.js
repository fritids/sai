jQuery.noConflict();


/* Mobile */
$('.navbar').prepend('<div id="menu-trigger" class="menu-trigger"></div>');		
$(".menu-trigger").on("click", function(){ alert('aaaaaaaaaaaaa');
	$("#menu-primary").slideToggle();
});

// iPad
var isiPad = navigator.userAgent.match(/iPad/i) != null;
if (isiPad) $('#menu-primary ul').addClass('no-transition');