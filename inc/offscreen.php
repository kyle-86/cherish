<div class="offscreen">
	<div class="offscreen__body">
		<div class="offscreen__content">
			<div class="offscreen__nav">
				<?php $args = array(
					'container'      => 'false',
					'menu_class'     => 'nav nav--offscreen',
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
					<?php echo get_search_form(); ?>
				</div>		
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
			</div>
		</div>
	</div>
</div>