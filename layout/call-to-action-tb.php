<?php $show_bottom_drop_shadow = get_sub_field( 'show_bottom_drop_shadow'); ?>


<div class="cta__tb <?php if ( $show_bottom_drop_shadow == 1 ) { echo 'cta__tb-shadow'; } ?>">
	<div class="wrap wrap--fluid">
	<?php if ( $text = get_sub_field( 'text' ) ) : ?>
		<div class="cta__tb_content">
			<h3> <?php echo $text; ?> </h3>
		</div>
	<?php endif; ?>
	<?php
	$link = get_sub_field( 'button' );
	if ( $link ) :
		$link_url = $link['url'];
		$link_title = $link['title'];
		$link_target = $link['target'] ? $link['target'] : '_self';
		?>
		<a class="button button--alt" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
	<?php endif; ?>
	</div>
</div>