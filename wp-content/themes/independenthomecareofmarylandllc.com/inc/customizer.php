<?php
/**
 * WP Default Theme Customizer
 *
 * @package WP_Default
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function scwd_customize_register( $wp_customize ) {
/*	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';*/

	/**
	 * Extends controls class to add textarea with description
	 */
	class scwd_Customize_Textarea_Control extends WP_Customize_Control {
		public $type = 'textarea';
		public $description = '';
		public function render_content() { ?>

		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<div class="control-description"><?php echo esc_html( $this->description ); ?></div>
			<textarea rows="5" style="width:98%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
		</label>

		<?php }
	}

	/** ===============
	 * Extends controls class to add descriptions to text input controls
	 */
	class scwd_Customize_Text_Control extends WP_Customize_Control {
		public $type = 'customtext';
		public $description = '';
		public function render_content() { ?>

		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<div class="control-description"><?php echo esc_html( $this->description ); ?></div>
			<input type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
		</label>

		<?php }
	}

	/**
	 * Site Title (Logo) & Tagline
	 */
	$wp_customize->get_section( 'title_tagline' )->title = __( 'Site Identity', 'scwd' );
	$wp_customize->get_section( 'title_tagline' )->priority = 10;

	/*// logo uploader
	$wp_customize->add_setting( 'logo', array( 'default' => null ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo', array(
		'label'		=> __( 'Custom Site Logo (replaces title)', 'scwd' ),
		'section'	=> 'title_tagline',
		'settings'	=> 'logo',
		'priority'	=> 10
	) ) );*/

	// site title
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_control( 'blogname' )->priority = 20;

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
		'selector'			=> '.site-title a',
		'render_callback'	=> 'scwd_customize_partial_blogname',
	) );

	// site tagline
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_control( 'blogdescription' )->priority = 30;

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
		'selector'			=> '.site-description',
		'render_callback'	=> 'scwd_customize_partial_blogdescription',
	) );

	// hide the tagline?
	$wp_customize->add_setting( 'display_title_tagline', array(
		'default'			=> 1,
		'sanitize_callback'	=> 'scwd_sanitize_checkbox'
	) );
	$wp_customize->add_control( 'display_title_tagline', array(
		'label'		=> __( 'Display Site Title and Tagline', 'scwd' ),
		'section'	=> 'title_tagline',
		'priority'	=> 40,
		'type'		=> 'checkbox',
	) );

	/**
	 * Theme Options
	 */
	$wp_customize->add_panel( 'theme_options', array(
		'priority'		=> 20,
		'capability'	=> 'edit_theme_options',
		'title'			=> __('Theme Options', 'scwd'),
		// 'description'	=> __('Customize the content on your website.', 'scwd'),
	));

	/* General Options */
	$wp_customize->add_section( 'general_section', array(
		'title'			=> __( 'General Options', 'scwd' ),
		'description'	=> 'Adjust the display of general options on your website.',
		'panel' 		=> 'theme_options',
		'priority'		=> 10,
	) );

	// phone number (office)
	$wp_customize->add_setting( 'office', array(
		'default' => null,
		'sanitize_callback' => 'scwd_sanitize_text'
	) );
	$wp_customize->add_control( 'office', array(
		'label'		=> __( 'Phone Number(office)', 'scwd' ),
		'section'	=> 'general_section',
		'settings'	=> 'office',
		'priority'	=> 10,
	) );
	// phone number (cell)
	$wp_customize->add_setting( 'cell', array(
		'default' => null,
		'sanitize_callback' => 'scwd_sanitize_text'
	) );
	$wp_customize->add_control( 'cell', array(
		'label'		=> __( 'Phone Number(cell)', 'scwd' ),
		'section'	=> 'general_section',
		'settings'	=> 'cell',
		'priority'	=> 10,
	) );

	// email address
	$wp_customize->add_setting( 'email', array(
		'default' => null,
		'sanitize_callback' => 'scwd_sanitize_text'
	) );
	$wp_customize->add_control( 'email', array(
		'label'		=> __( 'Email Address', 'scwd' ),
		'section'	=> 'general_section',
		'settings'	=> 'email',
		'priority'	=> 20,
	) );

	// address
	$wp_customize->add_setting( 'address', array(
		'default'			=> null,
		'sanitize_callback'	=> 'scwd_sanitize_textarea',
	) );
	$wp_customize->add_control( new scwd_Customize_Textarea_Control( $wp_customize, 'address', array(
		'label'			=> __( 'Address', 'scwd' ),
		'section'		=> 'general_section',
		'priority'		=> 30,
	) ) );

	/* Footer Options */
	$wp_customize->add_section( 'footer_section', array(
		'title'			=> __( 'Footer Options', 'scwd' ),
		'description'	=> 'Adjust the display of footer options on your website.',
		'panel' 		=> 'theme_options',
		'priority'		=> 20,
	) );

	// footer logo uploader
	$wp_customize->add_setting( 'footer_logo', array( 'default' => null ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
		'label'		=> __( 'Footer Logo', 'scwd' ),
		'section'	=> 'footer_section',
		'settings'	=> 'footer_logo',
		'priority'	=> 80
	) ) );

	// cards image uploader
	$wp_customize->add_setting( 'payment_cards', array( 'default' => null ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'payment_cards', array(
		'label'		=> __( 'Payment Cards', 'scwd' ),
		'section'	=> 'footer_section',
		'settings'	=> 'payment_cards',
		'priority'	=> 90
	) ) );

	// copyright
	$wp_customize->add_setting( 'copyright', array(
		'default'			=> null,
		'sanitize_callback'	=> 'scwd_sanitize_textarea',
		'transport'			=> 'postMessage',
	) );

	$wp_customize->add_control( new scwd_Customize_Textarea_Control( $wp_customize, 'copyright', array(
		'label'			=> __( 'Copyright', 'scwd' ),
		'section'		=> 'footer_section',
		'priority'		=> 100,
		// 'description'	=> __( 'Displays tagline, site title, copyright, and year by default. Allowed tags: <img>, <a>, <div>, <span>, <blockquote>, <p>, <em>, <strong>, <form>, <input>, <br>, <s>, <i>, <b>', 'scwd' ),
	) ) );

	$wp_customize->selective_refresh->add_partial( 'copyright', array(
		'selector'			=> '.copyright',
		'render_callback'	=> 'scwd_customize_partial_copyright',
	) );

	/* Page Links Options */
	$wp_customize->add_section( 'page_links_section', array(
		'title'			=> __( 'Page Links', 'scwd' ),
		// 'description'	=> 'Adjust the display of general options on your website.',
		'panel' 		=> 'theme_options',
		'priority'		=> 30,
	) );

	$wp_customize->add_setting( 'sample_page_link', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'scwd_sanitize_dropdown_pages'
	) );

	$wp_customize->add_control( 'sample_page_link', array(
		'type' => 'dropdown-pages',
		'section' => 'page_links_section',
		'label' => __( 'Sample Page Link' ),
		'description' => __( 'This is a custom dropdown pages option.' ),
	) );

}
add_action( 'customize_register', 'scwd_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @see scwd_customize_register()
 *
 * @return void
 */
function scwd_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @see scwd_customize_register()
 *
 * @return void
 */
function scwd_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the site copyright for the selective refresh partial.
 *
 * @see scwd_customize_register()
 *
 * @return void
 */
function scwd_customize_partial_copyright() {
	if ( get_theme_mod( 'copyright' ) ) {
		return get_theme_mod( 'copyright' );
	}

	return get_bloginfo( 'description' ) . ' - ' . get_bloginfo( 'name' ) . ' &copy; ' . date( 'Y' );
}

/**
 * Sanitize checkbox options
 */
function scwd_sanitize_checkbox( $input ) {
	if ( $input == 1 ) :
		return 1;
	else :
		return 0;
	endif;
}

/**
 * Sanitize text input
 */
function scwd_sanitize_text( $input ) {
	return strip_tags( stripslashes( $input ) );
}

/**
 * Sanitize textarea
 */
function scwd_sanitize_textarea( $input ) {
	$allowed = array(
		's'			=> array(),
		'br'		=> array(),
		'em'		=> array(),
		'i'			=> array(),
		'strong'	=> array(),
		'b'			=> array(),
		'a'			=> array(
			'href'			=> array(),
			'title'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'form'		=> array(
			'id'			=> array(),
			'class'			=> array(),
			'action'		=> array(),
			'method'		=> array(),
			'autocomplete'	=> array(),
			'style'			=> array(),
		),
		'input'		=> array(
			'type'			=> array(),
			'name'			=> array(),
			'class' 		=> array(),
			'id'			=> array(),
			'value'			=> array(),
			'placeholder'	=> array(),
			'tabindex'		=> array(),
			'style'			=> array(),
		),
		'img'		=> array(
			'src'			=> array(),
			'alt'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
			'height'		=> array(),
			'width'			=> array(),
		),
		'span'		=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'p'			=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'div'		=> array(
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
		'blockquote' => array(
			'cite'			=> array(),
			'class'			=> array(),
			'id'			=> array(),
			'style'			=> array(),
		),
	);
	return wp_kses( $input, $allowed );
}

/**
 * Sanitize dropdown pages
 */
function scwd_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );

  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function scwd_customize_preview_js() {
	wp_enqueue_script( 'scwd_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'scwd_customize_preview_js' );


/**
 * Remove the additional CSS section, introduced in 4.7, from the Customizer.
 * @param $wp_customize WP_Customize_Manager
 */
function scwd_remove_css_section( $wp_customize ) {
	$wp_customize->remove_section( 'custom_css' );
}
add_action( 'customize_register', 'scwd_remove_css_section', 15 );

/**
 * Adds the Theme Options menu to the WordPress admin appearance section.
 */
function scwd_customizer_menu() {
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'customize.php' );
}
add_action( 'admin_menu', 'scwd_customizer_menu' );

/**
 * Add the theme options link to the Admin Bar
 *
*/
function scwd_add_theme_options_link() {
	global $wp_admin_bar, $wpdb;

	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;

	/* Add the main siteadmin menu item */
	$wp_admin_bar->add_menu(
		array(
			'id' => 'theme_options',
			'title' => __( 'Theme Options', 'scwd' ),
			'href' => admin_url('customize.php')
		)
	);
}
add_action( 'admin_bar_menu', 'scwd_add_theme_options_link', 1000 );

// Check if option exists
function checkoption( $optname ){
	if ( empty( $optname ) || $optname == '' )
		return false;

	// $chkoptions = get_option( 'custom_theme_options' );
	$chkoptions = get_theme_mods();
	if ( isset( $chkoptions[$optname] ) && $chkoptions[$optname] != '' )
		return true;
}

/**
 * Displays the specific custom option with parameters
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
function scwd_display_option_func( $atts ){
	$atts = shortcode_atts( array(
		'var' => '',
		'type' => 'text',
		'text' => '',
		'target' => '',
		'class' => '',
		'wrapper' => '',
		'wclass' => '',
		'link_type' => '',
		'icon' => '',
		'icon_position' => ''
	), $atts, 'scwd_option' );

	// $theme_options = get_option( 'custom_theme_options' );
	$theme_options = get_theme_mods();
	$resultString = '';

	if ( $atts['var'] != '' ) {
		if ( !checkoption( $atts['var'] ) ) {
			return sprintf('<div class="alert alert-danger"><strong>%s</strong></div>', 'Option does not exist or option is empty.');
		}

		// $resultString = ( (isset($theme_options[$atts['var']]) && $theme_options[$atts['var']] != '') ? $theme_options[$atts['var']] : '' );
		$resultString = $theme_options[$atts['var']];
		$tagClass = '';
		$tagTarget = '';
		$wrapperClass = '';

		// Check if result have [YEAR]
		if ( strpos( $resultString, '[YEAR]' ) ) {
			$resultString = str_replace('[YEAR]', date('Y'), $resultString);
		}

		// Build tag class string
		if ( $atts['class'] != '' )
			$tagClass = ' class="' . $atts['class'] . '"';
		// Build target string
		if ( $atts['target'] != '' )
			$tagTarget = ' target="' . $atts['target'] . '"';

		if ( $atts['type'] == 'link' ){
			$linkUrl = $resultString;
			$icon = '';
			if ( $atts['link_type'] ) {
				switch ( $atts['link_type'] ) {
					case 'email':
						$linkUrl = 'mailto:' . $linkUrl;
						break;

					case 'phone':
						$linkUrl = 'tel:' . $linkUrl;
						break;

					case 'page-link':
						$linkUrl = get_permalink( $linkUrl );
						break;

					default:
						$linkUrl = '#';
						break;
				}
			}

			$resultString = '<a href="' . $linkUrl . '"' . $tagClass . $tagTarget . '>' . (($atts['text'] != '') ? $atts['text']  : $resultString) . '</a>';

			if ( $atts['icon'] ) {
				$value = explode('|', $atts['icon']); //--> array([0]=>'fa',[1]=>'fa-inbox');
				$font = $value[0];
				$icon = $value[1];
				$icon = '<i class="'.$font.' '.$icon.'"></i>';
				$resultString = $atts['icon_position'] !== 'before' ? $resultString.$icon : $icon.$resultString;
			}
		} elseif ( $atts['type'] == 'image' ) {
			$resultString = '<img src="' . $resultString . '" alt="' . $atts['text'] . '"' . $tagClass . '>';
		}

	// Uncomment to convert newline to <br> in textarea output
	// $resultString = nl2br($resultString);

		// Build wrapper class string
		if($atts['wclass'] != '')
			$wrapperClass = ' class="' . $atts['wclass'] . '"';

		/*if ( $atts['wrapper'] == 'p' ){
			$resultString = '<p' . $wrapperClass . '>' . $resultString . '</p>';
		} elseif ( $atts['wrapper'] == 'div' ) {
			$resultString = '<div' . $wrapperClass . '>' . $resultString . '</div>';
		} elseif ( $atts['wrapper'] == 'li' ) {
			$resultString = '<li' . $wrapperClass . '>' . $resultString . '</li>';
		} elseif ( $atts['wrapper'] == 'span' ) {
			$resultString = '<span' . $wrapperClass . '>' . $resultString . '</span>';
		} elseif ( $atts['wrapper'] == 'strong' ) {
			$resultString = '<strong' . $wrapperClass . '>' . $resultString . '</strong>';
		}*/

		if ( $atts['wrapper'] ) {
			$wrapper = $atts['wrapper'];
			$resultString = "<{$wrapper} {$wrapperClass}> {$resultString} </{$wrapper}>";
		}
	}

	// Return output
	return $resultString;
}
add_shortcode( 'scwd_option', 'scwd_display_option_func' );