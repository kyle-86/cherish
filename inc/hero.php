<?php if ( get_field( 'hide_slider' ) != 1 ) : ?>

<?php
	$hero_type = get_field('td_page_hero');
	$page_id   = get_the_ID();
	if(is_blog_page()) { // If is blog / category / single
		$page_id = get_option('page_for_posts');
	} elseif( $hero_type == 'parent') { // Else if using parent
		global $post;
		$parents = get_post_ancestors( $post->ID );
		$id      = ($parents) ? $parents[count($parents)-1]: $post->ID;
		$page_id = $id;
	}
?>

<?php $show_signup = get_field( 'show_signup' ); ?>	
<?php $signup_title = get_field( 'signup_title' ); ?>

<?php 
$slider_size =  get_field( 'slider_size' ); // large - small - slider 
$slider_type = ($slider_size == 'slider' ? 'slider' : 'slider_image');
?>
<?php if ( have_rows( $slider_type ) ) : ?>
<div class="hero hero--<?php echo $slider_size; ?> ">
    
	    <?php while ( have_rows( $slider_type ) ) :
				the_row();
				$image = get_sub_field( 'image' ); 
				$text_position = get_sub_field( 'text_position' );
				$text_position = ($text_position == 'topLeft' ? 'topLeft' : 'centerLeft'); ?>

	    	<div class="hero__bg hero__pos__<?php echo $text_position; ?>" style="background-image: url(<?php echo esc_attr( $image['url'] ); ?>);">
		    	<div class="wrap wrap--fluid">
			        <div class="hero__content">
			            <?php if ( $title = get_sub_field( 'title' ) ) : ?>
			            <h1>
			                <?php echo esc_html( $title ); ?>
			            </h1>
			            <?php endif; ?>
			            <?php if ( $content = get_sub_field( 'content' ) ) : ?>
			            <div class="hero__text">
			                <h2 class="regular"> <?php echo $content; ?> </h2>
			            </div>
			            <?php endif; ?>
			        </div>
			        <?php if ( $show_signup && $slider_type == 'slider' ) : ?>
			        <div class="hero__signup">
						<div class="hero__signup_text"> <?php echo $signup_title; ?> </div><div class="hero__signup_bar"> <?php gravity_form( 1, false, false, false, '', false ); ?> </div>
					</div>
					<?php endif; ?>
		        </div>
		    </div>
	    <?php endwhile; ?>
    
</div>
<?php endif; ?>
<?php endif; ?>