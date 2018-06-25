<?php if ( get_theme_mod( 'display_title_tagline' ) === 1 ): ?>
	<div class="site-branding">
		<?php
		if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
		<?php endif;

		$description = get_bloginfo( 'description', 'display' );

		if ( $description || is_customize_preview() ) : ?>
			<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
		<?php endif; ?>
	</div><!-- .site-branding -->
<?php endif ?>