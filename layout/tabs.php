<?php if ( have_rows( 'each_tab' ) ) : ?>

<div class="tabset">

	<?php $tabCount = 0; ?>
	<?php while ( have_rows( 'each_tab' ) ) :
		the_row(); ?>
		
		<?php 
			$title = get_sub_field( 'title' );
			$title = str_replace(' ', '', $title);
		?>

			<input type="radio" name="tabset" id="tab<?php echo strtolower($title); ?>" aria-controls="<?php echo strtolower($title); ?>" <?php if ( $tabCount == 0 ) { echo 'checked'; } ?>>

		<?php $tabCount++; ?>
	<?php endwhile; ?>

	<div class="tabset__tabs">
		<?php $tabCount = 0; ?>
		<?php while ( have_rows( 'each_tab' ) ) :
			the_row(); ?>
			
			<?php 
				$title = get_sub_field( 'title' );
				$title = str_replace(' ', '', $title);
			?>

	  		<label class="tab__label" for="tab<?php echo strtolower($title); ?>"><?php echo get_sub_field( 'title' ); ?></label>


			<?php $tabCount++; ?>
		<?php endwhile; ?>
	</div>

	 <div class="tab-panels">
	<?php while ( have_rows( 'each_tab' ) ) :
		the_row(); ?>
			<?php 
				$title = get_sub_field( 'title' );
				$title = str_replace(' ', '', $title);
			?>

		<section id="<?php echo strtolower($title); ?>" class="tab-panel">


		<?php if ( get_sub_field( 'content_type' ) == 'bothText' ) : ?>
		<div class="half__half-bg">
			<div class="wrap wrap--fluid">
				<div class="grid">

					<div class="grid__item grid__item--half">
						<div class="tab__panel tab__panel--left">
							<div class="wysiwyg">
								<?php if ( $left_text_side = get_sub_field( 'left_text_side' ) ) : ?>
									<?php echo $left_text_side; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
					
					<div class="grid__item grid__item--half">
						<div class="tab__panel tab__panel--right">
							<div class="wysiwyg">
								<?php if ( $right_text_side = get_sub_field( 'right_text_side' ) ) : ?>
									<?php echo $right_text_side; ?>
								<?php endif; ?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( get_sub_field( 'content_type' ) == 'leftTextRightImage' ) : ?>
			<div class="half__half-bg">
				<div class="wrap wrap--fluid">
					<div class="grid">

						<div class="grid__item grid__item--half">
							<div class="tab__panel tab__panel--left">
								<div class="wysiwyg">
									<?php if ( $left_text_side = get_sub_field( 'left_text_side' ) ) : ?>
										<?php echo $left_text_side; ?>
									<?php endif; ?>
								</div>
							</div>
						</div>
						
						<div class="grid__item grid__item--half">
							<div class="tab__panel tab__panel--right">
									<?php
									$right_side_image = get_sub_field( 'right_side_image' );
									if ( $right_side_image ) : ?>
										<div class="tab__panel-fullImage" style="background-image: url(<?php echo esc_url( $right_side_image['url'] ); ?>)">
										</div>
									<?php endif; ?>
							</div>
						</div>

					</div>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( get_sub_field( 'content_type' ) == 'multiBlocks' ) : ?>
			<div class="half__half-bg">
		<div class="wrap wrap--fluid">
			<div class="grid multi__blocks">

				<?php if ( have_rows( 'multi_blocks' ) ) : ?>
					<?php $rowCount = 0; ?>
					<?php while ( have_rows( 'multi_blocks' ) ) :
						the_row(); ?>

						<?php $blockType = get_sub_field( 'block_type' ); ?>
						
						<?php if ( $blockType == 'text' ) : ?>
						 	<div class="grid__item grid__item--half">
								<div class="tab__panel text__block-padding vert--center">
									<div class="wysiwyg">
										<?php if ( $text_block = get_sub_field( 'text_block' ) ) : ?>
											<?php echo $text_block; ?>
										<?php endif; ?>
									</div>
								</div>
							</div>
						<?php endif; ?>
						
						<?php if ( $blockType == 'image' ) : ?>
							<div class="grid__item grid__item--half grid__item-image">
								<div class="tab__panel">
									<?php
									$image_block = get_sub_field( 'image_block' );
									if ( $image_block ) : ?>
										<img src="<?php echo esc_url( $image_block['url'] ); ?>)">
									<?php endif; ?>
								</div>
							</div>
						<?php endif;  ?>
						<?php $rowCount++; ?>
					<?php endwhile; ?>
				<?php endif; ?>

			</div>
		</div>
	</div>
		<?php endif; ?>

		</section>
	<?php endwhile; ?>
	</div>
</div>
<?php endif; ?>