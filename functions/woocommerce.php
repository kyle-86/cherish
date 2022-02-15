<?php

/*------------------------------------*\
    $WOOCOMMERCE
\*------------------------------------*/

add_theme_support( 'woocommerce' );

/* DISABLE STYLES */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/* DISABLE BREADCRUMBS */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

/* HIDE ADD TO CART BUTTON */
add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1 );

/* HIDE ORDERING */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_action( 'after_setup_theme', 'my_remove_product_result_count', 99 );
function my_remove_product_result_count() { 
    remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );
}

function remove_add_to_cart_buttons() {
  if( is_product_category() || is_shop()) { 
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
  }
}

/* Add Text after Price */

function cw_change_product_price_display( $price ) {
    //$price .= ' inc GST';
    return $price;
}
add_filter( 'woocommerce_get_price_html', 'cw_change_product_price_display' );
add_filter( 'woocommerce_cart_item_price', 'cw_change_product_price_display' );


/**
* Remove related products output on product page
*/
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action('woocommerce_single_product_summary','woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta', 40);
remove_action('woocommerce_after_single_product_summary','woocommerce_output_product_data_tabs', 10);
add_action('woocommerce_single_product_summary','woocommerce_output_product_data_tabs', 15);
add_action('woocommerce_title_block','woocommerce_template_single_title', 5);


// Woocommerce - Products per page on shop
    add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );
    function new_loop_shop_per_page( $cols ) {
        $cols = 9;
        return $cols;
    }

/*------------------------------------*\
    $LOAD GALLERY
\*------------------------------------*/

// add_theme_support( 'wc-product-gallery-zoom' );
// add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

/*------------------------------------*\
    $WRAPPER
\*------------------------------------*/

// Unhook default

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Add custom

add_action('woocommerce_before_main_content', 'td_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'td_wrapper_end', 10);

function td_wrapper_start() {
    echo '<div class="wrap wrap--fluid wrap--woocommerce">';
}

function td_wrapper_end() {
    echo '</div>';
}

//Update CART on the FLYYY!
add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');
function wc_refresh_mini_cart_count($fragments){
    ob_start();
    $items_count = WC()->cart->get_cart_contents_count();
    ?>
    <div id="mini-cart-count"><?php echo $items_count ? $items_count : '&nbsp;'; ?></div>
    <?php
        $fragments['#mini-cart-count'] = ob_get_clean();
    return $fragments;
}