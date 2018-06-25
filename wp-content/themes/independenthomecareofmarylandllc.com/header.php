<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Default
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" /> -->

<?php wp_head(); ?>
</head>

<body <?php if (!is_front_page()){ body_class('inner'); } else{ body_class(); } ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'scwd' ); ?></a>

	<header id="masthead" class="site-header main">
		<!-- <div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<?php //scwd_the_custom_logo(); ?>
					<?php //get_template_part( 'template-parts/header/site', 'branding' ); ?>
				</div>
				<div class="col-sm-6">
					<?php //get_template_part( 'template-parts/navigation/navigation', 'social' ); ?>
				</div>
			</div>
		</div>

		<?php //if ( has_nav_menu( 'top' ) ) : ?>
			<div class="navigation-top">
				<div class="container-fluid wrap">
					<?php //get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
				</div> .wrap -->
			<!--</div>--><!-- .navigation-top -->
		<?php //endif; ?> 
		<div id="header">
			<div class="top">
				<div class="row">
					<a href="home" class="logo">
						<img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/logo.png" alt="">
					</a>
					<dl class="address">
						<dt><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/mail.png" alt=""></dt>
						<dd>
							<?php if ( checkoption( 'address' ) ): 
								echo do_shortcode('[scwd_option var="address" type="text"]');
							endif; ?>
						</dd>
					</dl>
					<dl>
						<dt><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/address.png" alt=""></dt>
						<dd>
							<?php if ( checkoption( 'phone' ) ): 
								echo do_shortcode('[scwd_option var="email" type="link" text="" link_type="email"]');
							endif; ?>
						</dd>
					</dl>
					<div class="sml">
						<a href=""><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/fb.png" alt=""></a>
						<a href=""><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/gp.png" alt=""></a>
						<a href=""><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/tw.png" alt=""></a>
					</div>
				</div>
			</div>
			<div class="bot">
				<div class="row">
					<?php if ( has_nav_menu( 'top' ) ) : ?>
						<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
					<?php endif; ?>
					<!-- <nav>
						<a href="#" id="pull"><strong>MENU</strong></a>
						<ul>
							<li <?php //$this->helpers->isActiveMenu("home"); ?>><a href="<?php //echo URL ?>home">HOME</a></li>
							<li <?php //$this->helpers->isActiveMenu("about"); ?>><a href="<?php //echo URL ?>about">ABOUT</a></li>
							<li <?php //$this->helpers->isActiveMenu("services"); ?>><a href="<?php //echo URL ?>services">SERVICES</a></li>
							<li <?php //$this->helpers->isActiveMenu("gallery"); ?>><a href="<?php //echo URL ?>gallery">GALLERY</a></li>
							<li <?php //$this->helpers->isActiveMenu("reviews"); ?>><a href="<?php //echo URL ?>reviews">REVIEWS</a></li>
							<li <?php //$this->helpers->isActiveMenu("contact"); ?>><a href="<?php //echo URL ?>contact">CONTACT US</a></li>
							<li <?php //$this->helpers->isActiveMenu("location"); ?>><a href="<?php //echo URL ?>location">LOCATION</a></li>
						</ul>
					</nav> -->
				</div>		
			</div>
		</div>

	</header>

	<?php //if ( is_active_sidebar( 'banner' ) && is_front_page() ) : ?>
		<div id="banner" class="widget-area clearfix" >
			<?php //dynamic_sidebar( 'banner' ); ?>
			<div class="row">
				<img id="banner-image" src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/banner.jpg" alt="">
				<div class="container">
					<div class="wrapper">
						<div class="col">
							<h2>Providing <br>Peace of Mind</h2>
							<p>We understand that each clients needs and wishes are as unique as they are and we will do everything we can to meet your expectations.</p>
							<a href="contact" class="btn btn-white">Call Us Today!</a>
						</div>
					</div>
				</div>
			</div>
				
		</div><!-- .widget-area -->
	<?php //endif; ?>


	<?php //get_template_part( 'template-parts/page/content', 'page-top' ) ?>

	<div id="content" class="site-content main">
