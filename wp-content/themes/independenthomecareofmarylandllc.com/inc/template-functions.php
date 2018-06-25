<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * @package WP_Default
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function scwd_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Add a class of no-sidebar when there is no sidebar present
	if ( ! is_active_sidebar( 'sidebar' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'scwd_body_classes' );


/**
 * Display news custom post type using shortcode.
 *
 * @param  array $atts [description]
 * @return html
 */
function scwd_display_testimonials( $atts ) {
	$atts = shortcode_atts( array(
		'heading'   => '',
		'link_text' => 'View All',
		'limit'     => 10,
		'orderby'   => 'date',
		'order'     => 'DESC'
	), $atts, 'scwd_testimonials' );

	global $post;
	$args = array (
		'posts_per_page'   => $atts['limit'],
		'orderby'          => $atts['orderby'],
		'order'            => $atts['order'],
		'post_type'        => 'scwd_news',
		'post_status'      => 'publish',
	);

	$news = get_posts( $args );

	ob_start(); ?>
	<div class="news-list post-block-list">
		<?php if ( $atts['heading'] !== '' ): ?>
			<h3 class="heading"><?php echo $atts['heading']; ?></h3>
		<?php endif ?>

		<?php foreach ( $news as $post ):
			setup_postdata( $post );
			get_template_part( 'template-parts/post/content', 'testimonial-block' );
		endforeach ?>
		<?php wp_reset_postdata(); ?>
	</div>
	<?php if ( wp_count_posts( 'scwd_news' )->publish > count( $news ) ): ?>
		<a href="<?php echo get_post_type_archive_link( 'scwd_news' ) ?>" class="box-btn"><?php echo $atts['link_text'] ?></a>
	<?php endif ?>

	<?php
	$content = ob_get_clean();
	return $content;
}
add_shortcode( 'scwd_testimonials', 'scwd_display_testimonials' );
