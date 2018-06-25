<?php
/**
 * WP Default functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP_Default
 */

if ( ! function_exists( 'scwd_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function scwd_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change 'scwd' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'scwd', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'scwd-featured-image', 640, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top' => esc_html__( 'Top Menu', 'scwd' ),
		'bottom' => esc_html__( 'Bottom Menu', 'scwd' ),
		'social' => esc_html__( 'Social Links Menu', 'scwd' ),
	) );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 300,
		'width'       => 300,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	/**
	 * Add theme support for selective refresh for widgets.
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	/*add_theme_support( 'custom-background', apply_filters( 'scwd_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );*/
}
endif;
add_action( 'after_setup_theme', 'scwd_setup' );

/**
 * Removes the unnecessary WP tags from the document header.
 */
function scwd_clean_up_wp_head() {
	// Removes the “generator” meta tag from the document header
	remove_action('wp_head', 'wp_generator');
	// Removes the “wlwmanifest” link
	remove_action('wp_head', 'wlwmanifest_link');
	// The RSD is an API to edit your blog from external services and clients
	remove_action('wp_head', 'rsd_link');
	// “wp_shortlink_wp_head” adds a “shortlink” into your document head that will look like http://example.com/?p=ID
	remove_action('wp_head', 'wp_shortlink_wp_head');
	// Removes a link to the next and previous post from the document header.
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
	// Removes the generator name from the RSS feeds.
	add_filter('the_generator', '__return_false');
	// Disable WordPress Emoticons
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );
	// Disable REST API link tag
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	// Disable oEmbed Discovery Links
	remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
	// Disable REST API link in HTTP headers
	remove_action('template_redirect', 'rest_output_link_header', 11, 0);
}
add_action('after_setup_theme', 'scwd_clean_up_wp_head');

/**
 * Redirecting and 404ing unnecessary pages
 *
 * If it is an attachment page (most likely an image) we redirect to the page that is referencing to that image.
 * If the image is an orphan we just return 404.
 */
function scwd_template_redirect () {
	global $wp_query, $post;

	if ( is_attachment() ) {
		$post_parent = $post->post_parent;

		if ( $post_parent ) {
			wp_redirect( get_permalink($post->post_parent), 301 );
			exit;
		}

		$wp_query->set_404();

		return;
	}

	if ( is_author() || is_date() ) {
		$wp_query->set_404();
	}
}
add_action( 'template_redirect', 'scwd_template_redirect' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function scwd_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'scwd_content_width', 640 );
}
add_action( 'after_setup_theme', 'scwd_content_width', 0 );

/**
 * Return early if Custom Logos are not available.
 *
 * @todo Remove after WP 4.7
 */
function scwd_the_custom_logo() {
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	} else {
		the_custom_logo();
	}
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function scwd_widgets_init() {
	register_sidebar( array(
		'name'			=> esc_html__( 'Sidebar', 'scwd' ),
		'id'			=> 'sidebar',
		'description'	=> '',
		'before_widget'	=> '<section id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );

	// Banner (After Header) Widget Area. Single column
	register_sidebar( array(
		'name'			=> __( 'Banner', 'scwd' ),
		'id'			=> 'banner',
		'description'	=> __( 'Optional section after the header. This is a single column area that spans the full width of the page.', 'scwd' ),
		'before_widget'	=> '<section id="%1$s" class="widget %2$s clearfix"><div class="container-fluid">',
		'after_widget'	=> '</div><!-- container-fluid --></section>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title' 	=> '</h3>',
	) );

	// Page Top (After Banner) Widget Area.
	register_sidebar( array(
		'name'			=> __( 'Page Top', 'scwd' ),
		'id'			=> 'page-top',
		'description'	=> __( 'Optional section after the banner. Add 1-4 widgets here to display in columns.', 'scwd' ),
		'before_widget'	=> '<section id="%1$s" class="widget col-sm-3 clearfix %2$s">',
		'after_widget'	=> "</section>",
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );

	// Page Bottom (Before Footer) Widget Area.
	register_sidebar( array(
		'name'			=> __( 'Page Bottom', 'scwd' ),
		'id'			=> 'page-bottom',
		'description'	=> __( 'Optional section before the footer. Add 1-3 widgets here to display in columns.', 'scwd' ),
		'before_widget'	=> '<section id="%1$s" class="widget col-sm-4 clearfix %2$s">',
		'after_widget'	=> "</section>",
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '</h3>',
	) );
}
add_action( 'widgets_init', 'scwd_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function scwd_scripts() {
	/* Fonts */
	wp_enqueue_style( 'scwd-google-fonts', '//fonts.googleapis.com/css?family=Open+Sans' );
	// wp_enqueue_style( 'dashicons');
	// wp_enqueue_style( 'scwd-genericons', 'https://cdnjs.cloudflare.com/ajax/libs/genericons/3.1/genericons.min.css' );
	wp_enqueue_style( 'scwd-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css');

	/* Load Stylesheets */
	// Bootstrap
	//wp_enqueue_style( 'scwd-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
	//wp_enqueue_style( 'scwd-bootstrap-theme', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css');
	// Social Menu
	wp_enqueue_style( 'scwd-social-menu', get_template_directory_uri() . '/assets/css/social-menu.css');
	// Theme Base
	wp_enqueue_style( 'scwd-theme-base', get_template_directory_uri() . '/assets/css/theme-base.css');
	// Main Styles
	wp_enqueue_style( 'scwd-style', get_stylesheet_uri() );

	/* Load Java Scripts */
	// Bootstrap
	//wp_enqueue_script( 'scwd-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), '', true );
	// Navigation
	wp_enqueue_script( 'scwd-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'scwd-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	// Scripts
	wp_enqueue_script( 'scwd-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'scwd_scripts' );

/**
 * Getting rid of archive “label”
 */
function scwd_archive_title( $title ) {
	if ( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	} elseif ( is_tax() ) {
		$title = single_term_title( '', false );
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'scwd_archive_title' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function scwd_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
 add_action( 'wp_head', 'scwd_pingback_header' );

/**
 * Enable shortcodes in text widgets.
 */
// add_filter('widget_text','do_shortcode');

/**
 * Disable XML-RPC.
 */
// add_filter('xmlrpc_enabled', '__return_false');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Theme options shortcode generator.
 */
require get_template_directory() . '/inc/shortcode-generator.php';

/**
 * Custom theme options.
 */
require get_template_directory() . '/inc/custom-theme-options.php';

/**
 * Load suggested plugins file to display admin notices.
 */
require get_template_directory() . '/inc/engagewp-plugins.php';

/**
 * Load WooCommerce compatibility.
 */
// require get_template_directory() . '/inc/wc-compatiblity.php';

/**
 * Create custom post types and taxomy.
 */
require get_template_directory() . '/inc/custom-post-types.php';
