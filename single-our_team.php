<?php get_header(); ?>
	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

		<?php 
    		$title = get_the_title();
	    	$image = get_field('image');
	    	$quick_content = get_field('hover_content');
	    	$size = 'medium';
			$thumb = $image['sizes'][ $size ];

			$post_type = get_post_type( get_the_ID() );

			$post_type_obj = get_post_type_object( $post_type );
			// echo $post_type_obj->labels->singular_name; //Ice Cream.
			// echo $post_type_obj->labels->name; //Ice Creams.

			$gallery = get_field( 'gallery' );

		?>
		
	<div class="article single__people_we_cherish post_archive">
		<div class="wrap wrap--<?php echo ($gallery != false) ? 'fluid' : 'content'; ?>">

			<div class="back__to"><a href="<?php echo bloginfo('url'); ?>/people-we-cherish/"><i class="fas fa-angle-left"></i> Back to <?php echo $post_type_obj->labels->singular_name; ?> </a></div>

			<div class="article__header">
				<div class="grid">
					<div class="grid__item <?php echo ($gallery != false) ? 'grid__item--half' : ''; ?>">
			    		<div class="post_archive-person">
			    			<div class="post_archive-image">
					    		<div class="post_archive-image" style="background-image:url(<?php echo esc_url($thumb); ?>)"></div>
						    </div>
						    <div class="post_archive-text">
						    	<h1 class="h2"><?php echo $title; ?></h1>
						    	<div class="post_archive-text-text text--large-body">
						    		<?php echo $quick_content; ?>
					    		</div>
						    </div>
						</div>
						<div class="article__main">
							<?php if ( get_field('td_page_post') && !post_password_required() ) : ?>
					        	<?php echo get_field('td_post_content'); ?>
					        <?php else: ?>
					        	<div class="wysiwyg">
					        		<?php the_content(); ?>
					        	</div>
					        <?php endif; ?>
						</div>
			        </div>

			        <?php
						if ( $gallery ) : ?>
				        <div class="grid__item grid__item--half">
				        	<div class="single__people-side">
				        		
									<?php $galleryCount = 0; ?>
									<?php foreach( $gallery as $image ) : ?>
											<div class="eachImage">
												<img src="<?php echo esc_url( $image['sizes']['large'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>"/>
												<?php if ( $image['caption'] != '' ) { ?>
													<div class="image-caption text--small-body"> <?php echo $image['caption']; ?> </div>
												<?php } ?>
											</div>								
										<?php $galleryCount++; ?>
									<?php endforeach; ?>
								
				        	</div>
				        </div>
			        <?php endif; ?>
				</div>
			</div>			
		</div>
	</div>
	<?php endwhile; ?><?php endif; ?>
<?php get_footer(); ?>