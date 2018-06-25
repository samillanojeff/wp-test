<div class="site-info">
	<div class="container-fluid">
		<div class="copyright">
			<?php
				$site_info = get_bloginfo( 'description' ) . ' - ' . get_bloginfo( 'name' ) . ' &copy; ' . date( 'Y' );

				if ( get_theme_mod( 'copyright' ) ) :
					echo get_theme_mod( 'copyright' );
				else :
					echo $site_info;
				endif;
			?>
		</div>
	</div>
</div><!-- .site-info -->