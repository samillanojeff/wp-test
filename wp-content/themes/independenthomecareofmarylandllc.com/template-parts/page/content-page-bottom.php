<?php if ( is_active_sidebar( 'page-bottom' ) && is_front_page() ) : ?>
	<div id="page-bottom" class="page-bottom widget-area clearfix">
		<div class="container-fluid">
			<div class="row">
				<?php dynamic_sidebar( 'page-bottom' ); ?>
			</div>
		</div>
	</div><!-- .widget-area -->
<?php endif; ?>