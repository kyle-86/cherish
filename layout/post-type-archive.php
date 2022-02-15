<div class="post_archive">
	<?php $content = get_sub_field('content'); ?>
	<?php
		$post_type = get_sub_field_object('post_type');
		$post_type_value = $post_type['value']; //our_team - people_we_cherish
		$post_type_label = $post_type['choices'][ $value ];
	?>
	<?php 
		$args = array(  
        'post_type' => $post_type_value,
        'post_status' => 'publish',
        'posts_per_page' => -1, 
    ); ?>
    

	<?php if ($content != '') { ?>
	<div class="post_archive-title">
		<div class="wrap wrap--content">
	    	<div class="post_archive-content wysiwyg">
	    		<?php echo $content; ?>
			</div>
		</div>
	</div>
	<?php } ?>

	<div class="post_archive-info">
		<div class="wrap wrap--fluid">
	    	<div class="grid">
		    	<?php 
				// the query
				$the_query = new WP_Query( $args ); ?>
				 
				<?php if ( $the_query->have_posts() ) : ?>
				 
				    <!-- pagination here -->
				 
				    <!-- the loop -->
				    <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				    	<?php 
				    		$title = get_the_title();
					    	$image = get_field('image');
					    	$quick_content = get_field('hover_content');
					    	$size = 'medium';
	    					$thumb = $image['sizes'][ $size ];
				  		?>
				    	<div class="grid__item grid__item--half">
				    		<div class="post_archive-person">
				    			<a href="<?php the_permalink(); ?>" class="aBlock2">
					    			<div class="post_archive-frame">
							    		<div class="post_archive-image" style="background-image:url(<?php echo esc_url($thumb); ?>)"></div>
								    </div>
								    <div class="post_archive-text">
								    	<h3><?php echo $title; ?></h3>
								    	<div class="post_archive-text-text">
								    		<?php echo $quick_content; ?>
								    	</div>
								    	<div class="post_archive-text-story">
								    		<?php if ( $post_type_value == 'people_we_cherish' ) { ?>
									    		<a href="<?php the_permalink(); ?>"> <?php echo $title; ?> Story  </a>
									    	<?php } ?>
									    	<?php if ( $post_type_value == 'our_team' ) { ?>
									    		<a href="<?php the_permalink(); ?>"> View Profile  </a>
									    	<?php } ?>
								    	</div>
								    </div>
							    </a>
							</div>
				        </div>
				    <?php endwhile; ?>
				    <!-- end of the loop -->
				 
				    <!-- pagination here -->
				 
				    <?php wp_reset_postdata(); ?>
				<?php endif; ?>
	    	</div>
    	</div>
	</div>
</div>