<?php
/**
 * This example shows how to remove fields from the donation form.
 *
 * Note that this approach requires Charitable 1.6 or above. If you are
 * on a previous version of Charitable, see the link below for a legacy
 * way of doing the same thing:
 *
 * @see https://github.com/Charitable/library/blob/master/donation-form/legacy/remove-donation-form-fields.php
 */
add_action(
    'init',
    function() {
        $fields_api = charitable()->donation_fields();
        

        /**
         * In this example, we remove the last name field. But you can
         * easily modify this example to remove any other fields by swapping
         * 'last_name' for the key of the field you would like to remove.
         *
         * first_name
         * last_name
         * email
         * address
         * address_2
         * city
         * state
         * postcode
         * country
         * phone
		 * anonymous_donation - If using Anonymous Donations.
		 * donor_comment - If using Donor Comments.
         */
        $fields_api->get_field( 'address_2' )->set( 'donation_form', '', false );
        $fields_api->get_field( 'city' )->set( 'donation_form', '', false );
        $fields_api->get_field( 'state' )->set( 'donation_form', '', false );
        $fields_api->get_field( 'postcode' )->set( 'donation_form', '', false );
        $fields_api->get_field( 'country' )->set( 'donation_form', '', false );

        $fields_api->get_field( 'address' )->set( 'donation_form', 'priority', 23 );
    }
);

function ed_charitable_disable_recurring_donation_periods( $periods ) {
    unset(
        $periods['week'],
        $periods['quarter'],
        $periods['semiannual']
    );
    return $periods;
}

add_filter( 'charitable_recurring_periods', 'ed_charitable_disable_recurring_donation_periods' );
add_filter( 'charitable_recurring_period_strings', 'ed_charitable_disable_recurring_donation_periods' );
add_filter( 'charitable_recurring_periods_adverbs', 'ed_charitable_disable_recurring_donation_periods' );

add_filter(
    'charitable_recurring_periods',
    function( $periods, $number ) {
        $periods['once'] = sprintf( _n( 'once', '%s once', $number, 'ed-custom-code' ), $number );
        $periods['year'] = sprintf( _n( 'year', '%s year', $number, 'ed-custom-code' ), $number );
        return $periods;
    },
    10,
    2
);

add_filter(
    'charitable_recurring_periods_adverbs',
    function( $adverbs ) {
        $adverbs['once'] = __( 'Once', 'ed-custom-code' );
        $adverbs['year'] = __( 'Yearly', 'ed-custom-code' );
        return $adverbs;
    }
);