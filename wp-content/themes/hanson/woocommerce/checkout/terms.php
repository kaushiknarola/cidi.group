<?php
/**
 * Checkout terms and conditions checkbox
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.5.0
 */
if ( ! defined( 'ABSPATH' ) ) {
   exit;
}

if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) : ?>
   <?php do_action( 'woocommerce_checkout_before_terms_and_conditions' ); ?>
    <?php do_action( 'woocommerce_checkout_after_terms_and_conditions' ); ?>
<?php endif; ?>