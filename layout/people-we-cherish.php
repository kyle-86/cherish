<div class="cherish__blocks">
	<?php $title_text = get_sub_field('title_text'); ?>
	<?php $blockCount = 26; ?>
	<?php 
		$args = array(  
        'post_type' => 'people_we_cherish',
        'post_status' => 'publish',
        'posts_per_page' => 18, 
        'orderby' => 'rand', 
    ); ?>
    <?php $cherished_people = get_posts( $args ); ?>
    <?php $peopleSquares = array("1", "2", "4", "5", "7", "8", "10", "11", "13", "16", "19", "21", "25"); ?>
    <?php $darkBlueSquares = array("9","15","17","23"); ?> 
    <?php // echo $cherished_people[0]->ID; ?>
    <div class="grid">
    <?php 
    	$x = 1;
    	$personCount = 0;
    	while($x <= $blockCount) { ?>
		  <div class="grid__item grid__item--seventh <?php if ($x == 3) { echo 'grid__item_three'; } ?>">

		  	<?php if ( in_array($x, $peopleSquares) ) { ?>
		  		<?php 
		  		$cherish_person_id = $cherished_people[$personCount]->ID;
		  		
		  		$attachment_id = get_field('image', $cherished_people[$personCount]->ID);
		  		$postImg = $attachment_id['sizes']['medium']; 

		  		$personTitle = $cherished_people[$personCount]->post_title;
		  		if ( get_field('hover_title', $cherished_people[$personCount]->ID) ) {
		  			$personTitle = get_field('hover_title', $cherished_people[$personCount]->ID);
		  		}
		  		$personText = get_field('hover_content', $cherished_people[$personCount]->ID);
		  		$personURL = get_permalink( $cherish_person_id );

		  		$personCount++;
		  		?>
		  	<?php } ?>

		  	<div class="cherished__square <?php if ( in_array($x, $darkBlueSquares) ) { echo 'cherished__square-dark'; } ?> <?php if ( in_array($x, $peopleSquares) ) { echo 'cherished__square-person'; } ?>" style="<?php if ( in_array($x, $peopleSquares) ) { echo 'background-image: url('.$postImg.')'; } ?>">
		  		<?php if ($x == 3) { ?> 
		  			<div class="cherish_title_text"> 
		  				<h2><?php echo $title_text; ?></h2>
		  			</div>
		  		<?php } ?>
		  		<?php if ( in_array($x, $peopleSquares) ) { ?>
		  			<div class="cherish__person">
		  				<div class="cherish__person-title"> <h4> <?php echo $personTitle; ?> </h4> </div>
		  				<?php if ( $personText != '') { ?>
			  				<div class="cherish__person-content">  <?php echo wp_trim_words( $personText, 10, '...' ); ?> </div>
			  			<?php } ?>
			  			<a class="aBlock" href="<?php echo $personURL; ?>"> </a>
		  			</div>
		  		<?php } ?>
		 	</div>
		  </div>
		  <?php 
		  $x++;
		}
	?>
    </div>
</div>