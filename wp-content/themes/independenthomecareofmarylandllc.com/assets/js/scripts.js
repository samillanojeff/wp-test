/**
 * File scripts.js.
 *
 * The code for your theme JavaScript source should reside in this file.
 */

( function( $ ) {
	'use strict';

	// On page load smooth scroll to content if not front page
	function scroll_to_content() {
		if ( !$('body').hasClass('home') ) {
			$('html, body').animate({
				'scrollTop' : $('.site-content').offset().top
			}, 900, 'swing');
		}
	}

	// Check if DOM is ready.
	$(function() {
		scroll_to_content();
		// Smooth Scrolling in same page ( Note: conflict with bootstrap modal )
		/*$('a[href*="#"]:not([href="#"])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');

				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});*/

		/*$('.main-navigation').on('click', 'a', function(e) {
			e.preventDefault();
			// var target = $(this).attr('href'), $target = $(target); {
			var target = $('#content'), $target = $(target); {
				$('html, body').stop().animate({
					'scrollTop' : $target.offset().top - 50
				}, 900, 'swing', function() {
					// window.location.hash = target;
				});
			}
		});*/
	});

} )( jQuery );