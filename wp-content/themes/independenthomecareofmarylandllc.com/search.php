<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WP_Default
 */

get_header(); ?>

<div class="container-fluid">
	<div class="row">
		<section id="primary" class="content-area col-sm-8">
			<main id="main" class="site-main">

			<?php
			if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php
	 					/* translators: %s: search query. */
	 					printf( esc_html__( 'Search Results for: %s', '_s' ), '<span>' . get_search_query() . '</span>' );
	 				?></h1>
				</header>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/post/content', 'search' );

				endwhile;

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/post/content', 'none' );

			endif; ?>

			</main>
		</section>

		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
