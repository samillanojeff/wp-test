<?php
/**
 * WP Default Custom Post Types Sample
 *
 * @package WP_Default
 */

/**
 * Create testimonial post type
 */
function scwd_create_testimonial_post_type() {

	$labels = array(
		'name'					=> __( 'Testimonials', 'scwd' ),
		'singular_name'			=> __( 'Testimonial', 'scwd' ),
		'add_new'				=> __( 'New Testimonial', 'scwd' ),
		'add_new_item'			=> __( 'Add New Testimonial', 'scwd' ),
		'edit_item'				=> __( 'Edit Testimonial', 'scwd' ),
		'new_item'				=> __( 'New Testimonial', 'scwd' ),
		'view_item'				=> __( 'View Testimonial', 'scwd' ),
		'search_items'			=> __( 'Search Testimonials', 'scwd' ),
		'not_found'				=>  __( 'No Testimonials Found', 'scwd' ),
		'not_found_in_trash'	=> __( 'No Testimonials found in Trash', 'scwd' ),
	);
	$args = array(
		'labels'		=> $labels,
		'has_archive'	=> true,
		'public'		=> true,
		'hierarchical'	=> false,
		'rewrite'		=> array( 'slug' => 'testimonial' ),
		'supports'		=> array(
			'title',
			'editor',
			'excerpt',
			'custom-fields',
			'thumbnail',
			'page-attributes'
		),
		'taxonomies'	=> array( 'post_tag' ),
	);
	register_post_type( 'scwd_testimonial', $args );

}
add_action( 'init', 'scwd_create_testimonial_post_type' );

/**
 * Create testimonial post type taxonomy
 */
function scwd_register_testimonial_taxonomy() {

	$labels = array(
		'name'				=> __( 'Categories', 'scwd' ),
		'singular_name'		=> __( 'Category', 'scwd' ),
		'search_items'		=> __( 'Search Categories', 'scwd' ),
		'all_items'			=> __( 'All Categories', 'scwd' ),
		'edit_item'			=> __( 'Edit Category', 'scwd' ),
		'update_item'		=> __( 'Update Category', 'scwd' ),
		'add_new_item'		=> __( 'Add New Category', 'scwd' ),
		'new_item_name'		=> __( 'New Category Name', 'scwd' ),
		'menu_name'			=> __( 'Categories', 'scwd' ),
	);

	$args = array(
		'labels'			=> $labels,
		'hierarchical'		=> true,
		'sort'				=> true,
		'args'				=> array( 'orderby' => 'term_order' ),
		'rewrite'			=> array( 'slug'    => 'testimonial-category' ),
		'show_admin_column'	=> true
	);

	register_taxonomy( 'scwd_testimonial_cat', array( 'scwd_testimonial' ), $args);

}
add_action( 'init', 'scwd_register_testimonial_taxonomy' );