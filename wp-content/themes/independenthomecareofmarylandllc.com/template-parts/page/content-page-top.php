<?php if ( is_active_sidebar( 'page-top' ) && is_front_page() ) : ?>
	<div id="page-top" class="page-top widget-area clearfix" >
		<div class="container-fluid">
			<div class="row">
				<?php dynamic_sidebar( 'page-top' ); ?>
			</div>
		</div>
	</div><!-- .widget-area -->
<?php endif; ?>