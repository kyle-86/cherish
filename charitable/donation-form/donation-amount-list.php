<?php
/**
 * The template used to display the donation amount inputs.
 *
 * Override this template by copying it to yourtheme/charitable/donation-form/donation-amount-list.php
 *
 * @author  Studio 164a
 * @package Charitable/Templates/Donation Form
 * @since   1.5.0
 * @version 1.6.44
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! array_key_exists( 'form_id', $view_args ) || ! array_key_exists( 'campaign', $view_args ) ) {
	return;
}

/* @var Charitable_Campaign */
$campaign      = $view_args['campaign'];
$form_id       = $view_args['form_id'];
$suggested     = $campaign->get_suggested_donations();
$custom        = $campaign->get( 'allow_custom_donations' );
$amount        = $campaign->get_donation_amount_in_session();
$active_period = 'once' == $campaign->get_initial_donation_period() || in_array( $campaign->get( 'recurring_donation_mode' ), array( 'variable', 'simple' ) );

if ( 0 == $amount ) {
	$amount = $campaign->get_default_donation_amount();
}

if ( empty( $suggested ) && ! $custom ) {
	return;
}

if ( count( $suggested ) ) :

	$amount_is_suggestion = false;
	?>
	<ul class="donations__amount">
		<?php
		foreach ( $suggested as $suggestion ) :
			$checked  = $active_period ? checked( $suggestion['amount'], $amount, false ) : '';
			$field_id = esc_attr(
				sprintf(
					'form-%s-field-%s',
					$form_id,
					$suggestion['amount']
				)
			);

			if ( strlen( $checked ) ) :
				$amount_is_suggestion = true;
			endif;
			?>
			<li class="each__donation donations__thirds donation-amount suggested-donation-amount <?php echo strlen( $checked ) ? 'selected' : ''; ?>">
				<h5>A CASH DONATION OF</h5>
				<label for="<?php echo $field_id; ?>">
					<input
						id="<?php echo $field_id; ?>"
						type="radio"
						name="donation_amount"
						value="<?php echo esc_attr( charitable_get_currency_helper()->sanitize_database_amount( $suggestion['amount'] ) ); ?>" <?php echo $checked; ?>
					/>
					<div class="donations__amount-amount h1">
					<?php
						printf(
							'<span class="amount">%s</span> <span class="description">%s</span>',
							charitable_format_money( $suggestion['amount'], false, true ),
							isset( $suggestion['description'] ) ? $suggestion['description'] : ''
						);
					?>
					</div>
					<div class="donations__amount-button">
						<a class="button button--alt" href="#" data-donation="<?php printf('%s',charitable_format_money( $suggestion['amount'], false, true ),isset( $suggestion['description'] ) ? $suggestion['description'] : ''); ?>" target="_self">Give Now</a>
					</div>
				</label>
			</li>
			<?php
		endforeach; ?>
	</ul>
		</div><!-- #custom-donation-amount-field -->

		<?php if ( $custom ) :
			$has_custom_donation_amount = $active_period && ( ! $amount_is_suggestion && $amount );
			?>
			
		<?php endif ?>
	<!-- .donation-amounts -->
<?php elseif ( $custom ) : ?>
	<div id="custom-donation-amount-field" class="charitable-form-field charitable-custom-donation-field-alone">
		<input
			type="text"
			class="custom-donation-input"
			name="custom_donation_amount"
			placeholder="<?php esc_attr_e( 'Enter donation amount', 'charitable' ); ?>"
			value="<?php echo $amount ? esc_attr( $amount ) : ''; ?>"
		/>
	
<?php endif ?>
