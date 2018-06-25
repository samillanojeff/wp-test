/**
 * File image-upload.js.
 *
 * The code for your theme JavaScript source should reside in this file.
 */

( function( $ ) {
	'use strict';

	// Check if DOM is ready.
	$(function() {

		var targetField;
		var targetImg;

		$('.upload_img_button').click(function() {
		  targetField = $(this).prev('.regular-text');
		  targetImg = $(this).next('.placeholderImage');
			tb_show('Upload an Image', 'media-upload.php?referer=theme_options&type=image&TB_iframe=true&post_id=0', false);
			return false;
		});
		window.send_to_editor = function(html) {
		var image_url = $('<div>' + html + '</div>').find('img').attr('src');
			targetField.val(image_url);
			if(image_url != ""){
				targetImg.empty();
				targetImg.append('<img src="' + image_url + '" alt="" style="max-width: 800px; height: auto;" />');
			}
			tb_remove();
		}

	});

} )( jQuery );