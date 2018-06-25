<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Default
 */

?>
	</div><!-- .site-content -->

	<?php //get_template_part( 'template-parts/page/content', 'page-bottom' ); ?>

	<!-- <footer id="colophon" class="site-footer main"> -->
	<footer>

		<?php //if ( has_nav_menu( 'bottom' ) ) : ?>
			<!-- <div class="navigation-bottom">
				<div class="container-fluid wrap"> -->
					<?php //get_template_part( 'template-parts/navigation/navigation', 'bottom' ); ?>
				<!-- </div> --><!-- .wrap -->
			<!-- </div> --><!-- .navigation-top -->
		<?php //endif; ?>

		<?php //get_template_part( 'template-parts/footer/site', 'info' ); ?>

		<div id="footer">
			<div class="top">
				<div class="row">
					<div class="container">
						<a href="home" class="logo"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/logo.png" alt=""></a>
					</div>
				</div>
			</div>
			<div class="bot">
				<div class="row">
					<div class="qform">
						<div class="ctc-info">
							<h2>ANY QUESTIONS? <span>CONTACT US</span></h2>
							<ul>
								<li>
									<img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/address.png" alt="">
									<span>
										<?php if ( checkoption( 'address' ) ): 
											echo do_shortcode('[scwd_option var="address" type="text"]');
										endif; ?>
									</span>
								</li>
								<li class="phone">
									<img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/phone.png" alt="">
									<span>
										<?php if ( checkoption( 'office' ) ): 
											echo do_shortcode('[scwd_option var="office" type="link" text="" link_type="phone"]');
										endif; ?> (office)
										<br>
										<?php if ( checkoption( 'cell' ) ): 
											echo do_shortcode('[scwd_option var="cell" type="link" text="" link_type="phone"]');
										endif; ?> (cell)
									</span>
								</li>
								<li>
									<img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/mail.png" alt="">
									<span><?php if ( checkoption( 'phone' ) ): 
											echo do_shortcode('[scwd_option var="email" type="link" text="" link_type="email"]');
										endif; ?></span>
								</li>
								<li>
									<img src="<?php bloginfo( 'template_url' ); ?>/assets/images/common/time.png" alt="">
									<span>Mon - Fri: 9AM - 5PM <br>Sat & Sunday: Office is Closed</span>
								</li>
							</ul>
						</div>
						<form action="sendContactForm" method="post"  class="sends-email ctc-form" >
							<p>Please fill out the form below to be added to our customer list.</p>
							<label><span class="ctc-hide">Name</span>
								<input type="text" name="name" placeholder="Name:">
							</label>
							<label><span class="ctc-hide">Email</span>
								<input type="text" name="email" placeholder="Email:">
							</label>
							<label><span class="ctc-hide">Message</span>
								<textarea name="message" cols="30" rows="10" placeholder="Message:" data-gramm="false"></textarea>
							</label>
							<label>
								<input type="checkbox" name="consent" class="consentBox">I hereby consent to having this website store my submitted information so that they can respond to my inquiry.
							</label><br>
							<?php //if( $this->siteInfo['policy_link'] ): ?>
							<!-- <label>
								<input type="checkbox" name="termsConditions" class="termsBox"/> I hereby confirm that I have read and understood this website's <a href="<?php //$this->info("policy_link"); ?>" target="_blank">Privacy Policy.</a>
							</label> -->
							<?php //endif ?>
							<label for="g-recaptcha-response"><span class="ctc-hide">Recaptcha</span></label>
							<div class="g-recaptcha"></div>
							<button type="submit" class="ctcBtn btn btn-white" disabled>send message</button>
							<div class="clearfix"></div>
						</form>
					</div>
					<div class="last">
						<?php get_template_part( 'template-parts/navigation/navigation', 'bottom' ); ?>
						<p class="copy">
							&copy;
							<?php echo date('Y'); ?>
							<?php bloginfo('name') ?>
							<?php if ( checkoption( 'copyright' ) ): 
								echo do_shortcode('[scwd_option var="copyright" type="text"]');
							endif; ?>
						</p>
						<p class="silver"><img src="<?php bloginfo( 'template_url' ); ?>/assets/images/scnt.png" alt="" class="company-logo" /><a href="https://silverconnectwebdesign.com/website-development" rel="external" target="_blank">Web Design</a> Done by <a href="https://silverconnectwebdesign.com" rel="external" target="_blank">Silver Connect Web Design</a></p>
					</div>
				</div>
			</div>
		</div>

	</footer>

</div><!-- .site -->

<!-- <script src='//www.google.com/recaptcha/api.js?onload=captchaCallBack&render=explicit' async defer></script> -->
<!-- <script>
	var captchaCallBack = function() {
		$('.g-recaptcha').each(function(index, el) {
			grecaptcha.render(el, {'sitekey' : ''});
		});
	};

	$('.consentBox').click(function () {
	    if ($(this).is(':checked')) {
	    	if($('.termsBox').length){
	    		if($('.termsBox').is(':checked')){
	        		$('.ctcBtn').removeAttr('disabled');
	        	}
	    	}else{
	        	$('.ctcBtn').removeAttr('disabled');
	    	}
	    } else {
	        $('.ctcBtn').attr('disabled', true);
	    }
	});

	$('.termsBox').click(function () {
	    if ($(this).is(':checked')) {
    		if($('.consentBox').is(':checked')){
        		$('.ctcBtn').removeAttr('disabled');
        	}
	    } else {
	        $('.ctcBtn').attr('disabled', true);
	    }
	});

</script> -->
<?php wp_footer(); ?>

</body>
</html>
