<?php
/**
 * Template part for displaying news block posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Default
 */

?>

<div id="post-<?php the_ID(); ?>" class="testimonial post-block clearfix">
	<?php if ( has_post_thumbnail() ): ?>
		<div class="featured-img">
			<?php the_post_thumbnail( 'full', array( 'class' => 'thumbnail' ) ); ?>
		</div>
	<?php endif ?>

	<div class="heading">
		<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</div>
	<div class="date">Date Posted: <?php echo get_the_date( 'm/d/Y' ); ?></div>
	<p><?php the_excerpt() ?></p>
</div>