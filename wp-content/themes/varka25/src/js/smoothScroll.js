jQuery(document).ready(function($) {
/*
  Медленный скролл до якорей
*/

	if(window.location.hash) {
		var target = $(window.location.hash);
		target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		if(target.length) {
		    event.preventDefault();
		    //var delta = $(window).width() < 768 ? 100 : 250;
		    var delta = 150;
		    var top = target.offset().top - delta;
		    $('html, body').animate({
		      scrollTop: top
		    }, 1000);
		}
	}

	$('a[href*="#"]')
		// Remove links that don't actually link to anything
		.not('[href="#"]')
		.not('[href="#0"]')
		.click(function(event) {
		// On-page links
		if (
		  location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
		  && 
		  location.hostname == this.hostname
		) {
		  // Figure out element to scroll to
		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
		  // Does a scroll target exist?
		  if (target.length) {
		    // Only prevent default if animation is actually gonna happen
		    event.preventDefault();
		    //var delta = $(window).width() < 768 ? 100 : 250;
		    var delta = 150;
		    var top = target.offset().top - delta;
		    $('html, body').animate({
		      scrollTop: top
		    }, 1000);
		  }
		}
	});

});