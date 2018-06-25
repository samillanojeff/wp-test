<?php
/**
 * Custom theme options
  */

 /* INSTRUCTIONS:

      1. Perform search-and-replace for 'scwd' and change to your theme's scwd
      2. Customize tabs and fields as needed


 * HOW TO USE SHORTCODE:

    [displayoption var="variable" type="text(default)/link/image" text="LINKTEXT OR IMAGE ALT TEXT" target="LINKTARGET" class="ELEMENTCLASS" wrapper="p/div/li/span/strong" wclass="WRAPPERCLASS (DO NOT INCLUDE IF NOT NEEDED)"]

    TEXT:

	[displayoption var="variable" wrapper="p/div/li/span/strong (DO NOT INCLUDE IF NOT NEEDED)" wclass="WRAPPERCLASS (DO NOT INCLUDE IF NOT NEEDED)"]

    IMAGE:

	[displayoption var="variable" type="image" text="ALT TEXT" wrapper="p/div/li/span/strong (DO NOT INCLUDE IF NOT NEEDED)" wclass="WRAPPERCLASS (DO NOT INCLUDE IF NOT NEEDED)"]

    LINK:

	[displayoption var="variable" type="link" text="LINKTEXT" target="LINKTARGET (e.g. _BLANK)" wrapper="p/div/li/span/strong (DO NOT INCLUDE IF NOT NEEDED)" wclass="WRAPPERCLASS (DO NOT INCLUDE IF NOT NEEDED)"]

 * inside post/widgets(with PHP enabled):

      [displayoption var="ctocright" wclass="mixer" wrapper="p"]

 * inside templates:

      echo do_shortcode('[displayoption var="ctocright" wclass="mixer" wrapper="p"]');

 * output of the sample codes above:

      <p class="mixer">COPYRIGHT &copy; 2015. CLASSIC TOWING. ALL RIGHTS RESERVED.WEB DESIGN BY ESILVERCONNECT.COM</p>


 * HOW TO CHECK IF AN OPTION EXISTS BEFORE DISPLAYING CONTENT:

	checkoption( 'ctologourl' )

 * (ACTUAL CODE TO DISPLAY THE LOGO FROM THE THEME OPTIONS)

      <?php if ( checkoption( 'ctologourl' ) ): ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo do_shortcode('[displayoption var="ctologourl" type="image" text="' . get_bloginfo( 'name' ) . '" class="logo"]'); ?></a>
      <?php endif; ?>

**************************************************************/

add_action( 'admin_init', 'theme_options_init' );
add_action( 'admin_menu', 'theme_options_add_page' );


function theme_options_init(){
	register_setting( 'custom_options', 'custom_theme_options');
}


function theme_options_add_page() {
	add_theme_page( __( 'Theme Options', 'scwd' ), __( 'Theme Options', 'scwd' ), 'edit_theme_options', 'theme_options', 'theme_options_do_page' );
}


function theme_options_do_page() {
	global $select_options;
	if ( ! isset( $_REQUEST['settings-updated'] ) )
		$_REQUEST['settings-updated'] = false;
	?>
	<div class="wrap">
	<?php screen_icon(); echo "<h2>". __( 'Custom Theme Options', 'scwd' ) . "</h2>"; ?>
	<?php if ( false !== $_REQUEST['settings-updated'] ) : ?>
	<div><p><strong><?php _e( 'Options saved', 'scwd' ); ?></strong></p></div>
	<?php endif; ?>

	<form method="post" action="options.php">

	<?php settings_fields( 'custom_options' ); ?>
	<?php $options = get_option( 'custom_theme_options' ); ?>
	<style>
	#tabs ul.ui-widget-header { border-color: #CCC; background: #CCC none;
	 }
	#tabs div textarea { width: 25em; min-height: 200px;
		 }
	</style>
	 <div id="tabs">
		 <ul>
		 <li><a href="#tabs-1">General</a></li>
		 <li><a href="#tabs-2">Homepage</a></li>
		 <li><a href="#tabs-3">Social Media</a></li>
	 </ul>
	 <div id="tabs-1">
		<table class="form-table">
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Logo', 'scwd' ); ?>
			 </th>
			 <td>
				<input id="custom_theme_options[ctologourl]" type="text" name="custom_theme_options[ctologourl]" value="<?php esc_attr_e( $options['ctologourl'] ); ?>" class="regular-text" />
				<input id="upload_logo_button" type="button" class="button upload_img_button" value="<?php _e( 'Upload Logo', 'scwd' ); ?>" />
				<div class="placeholderImage" id="uplogo" style="padding: 10px 0 0 0;"><?php echo ((isset($options['ctologourl']) && $options['ctologourl'] != "") ? "<img src=\"" . $options['ctologourl'] . "\" alt=\"\" style=\"max-width: 800px; height: auto;\" />" : ""); ?></div>
			 </td>
		   </tr>
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Phone', 'scwd' ); ?>
			 </th>
			 <td>
				<input id="custom_theme_options[ctophone]" type="text" name="custom_theme_options[ctophone]" value="<?php esc_attr_e( $options['ctophone'] ); ?>" class="regular-text" />
			 </td>
		   </tr>
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Copyright', 'scwd' ); ?>
			 </th>
			 <td>
				<input id="custom_theme_options[ctocright]" type="text" name="custom_theme_options[ctocright]" value="<?php esc_attr_e( $options['ctocright'] ); ?>" class="regular-text" />
			 </td>
		   </tr>
		</table>
	 </div>
	 <div id="tabs-2">
		<table class="form-table">
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Banner', 'scwd' ); ?><br>
				<small>(Recommended: Square image at least 700 pixels by 700 pixels in size)</small>
			 </th>
			 <td>
				<input id="custom_theme_options[ctobannerurl]" type="text" name="custom_theme_options[ctobannerurl]" value="<?php esc_attr_e( $options['ctobannerurl'] ); ?>" class="regular-text" />
				<input id="upload_banner_button" type="button" class="button upload_img_button" value="<?php _e( 'Upload Image', 'scwd' ); ?>" />
				<div class="placeholderImage" id="upbanner" style="padding: 10px 0 0 0;"><?php echo ((isset($options['ctobannerurl']) && $options['ctobannerurl'] != "") ? "<img src=\"" . $options['ctobannerurl'] . "\" alt=\"\" style=\"max-width: 800px; height: auto;\" />" : ""); ?></div>
			 </td>
		   </tr>
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Banner Text', 'scwd' ); ?>
			 </th>
			 <td>
				<input id="custom_theme_options[ctobannertext]" type="text" name="custom_theme_options[ctobannertext]" value="<?php esc_attr_e( $options['ctobannertext'] ); ?>" class="regular-text" />
			 </td>
		   </tr>
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Banner Button Text', 'scwd' ); ?>
			 </th>
			 <td>
				<input id="custom_theme_options[ctobannerbtntext]" type="text" name="custom_theme_options[ctobannerbtntext]" value="<?php esc_attr_e( $options['ctobannerbtntext'] ); ?>" class="regular-text" />
			 </td>
		   </tr>
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Banner Link', 'scwd' ); ?>
			 </th>
			 <td>
				<input id="custom_theme_options[ctobannerlink]" type="text" name="custom_theme_options[ctobannerlink]" value="<?php esc_attr_e( $options['ctobannerlink'] ); ?>" class="regular-text" />
			 </td>
		   </tr>
		</table>
	 </div>
	 <div id="tabs-3">
		<table class="form-table">
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Facebook', 'scwd' ); ?>
			 </th>
			 <td>
				<input id="custom_theme_options[ctofburl]" type="text" name="custom_theme_options[ctofburl]" value="<?php esc_attr_e( $options['ctofburl'] ); ?>" class="regular-text" />
			 </td>
		   </tr>
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Twitter', 'scwd' ); ?>
			 </th>
			 <td>
				<input id="custom_theme_options[ctotwurl]" type="text" name="custom_theme_options[ctotwurl]" value="<?php esc_attr_e( $options['ctotwurl'] ); ?>" class="regular-text" />
			 </td>
		   </tr>
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Instagram', 'scwd' ); ?>
			 </th>
			 <td>
				<input id="custom_theme_options[ctoigurl]" type="text" name="custom_theme_options[ctoigurl]" value="<?php esc_attr_e( $options['ctoigurl'] ); ?>" class="regular-text" />
			 </td>
		   </tr>
		   <tr valign="top">
			 <th scope="row">
				<?php _e( 'Youtube', 'scwd' ); ?>
			 </th>
			 <td>
				<input id="custom_theme_options[ctoyturl]" type="text" name="custom_theme_options[ctoyturl]" value="<?php esc_attr_e( $options['ctoyturl'] ); ?>" class="regular-text" />
			 </td>
		   </tr>
		</table>
	 </div>
	</div>
	<p>
	<input type="submit" value="<?php _e( 'Save Options', 'scwd' ); ?>" class="button button-primary" />
	</p>
	</form>

	</div>
	<script type="text/javascript">
	jQuery(document).ready(function(){
	 jQuery("#tabs").tabs();    });
	</script>
	<?php
}

function custom_options_enqueue_scripts() {
	wp_register_script( 'scwd-image_upload', get_template_directory_uri() .'/assets/js/image-upload.js', array('jquery','media-upload','thickbox') );

	if ( 'appearance_page_theme_options' == get_current_screen() -> id ) {
		wp_enqueue_script('jquery');

		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');

		wp_enqueue_script('media-upload');
		wp_enqueue_script('scwd-image_upload');

		wp_enqueue_script ('jquery-ui-tabs');

		//Enqueue the jQuery UI theme css file from google:
		wp_enqueue_style('e2b-admin-ui-css','http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css',false,"1.9.0",false);
	}

}
add_action('admin_enqueue_scripts', 'custom_options_enqueue_scripts');

// Check if option exists
// function checkoption( $optname ){
// 	if(empty($optname) || $optname == '')
// 	 return false;
// 	$chkoptions = get_option( 'custom_theme_options' );
// 	if(isset($chkoptions[$optname]) && $chkoptions[$optname] != '')
// 	 return true;
// }

/* Displays the specific custom option with parameters
 *
 * var   	 Name of the custom option (e.g. ctologourl)
 * type    text/link/image (Default: text)
 * text    Link text/Image Alt text
 * target    Link target
 * class    CSS class for the output tag
 * wrapper    Wrapper for the output (Choices: p,div,li,span)
 * wclass    CSS class for the wrapper tag
 *
 */
function displayoption_func( $atts ){
	$atts = shortcode_atts( array(
		'var' => '',
		'type' => 'text',
		'text' => '',
		'target' => '',
		'class' => '',
		'wrapper' => '',
		'wclass' => ''
	), $atts, 'displayoption' );


	$theme_options = get_option( 'custom_theme_options' );
	$resultString = '';


	if($atts['var'] != ''){

		$resultString = ((isset($theme_options[$atts['var']]) && $theme_options[$atts['var']] != '') ? $theme_options[$atts['var']] : '');
		$tagClass = '';
		$tagTarget = '';
		$wrapperClass = '';


		// Build tag class string
		if($atts['class'] != '')
			$tagClass = ' class="' . $atts['class'] . '"';
		// Build target string
		if($atts['target'] != '')
			$tagTarget = ' target="' . $atts['target'] . '"';

		if( $atts['type'] == 'link' ){
			$resultString = '<a href="' . $resultString . '"' . $tagClass . $tagTarget . '>' . (($atts['text'] != '') ? $atts['text']  : $resultString) . '</a>';
		} elseif( $atts['type'] == 'image' ) {
			$resultString = '<img src="' . $resultString . '" alt="' . $atts['text'] . '"' . $tagClass . '>';
		}

	// Uncomment to convert newline to <br> in textarea output
	// $resultString = nl2br($resultString);

		// Build wrapper class string
		if($atts['wclass'] != '')
			$wrapperClass = ' class="' . $atts['wclass'] . '"';

		if( $atts['wrapper'] == 'p' ){
			$resultString = '<p' . $wrapperClass . '>' . $resultString . '</p>';
		} elseif( $atts['wrapper'] == 'div' ) {
			$resultString = '<div' . $wrapperClass . '>' . $resultString . '</div>';
		} elseif( $atts['wrapper'] == 'li' ) {
			$resultString = '<li' . $wrapperClass . '>' . $resultString . '</li>';
		} elseif( $atts['wrapper'] == 'span' ) {
			$resultString = '<span' . $wrapperClass . '>' . $resultString . '</span>';
		} elseif( $atts['wrapper'] == 'strong' ) {
			$resultString = '<strong' . $wrapperClass . '>' . $resultString . '</strong>';
		}
	}

	// Return output
	return $resultString;
}
add_shortcode( 'displayoption', 'displayoption_func' );

/**
 * Add the theme options link to the Admin Bar
 *
*/
function wp_add_theme_options_link() {
	global $wp_admin_bar, $wpdb;

	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;

	/* Add the main siteadmin menu item */
	$wp_admin_bar->add_menu( array( 'id' => 'theme_opts', 'title' => __( 'Theme Options', 'revmeals' ), 'href' => admin_url('themes.php?page=theme_options') ) );
}
add_action( 'admin_bar_menu', 'wp_add_theme_options_link', 1000 );