/**
 * File admin-scripts.js.
 *
 * The code for your theme admin JavaScript
 * source should reside in this file.
 */

( function( $ ) {
	'use strict';
	/**
	 * Show flash message
	 * @param  string message
	 */
	function show_flash_message( message ) {
		var alert = '<div class="gmb-flash-msg col-sm-3 col-sm-offset-9"><div class="alert alert-success text-center"><strong>'+message+'</strong></div>';
		$('.gmb-flash-msg').remove();
		$('.bootstrap-iso').append( alert );
		$('.gmb-flash-msg').fadeIn();
		setTimeout( function() {
			$('.gmb-flash-msg').fadeOut();
		}, 1000);
	}

	// Check if DOM is ready.
	$(function() {
		/* Shortcode Generator */
		$('#scwd-generator-form')
		.on('change', '[name="variable"]', function (e) {
			e.preventDefault();

			var val = $(this).val();

			$('#variable-value').val( val );
		})
		.on('change', '[name="wrapper"]', function (e) {
			e.preventDefault();
			var wclass = $('#wrapper-class').parent();

			if ( $(this).val() )  {
				wclass.show();
			} else {
				wclass.hide();
			}
		})
		.on('change', '[name="type"]', function (e) {
			e.preventDefault();
			var val = $(this).val();

			$('.additional-fields').hide();

			if ( val === 'image' )  $('#img-fields').show();
			else if ( val === 'link' )  $('#link-fields').show();
		})
		.on('click', '.submit-btn',function(e) {
			e.preventDefault();
			var variable	= $('[name="variable"] option:selected').val() ? $('[name="variable"] option:selected').text() : '',
				wrapper 	= $('[name="wrapper"]').val() ? 'wrapper="'+$('[name="wrapper"]').val()+'"' : '',
				wclass 		= ( $('[name="wrapper_class"]').val() && wrapper ) ? 'wclass="'+$('[name="wrapper_class"]').val()+'"' : '',
				type 		= $('[name="type"]').val() ? $('[name="type"]').val() : '',
				atts 		= 'var="' + variable + '" type="' + type + '" ' + wrapper + ' ' + wclass + ' ';

			if ( type === 'link' ) {
				var text_link 		= $('[name="text_link"]').val() ? $('[name="text_link"]').val() : '',
					target 			= $('[name="target"]').val() ? 'target="'+$('[name="target"]').val()+'"' : '',
					link_type 		= $('[name="link_type"]').val() ? 'link_type="'+$('[name="link_type"]').val()+'"' : '',
					link_class 		= $('[name="link_class"]').val() ? 'class="'+$('[name="link_class"]').val()+'"' : '',
					icon 			= $('[name="icon"]').val() ? 'icon="'+$('[name="icon"]').val()+'"' : '',
					icon_position 	= ( $('[name="icon_position"]').val() && icon ) ? 'icon_position="'+$('[name="icon_position"]').val()+'"' : '';

				atts += 'text="' + text_link + '" ' + target + ' ' + link_type + ' ' + link_class + ' ' + icon + ' ' +icon_position;
			} else if ( type === 'image' ) {
				var alttext 	= $('[name="alttext"]').val() ? $('[name="alttext"]').val() : '',
					img_class 	= $('[name="img_class"]').val() ? 'class="'+$('[name="img_class"]').val()+'"' : '';

				atts += 'text="'+alttext+'" ' +  img_class;
			}

			var shortcode 	= '[scwd_option ' + $.trim( atts.replace(/  +/g, ' ') )  + ']',
				tpl_code	= '';

			tpl_code += '&lt;?php if ( checkoption( \'' + variable + '\' ) ): \n';
			tpl_code += '	echo do_shortcode(\'' + shortcode + '\');\n';
			tpl_code += 'endif; ?&gt';

			$('#shortcode-result').show();
			$('#generated-shortcode').val( shortcode );
			$('#tpl-code').html( tpl_code );
		})
		.on('click', '#generated-shortcode, #tpl-code', function (e) {
			e.preventDefault();
			$(this).select();
			document.execCommand("copy");
			show_flash_message("Copied to clipboard");
		});
	});

} )( jQuery );