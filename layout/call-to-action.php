<?php if ( have_rows( 'cta' ) ) : ?>
	<div class="wrap wrap--fluid">
		<div class="cta__block grid">
			<?php while ( have_rows( 'cta' ) ) :
				the_row(); ?>
				<div class="cta__block_single grid__item grid__item--third">
						<?php
						$link = get_sub_field( 'Button' );
						if ( $link ) :
							$link_url = $link['url'];
							$link_title = $link['title'];
							$link_target = $link['target'] ? $link['target'] : '_self';
						endif;
						?>
						<?php
						$image = get_sub_field('image');
						$image = $image['sizes']['cta-size'];
						if( $image ) { ?>
							<div class="cta__block_frame">
								<?php
								if ( $link ) : ?>
								<a href="<?php echo esc_url( $link_url ); ?>">
								<?php endif; ?>	
							    	<div class="cta__block_img" style="background-image: url(<?php echo $image; ?>)"> </div>
								<?php
								if ( $link ) : ?>
								</a>
								<?php endif; ?>	
							</div>
						<?php } ?>

						<?php if ( $title = get_sub_field( 'title' ) ) : ?>
							<div class="cta__block_title js-match-height">
								<h4> <?php echo $title; ?> </h4>
							</div>
						<?php endif; ?>

						<?php
						if ( $link ) : ?>
							<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
						<?php endif; ?>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
<?php endif; ?>