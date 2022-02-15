<?php if ( get_field( 'hide_contact_footer' ) != 1 ) : ?>

	<?php  $contact_background_color = get_field( 'contact_background_color' ); ?>
	<?php  $contact_text_colour = get_field( 'contact_text_colour' ); ?>

	<?php if ( $contact_background_color || $contact_text_colour ) { ?>

		<style>
			.footer__contact-text *, #gform_confirmation_message_2 {
				color:  <?php echo $contact_text_colour; ?> !important;
			}
			.footer__contact {
				background-color:  <?php echo $contact_background_color; ?> !important;
			}
		</style>

	<?php } ?>
	
 
<div class="footer__contact">
	<div class="wrap wrap--fluid">
		<div class="grid">
			<div class="grid__item grid__item--half">
				<div class="footer__contact-text wysiwyg">
					<?php if ( $contact_area = get_field( 'contact_area', 'options' ) ) : ?>
						<?php echo $contact_area; ?>
					<?php endif; ?>
					<div class="contact__list text--large-body">
						<?php $td_address = get_field('td_address','options'); ?>
						<?php $td_phone_number = get_field('td_phone_number','options'); ?>
						<?php $td_email_address = get_field('td_email_address','options'); ?>
						
						<?php if ($td_phone_number != '') { ?>
							<p class="phone__icon contact__icon"> <i class="fas fa-phone-alt"></i> <a href="tel:<?php echo $td_phone_number; ?>"> <?php echo $td_phone_number; ?> </a> </p>
						<?php } ?>

						<?php if ($td_email_address != '') { ?>
							<p class="email__icon contact__icon"> <i class="fas fa-envelope"></i> <a href="mailto:<?php echo $td_email_address; ?>"><?php echo $td_email_address; ?></a> </p>
						<?php } ?>

						<?php if ($td_address != '') { ?>
							<p class="address__icon contact__icon"> <i class="fas fa-map-marker-alt"></i> <?php echo $td_address; ?> </p>
						<?php } ?>
					</div>
					<?php if ( have_rows( 'notices', 'options' ) ) : ?>
						<?php while ( have_rows( 'notices', 'options' ) ) :
							the_row(); ?>
							
							<?php if ( $each_notice = get_sub_field( 'each_notice', 'options' ) ) : ?>
								<?php echo $each_notice; ?>
							<?php endif; ?>

						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="grid__item grid__item--half">
				<div class="footer__contact-form">
					<?php $contact_form = get_field( 'form', 'options' ); ?>
					<?php gravity_form($contact_form['id'], true, true, false, '', true, 1); ?>
				</div>
			</div>	
		</div>
	</div>
</div>
 
<?php endif; ?>

<div class="footer">		
	<div class="wrap wrap--fluid">		
		<div class="footer__copyright">
			<div class="grid">
				<div class="grid__item footer__logo">
					<?php if ( get_field('td_footer_logo','options') ) : $image = get_field('td_footer_logo','options'); ?>
					<div class="header__logo">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="link--cover" aria-label="View the home page"></a>
						<img src="<?php echo $image['url']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
					</div>
					<?php endif; ?>
				</div>
				<div class="grid__item grid__item--third footer__social">
					<ul class="social__search">
						<li>
							<div class="social__links">
								<?php if ( have_rows( 'td_social_media', 'options' ) ) : ?>
									<?php while ( have_rows( 'td_social_media', 'options' ) ) :
										the_row(); ?>
										<?php $icon = get_sub_field('icon'); ?>
										<?php $title = get_sub_field('title'); ?>
										<?php $url = get_sub_field('url'); ?>
										<a href="<?php echo esc_url( $url ); ?>" target="_blank" title="<?php echo esc_html( $title ); ?>">
											<i class="<?php echo $icon; ?>"></i>
										</a>
									<?php endwhile; ?>
								<?php endif; ?>
							</div>
						</li>
					</ul>
				</div>
				<div class="grid__item grid__item--third footer__text">
					<?php echo (get_field('td_business_name','options')) ? get_field('td_business_name','options') : get_bloginfo('name'); ?>. &copy; <?php echo date('Y');?>
				</div>
				<div class="grid__item grid__item--third footer__menu">
					<?php $args = array(
						'container'      => 'false',
						'menu_class'     => 'nav nav--footer inline_flex',
						'theme_location' => 'menu-footer'
					); ?>
					<?php wp_nav_menu( $args ); ?>
				</div>
				
			</div>
		</div>		
		<!-- <a class="footer__credit" href="https://thirteendigital.com.au/" target="_blank">Site by Thirteen Digital</a> -->
	</div><!-- /wrap -->
</div><!-- /footer -->

<?php get_template_part('inc/offscreen'); ?>

<?php wp_footer(); ?>

</body>

</html>