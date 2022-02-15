<?php // Not used anymore ?>
<div class="facet-controls">
	<div class="facets-wrap">
		<?php echo facetwp_display( 'facet', 'shop_categories' ); ?>
		<?php echo facetwp_display( 'facet', 'search_shop' ); ?>
	</div>
	<button class="button" onclick="FWP.reset()">Reset</button>
</div>
<div class="shop">
	<?php
	// Vars
		$pageid = get_the_ID();
		$posttype = 'products';
		$taxonomy = 'product_cat';
	// Vars from Fields
		$postperpage = get_sub_field('posts_per_page', $pageid);
		$order = get_sub_field('order', $pageid);
		$orderby = get_sub_field('order_by', $pageid);
		$term = get_sub_field('term', $pageid);
	// Loop
		$shopLoop = new WP_Query(
			array(
			'post_type' => $posttype,
		    'orderby' => $orderby,
		    'order' => $order,
		    'facetwp' => true,
		    'posts_per_page' => $postperpage,
		   	'tax_query' => array(
	        	array(
	                'taxonomy' => $taxonomy,
	                'field' => 'slug',
	                'terms' => $term,
	            ),
	        ),
		    'paged' => get_query_var('paged') ? get_query_var('paged') : 1 )
		  );
		if ($shopLoop->have_posts()) : while ($shopLoop->have_posts()) : $shopLoop->the_post();
	?>
	<div class="layout woo-content">
		<div class="layout--page-title">
			<h1 class="heading--three heading--three--grey-left"><?php the_title();?></h1>
		</div>
		<?php the_post(); ?>
		<?php wc_get_template_part( 'content', 'single-product' ); ?>
	</div>
	<?php endwhile; endif; wp_reset_postdata(); ?>
</div>
