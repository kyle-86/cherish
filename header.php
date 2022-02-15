<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	<?php if ( get_field('td_theme_colour','options') ) : ?>
		<meta name="theme-color" content="<?php echo get_field('td_theme_colour','options'); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="header__contact">
	<div class="wrap wrap--fluid">
		<div class="contact__details">
			<?php $td_address = get_field('td_address','options'); ?>
			<?php $td_phone_number = get_field('td_phone_number','options'); ?>
			<?php $td_email_address = get_field('td_email_address','options'); ?>
			<ul class="contact__list">
				<?php if ($td_phone_number != '') { ?>
					<li class="phone__icon contact__icon"> <a href="tel:<?php echo $td_phone_number; ?>"> <span class="hide_mobile"><?php echo $td_phone_number; ?></span> </a> </li>
				<?php } ?>

				<?php if ($td_address != '') { ?>
					<li class="address__icon contact__icon"> <?php echo $td_address; ?> </li>
				<?php } ?>

				<?php if ($td_email_address != '') { ?>
					<li class="email__icon contact__icon"> <a href="mailto:<?php echo $td_email_address; ?>"> <span class="hide_mobile"><?php echo $td_email_address; ?></span> </a> </li>
				<?php } ?>
			</ul>
			<ul class="social__search">
				<li class="socail__accounts">
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
				<li class="hidden__tablet search__bar"><?php echo get_search_form(); ?> </li>
				<?php 
					$items_count = WC()->cart->get_cart_contents_count(); 
    			?>
    			
					<li class="header__cart">
						<a href="<?php echo wc_get_cart_url(); ?>">
							<i class="fas fa-shopping-cart">
								<?php if ($items_count >= 1) { ?>
									<span class="cart__count">
										<div id="mini-cart-count"><?php echo $items_count ? $items_count : '0'; ?></div>
									</span>
								<?php } ?>
							</i>
						</a>
					</li>
				
			</ul>
		</div>
	</div>
</div>

<div class="header">
	<div class="wrap wrap--fluid">
		<div class="header__flex">
			<?php if ( get_field('td_logo','options') ) : $image = get_field('td_logo','options'); ?>
			<div class="header__logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="link--cover" aria-label="View the home page"></a>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
			</div>
			<?php endif; ?>
			<?php td_display_hamburger(); ?>
			<div class="header__nav">
				<?php $args = array(
					'container'      => 'false',
					'menu_class'     => 'nav nav--primary inline_flex',
					'theme_location' => 'menu-header'
				); ?>
				<?php wp_nav_menu( $args ); ?>
				<div class="header_btns inline_flex">
					<?php if ( have_rows( 'header_buttons', 'options' ) ) : ?>
						<?php while ( have_rows( 'header_buttons', 'options' ) ) :
							the_row(); ?>
							
							<?php
							$link = get_sub_field( 'button', 'options' );
							if ( $link ) :
								$link_url = $link['url'];
								$link_title = $link['title'];
								$link_target = $link['target'] ? $link['target'] : '_self';
								?>
								<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
							<?php endif; ?>

						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>

