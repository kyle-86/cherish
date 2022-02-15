<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php do_action( 'wpo_wcpdf_before_document', $this->type, $this->order ); ?>

<table class="head container">
	<tr>
		<td class="header">
		<?php
		if( $this->has_header_logo() ) {
			$this->header_logo();
		} else {
			echo $this->get_title();
		}
		?>
		</td>
		<td class="shop-info">
			<?php do_action( 'wpo_wcpdf_before_shop_name', $this->type, $this->order ); ?>
			<div class="shop-name"><h3><?php $this->shop_name(); ?></h3></div>
			<?php do_action( 'wpo_wcpdf_after_shop_name', $this->type, $this->order ); ?>
			<?php do_action( 'wpo_wcpdf_before_shop_address', $this->type, $this->order ); ?>
			<div class="shop-address"><?php $this->shop_address(); ?></div>
			<?php do_action( 'wpo_wcpdf_after_shop_address', $this->type, $this->order ); ?>
			<div class="shop-abn">ABN: 79 253 351 418</div>
		</td>
	</tr>
</table>

<h1 class="document-type-label">
TAX INVOICE
</h1>

<?php do_action( 'wpo_wcpdf_after_document_label', $this->type, $this->order ); ?>

<table class="order-data-addresses">
	<tr>
		<td class="address billing-address">
			<!-- <h3><?php _e( 'Billing Address:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3> -->
			<?php do_action( 'wpo_wcpdf_before_billing_address', $this->type, $this->order ); ?>
			<?php $this->billing_address(); ?>
			<?php do_action( 'wpo_wcpdf_after_billing_address', $this->type, $this->order ); ?>
			<?php if ( isset($this->settings['display_email']) ) { ?>
			<div class="billing-email"><?php $this->billing_email(); ?></div>
			<?php } ?>
			<?php if ( isset($this->settings['display_phone']) ) { ?>
			<div class="billing-phone"><?php $this->billing_phone(); ?></div>
			<?php } ?>
		</td>
		<td class="address shipping-address">
			<?php if ( !empty($this->settings['display_shipping_address']) && ( $this->ships_to_different_address() || $this->settings['display_shipping_address'] == 'always' ) ) { ?>
			<h3><?php _e( 'Ship To:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
			<?php do_action( 'wpo_wcpdf_before_shipping_address', $this->type, $this->order ); ?>
			<?php $this->shipping_address(); ?>
			<?php do_action( 'wpo_wcpdf_after_shipping_address', $this->type, $this->order ); ?>
			<?php } ?>
		</td>
		<td class="order-data">
			<table>
				<?php do_action( 'wpo_wcpdf_before_order_data', $this->type, $this->order ); ?>
				<?php if ( isset($this->settings['display_number']) ) { ?>
				<tr class="invoice-number">
					<th><?php _e( 'Invoice Number:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->invoice_number(); ?></td>
				</tr>
				<?php } ?>
				<?php if ( isset($this->settings['display_date']) ) { ?>
				<tr class="invoice-date">
					<th><?php _e( 'Invoice Date:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->invoice_date(); ?></td>
				</tr>
				<?php } ?>
				<tr class="order-number">
					<th><?php _e( 'Order Number:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->order_number(); ?></td>
				</tr>
				<tr class="order-date">
					<th><?php _e( 'Order Date:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->order_date(); ?></td>
				</tr>
				<tr class="payment-method">
					<th><?php _e( 'Payment Method:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->payment_method(); ?></td>
				</tr>
				<?php do_action( 'wpo_wcpdf_after_order_data', $this->type, $this->order ); ?>
			</table>
		</td>
	</tr>
</table>

<?php do_action( 'wpo_wcpdf_before_order_details', $this->type, $this->order ); ?>

<table class="order-details">
	<thead>
		<tr>
			<th class="product"><?php _e('Product', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
			<th class="quantity"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
			<th class="price"><?php _e('Price', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $items = $this->get_order_items(); if( sizeof( $items ) > 0 ) : foreach( $items as $item_id => $item ) : ?>
		<?php 
			$product_id = $item['product_id'];
			$WooCommerceEventsDate                      = get_post_meta($product_id, 'WooCommerceEventsDate', true);
			$WooCommerceEventsHour                      = get_post_meta($product_id, 'WooCommerceEventsHour', true);
			$WooCommerceEventsPeriod                    = get_post_meta($product_id, 'WooCommerceEventsPeriod', true);
			$WooCommerceEventsMinutes                   = get_post_meta($product_id, 'WooCommerceEventsMinutes', true);
			$WooCommerceEventsHourEnd                   = get_post_meta($product_id, 'WooCommerceEventsHourEnd', true);
			$WooCommerceEventsMinutesEnd                = get_post_meta($product_id, 'WooCommerceEventsMinutesEnd', true);
			$WooCommerceEventsEndPeriod                 = get_post_meta($product_id, 'WooCommerceEventsEndPeriod', true);
			$WooCommerceEventsExpire                    = get_post_meta($product_id, 'WooCommerceEventsExpire', true);
			$WooCommerceEventsExpireMessage             = get_post_meta($product_id, 'WooCommerceEventsExpireMessage', true);
			$WooCommerceEventsTicketExpirationType      = get_post_meta($product_id, 'WooCommerceEventsTicketExpirationType', true);
			$WooCommerceEventsTicketsExpireSelect       = get_post_meta($product_id, 'WooCommerceEventsTicketsExpireSelect', true);
			$WooCommerceEventsTicketsExpireValue        = get_post_meta($product_id, 'WooCommerceEventsTicketsExpireValue', true);
			$WooCommerceEventsTicketsExpireUnit         = get_post_meta($product_id, 'WooCommerceEventsTicketsExpireUnit', true);
			$WooCommerceEventsTimeZone                  = get_post_meta($product_id, 'WooCommerceEventsTimeZone', true);
			$WooCommerceEventsLocation                  = get_post_meta($product_id, 'WooCommerceEventsLocation', true);
			if($WooCommerceEventsTimeZone) {			
				$timeZoneDate = new DateTime();
				$timeZoneDate->setTimeZone(new DateTimeZone($WooCommerceEventsTimeZone));
				$timeZone = $timeZoneDate->format('T');
			}
		?>
		<tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $this->type, $this->order, $item_id ); ?>">
			<td class="product">
				<?php $description_label = __( 'Description', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
				<span class="item-name"><?php echo $item['name']; ?></span>				
				<?php do_action( 'wpo_wcpdf_before_item_meta', $this->type, $item, $this->order  ); ?>
				<span class="item-meta"><?php echo $item['meta']; ?></span>
				<dl class="meta">
					<?php $description_label = __( 'SKU', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
					<?php if( !empty( $item['sku'] ) ) : ?><dt class="sku"><?php _e( 'SKU:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="sku"><?php echo $item['sku']; ?></dd><?php endif; ?>
					<?php if( !empty( $item['weight'] ) ) : ?><dt class="weight"><?php _e( 'Weight:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="weight"><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif; ?>
					<?php if( !empty($WooCommerceEventsDate)): ?>
						<dt>Date: </dt>
						<dd><?php echo $WooCommerceEventsDate; ?></dd>
					<?php endif; ?>
					<?php if( !empty($WooCommerceEventsTimeZone)): ?>
						<dt>Start Time: </dt>
						<dd><?php echo $WooCommerceEventsHour . ':' . $WooCommerceEventsMinutes . $WooCommerceEventsPeriod . ' ' . $timeZone; ?></dd>
					<?php endif; ?>
					<?php if( !empty($WooCommerceEventsTimeZone)): ?>
						<dt>End Time: </dt>
						<dd><?php echo $WooCommerceEventsHourEnd . ':' . $WooCommerceEventsMinutesEnd . $WooCommerceEventsPeriodEnd . ' ' . $timeZone; ?></dd>
					<?php endif; ?>
					<?php if( !empty($WooCommerceEventsLocation)): ?>
						<dt>Venue: </dt>
						<dd><?php echo $WooCommerceEventsLocation; ?></dd>
					<?php endif; ?>
				</dl>
				<?php do_action( 'wpo_wcpdf_after_item_meta', $this->type, $item, $this->order  ); ?>
			</td>
			<td class="quantity"><?php echo $item['quantity']; ?></td>
			<td class="price"><?php echo $item['order_price']; ?></td>
		</tr>
		<?php endforeach; endif; ?>
	</tbody>
	<tfoot>
		<tr class="no-borders">
			<td class="no-borders">
				<div class="document-notes">
					<?php do_action( 'wpo_wcpdf_before_document_notes', $this->type, $this->order ); ?>
					<?php if ( $this->get_document_notes() ) : ?>
						<h3><?php _e( 'Notes', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
						<?php $this->document_notes(); ?>
					<?php endif; ?>
					<?php do_action( 'wpo_wcpdf_after_document_notes', $this->type, $this->order ); ?>
				</div>
				<div class="customer-notes">
					<?php do_action( 'wpo_wcpdf_before_customer_notes', $this->type, $this->order ); ?>
					<?php if ( $this->get_shipping_notes() ) : ?>
						<h3><?php _e( 'Customer Notes', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
						<?php $this->shipping_notes(); ?>
					<?php endif; ?>
					<?php do_action( 'wpo_wcpdf_after_customer_notes', $this->type, $this->order ); ?>
				</div>
			</td>
			<td class="no-borders" colspan="2">
				<table class="totals">
					<tfoot>
						<?php foreach( $this->get_woocommerce_totals() as $key => $total ) : ?>
						<tr class="<?php echo $key; ?>">
							<td class="no-borders"></td>
							<th class="description"><?php echo $total['label']; ?></th>
							<td class="price"><span class="totals-price"><?php echo $total['value']; ?></span></td>
						</tr>
						<?php endforeach; ?>
					</tfoot>
				</table>
			</td>
		</tr>
	</tfoot>
</table>



	<?php
	$foo_order_id = $order->get_id();
	$args = array(
	    'posts_per_page'  => 50,
	    'post_type' => array( 'event_magic_tickets' ),
	    'meta_query' => array(
	        array(
	            'key' => 'WooCommerceEventsOrderID',
	            'value' => $foo_order_id,
	            'compare' => '==',
	        ),
	    ),
	);
	global $post;
	$the_query = new WP_Query( $args );
	if ( $the_query->have_posts() ) {
		echo '<h3 class="ticket-title">Attendee Details</h3>';
	    while ( $the_query->have_posts() ) {
	        $the_query->the_post();
	        echo '<div class="ticket">';
	        	echo '<p>';
		        echo '<strong>Ticket: '.get_the_title().'</strong><br>';
		        echo ''.get_post_meta($post->ID, 'WooCommerceEventsProductName', true).'<br>';
		        echo ''.get_post_meta($post->ID, 'WooCommerceEventsAttendeeName', true).' '.get_post_meta($post->ID, 'WooCommerceEventsAttendeeLastName', true).'<br>';
		        echo ''.get_post_meta($post->ID, 'WooCommerceEventsPurchaserEmail', true).'<br>';
		        echo ''.get_post_meta($post->ID, 'WooCommerceEventsAttendeeTelephone', true).'<br>';
		        echo ''.get_post_meta($post->ID, 'WooCommerceEventsAttendeeCompany', true).'<br>';
		        echo ''.get_post_meta($post->ID, 'WooCommerceEventsAttendeeDesignation', true).'';
		        echo '</p>';
	        echo '</div>';
	    }
	}
	wp_reset_query();
	?>


<div class="bottom-spacer"></div>

<?php do_action( 'wpo_wcpdf_after_order_details', $this->type, $this->order ); ?>

<?php if ( $this->get_footer() ): ?>
	<div id="footer">
		<?php $this->footer(); ?>
	</div><!-- #letter-footer -->
<?php endif; ?>
<?php do_action( 'wpo_wcpdf_after_document', $this->type, $this->order ); ?>
