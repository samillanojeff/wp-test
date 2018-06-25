<?php
/**
 * Template part for displaying block posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Default
 */

?>

<div id="post-<?php the_ID(); ?>" class="post post-block clearfix">
	<?php if ( has_post_thumbnail() ): ?>
		<div class="featured-img">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'full', array( 'class' => 'thumbnail' ) ); ?>
			</a>
		</div>
	<?php endif ?>

	<div class="heading">
		<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</div>

	<?php
		the_excerpt();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'scwd' ),
			'after'  => '</div>',
		) );
	?>
</div>
