$(function(){
	$(window).scroll(function() {
	    var scrollPos = $(this).scrollTop() / 45;
	    $(".hero-back").css({
	       'background-size' : 100 + scrollPos + '%'      
	     });
	});
});