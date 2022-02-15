<?php get_header(); ?>
<?php get_template_part('inc/hero'); ?>
	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<?php if ( get_field('td_page_content') && !post_password_required() ) : ?>
        	<?php get_template_part('inc/flexible'); ?>
        <?php else: ?>
        	<?php if ( is_cart() || is_checkout() ) { ?>
        		<div class="wrap wrap--fluid">
        		<div class="paddLeftRight">
		
		<div class="grid woo__grid spacing">

			<div class="woo__shop_title">
				<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) { ?>
					<h2 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h2>
				<?php } ?>
			</div>

			<div class="woo__sidebar">
				<?php $args = array(
					'container'      => 'false',
					'menu_class'     => 'nav nav--shop inline_flex text--large-body',
					'theme_location' => 'menu-shop'
				); ?>
				<?php wp_nav_menu( $args ); ?>
			</div>

			<div class="woo__content product__inner_page">
        	<?php } else { ?>
        	<div class="wrap wrap--fluid wysiwyg">
        		<div class="paddLeftRight">
        	<?php } ?>
        		<?php the_content(); ?>
        	<?php if ( is_cart() || is_checkout() ) { ?>
        		</div> </div> </div> </div>
        	<?php } else { ?>
	        	</div> </div> 
	        <?php } ?>
        <?php endif; ?>
	<?php endwhile; ?><?php endif; ?>
<?php get_footer(); ?>