
<?php if ( get_sub_field('content') ) : ?>
	<?php $width = get_sub_field( 'full-width'); ?>
	
	<?php 
		$background_colour = get_sub_field( 'background_colour' );
	?>
	<div class="content__block" style="background-color:<?php echo $background_colour; ?>">
	
		<?php if ( $width != 1 ) : ?>
		 	<div class="wrap wrap--content">
		<?php endif; ?>

			<div class="wysiwyg spacing">
				<?php echo get_sub_field('content'); ?>
			</div>

		<?php if ( $width != 1 ) : ?>
		 	</div>
		<?php endif; ?>

	</div>
<?php endif; ?>