<?php
/**
 * WP Default WooCommerce Compatibility Settings
 *
 * @package WP_Default
 */

/**
 * Fix WooCommerce template issue.
 */
add_action( 'after_setup_theme', 'scwd_woocommerce_support' );
function scwd_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

function scwd_wrapper_start() {
	echo '<main id="main" class="site-main" role="main">';
}
add_action('woocommerce_before_main_content', 'scwd_wrapper_start', 10);

function scwd_wrapper_end() {
	echo '</main>';
}
add_action('woocommerce_after_main_content', 'scwd_wrapper_end', 10);