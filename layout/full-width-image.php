<?php
$image = get_sub_field( 'image' );
if ( $image ) : ?>
	<div class="fullwidth__image text-center">
		<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
	</div>
<?php endif; ?>