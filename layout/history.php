<?php $data = array(); ?>

	<?php if ( have_rows( 'historical_dates' ) ) : ?>
	<?php while ( have_rows( 'historical_dates' ) ) :
		the_row(); ?>
		
		<?php $date = get_sub_field( 'date' ) ?>
		<?php $content = get_sub_field( 'content' ) ?>

		<?php $data[] = array( 'date' => $date, 'content' => $content  ); ?>

	<?php endwhile; ?>
<?php endif; ?>


<script type="text/javascript">

	jQuery(document).ready(function(){

        	var events = <?php echo json_encode( $data ); ?>;

            jQuery('#my-roadmap').roadmap(events, {
                eventsPerSlide: 999999,
                slide: 1,
                orientation: 'vertical', 
                prevArrow: '<i class="fas fa-chevron-left"></i>',
                nextArrow: '<i class="fas fa-chevron-right"></i>',
                onBuild: function() {
                    console.log('onBuild event')
                }
            });
		});

</script>

<div id="my-roadmap"></div>