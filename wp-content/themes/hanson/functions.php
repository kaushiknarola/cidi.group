<?php
/**
 * Setup Theme
 */
require_once get_template_directory() . '/inc/main/theme-setup.php';

/**
 * Register Styles and Scripts
 */
require_once get_template_directory() . '/inc/main/reg-scripts.php';

/**
 * Register Widget areas
 */
require_once get_template_directory() . '/inc/main/reg-widget.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Register Custom Navigation Walker
 */
require get_template_directory() . '/inc/wp_bootstrap_navwalker.php';

/**
 * Register Custom Navigation Walker
 */
require get_template_directory() . '/inc/main/breadcrumbs.php';
/**
 * Styles from customizer
 */
require get_template_directory() . '/inc/main/hanson-styles.php';

/**
 * Load hanson Functions.
 */
require get_template_directory() . '/inc/main/hanson-functions.php';

/**
 * Add hansonbiz Plugins.
 */
require get_template_directory() . '/inc/hanson_add_plugin.php';

require get_template_directory() . '/inc/ocdi/one-click-demo-import.php';
if( class_exists( 'OCDI_Plugin' ) ) {
	require get_template_directory() . '/inc/demo-import.php';
}
/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
function appsero_init_tracker_hanson_multipurpose_wordpress_theme() {

    if ( ! class_exists( 'AppSero\Insights' ) ) {
        require_once __DIR__ . '/inc/insights.php';
    }

    $insights = new AppSero\Insights( '82ea8a2a-4af4-4bcd-90f3-e8f7b2d53b95', 'Hanson - Multipurpose WordPress Theme', __FILE__ );
    $insights->init_theme();
}

add_action( 'init', 'appsero_init_tracker_hanson_multipurpose_wordpress_theme' );


/*function woo_redirect_to_checkout() {
	$checkout_url = WC()->cart->get_checkout_url();
	return $checkout_url;
}
add_filter ('woocommerce_add_to_cart_redirect', 'woo_redirect_to_checkout');*/

/* For removing the your order section from the checking order review */
remove_action( 'woocommerce_checkout_order_review', 'woocommerce_your_order', 20 );


/* adding only payment section inside the billing part */
add_action( 'woocommerce_checkout_billing', 'woocommerce_checkout_payment', 20 );  



//add_action('woocommerce_review_order_before_payment', 'zn_kc_move_terms_and_conditions', 90);
add_action('woocommerce_checkout_after_order_review', 'zn_kc_move_terms_and_conditions', 90);
function zn_kc_move_terms_and_conditions()
{
   ?>
   <p class="form-row terms wc-terms-and-conditions">
      <input type="checkbox" class="input-checkbox" name="terms" <?php checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ); ?> id="terms" />
      <label for="terms" class="checkbox"><?php printf( __( 'Agree to our <a href="%s" target="_blank">Condition of Sale</a>', 'woocommerce' ), esc_url( get_permalink( 'legal-area' ) ) ); ?> <span class="required">*</span></label>
      <input type="hidden" name="terms-field" value="1" />
   </p>
   <?php
}


 
function custom_override_checkout_fields( $fields ) {
  

  
    unset($fields['billing']['billing_address_1']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_city']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_country']);
    unset($fields['billing']['billing_state']);
    unset($fields['billing']['billing_phone']);
    unset($fields['order']['order_comments']);
    unset($fields['billing']['billing_address_2']);
    unset($fields['billing']['billing_postcode']);
    unset($fields['billing']['billing_city']);
    $fields['billing']['billing_first_name']['priority']=0; 
    $fields['billing']['billing_last_name']['priority']=1; 
    $fields['billing']['billing_email']['priority']=2;
    $fields['billing']['billing_company']['priority']=3;  
    return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );

/**
 * Changes the redirect URL for the Return To Shop button in the cart.
 *
 * @return string
 */
function wc_empty_cart_redirect_url() {
    return '/product/cidi-bike/';
}
add_filter( 'woocommerce_return_to_shop_redirect', 'wc_empty_cart_redirect_url' );

add_filter( 'gettext', 'change_woocommerce_return_to_shop_text', 20, 3 );

function change_woocommerce_return_to_shop_text( $translated_text, $text, $domain ) {
       switch ( $translated_text ) {
                      case 'Return to shop' :
   $translated_text = __( 'Return to Product', 'woocommerce' );
   break;
  }
 return $translated_text; 

}
/* for removing the notification of add to cart in checkout page */
add_filter( 'wc_add_to_cart_message_html', '__return_null' );



add_action('woocommerce_single_product_summary', 'hooks_open_div', 20);
function hooks_open_div() {
    echo '<br /><div id="dvPrice">';
}

add_action('woocommerce_single_product_summary', 'hooks_close_div', 30);
function hooks_close_div() {
    echo '</div>';
}
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );