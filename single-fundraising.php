<?php get_header(); ?>
	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

	<?php 
	$title = get_the_title();
	$location = get_field('location');
	$address = get_field('address');
	$date = get_field('date');
	?>
		
	<div class="article single__fundraising spacing">
		<div class="wrap wrap--content">

			<div class="article__header">
				<div class="grid">
					<div class="grid__item">
						<div class="article__main">
							<h1><?php echo $title; ?></h1>
							<div class="fundraising___details">
								<span>
									<?php if ( $location != '' ) { ?>
										<?php echo $location; ?>
									<?php } ?>
								</span>
								<span>
									<?php if ( $address != '' ) { ?>
										<?php echo $address; ?>
									<?php } ?>
								</span>
								<span>
									<?php if ( $date != '' ) { ?>
										<?php echo $date; ?>
									<?php } ?>
								</span>
							</div>
				        	<div class="wysiwyg">
				        		<?php the_content(); ?>
				        	</div>
						</div>
			        </div>
				</div>
			</div>			
		</div>
	</div>
	<?php endwhile; ?><?php endif; ?>
<?php get_footer(); ?>