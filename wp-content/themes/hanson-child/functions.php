<?php
/**
 * Add CSS and JS into front-end
 * @author KK
 */
add_action('wp_enqueue_scripts','hanson_child_enqueue_styles');
function hanson_child_enqueue_styles() {
	wp_enqueue_style( 'hanson-parent-style', get_template_directory_uri() . '/style.css', 1000 );
	wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/assets/js/custom.js', array('jquery'), '', true);
}

/**
 * Load API Zoho
 */

//require_once get_stylesheet_directory_uri() . '/assets/apiZoho.php';
$inc_dir = dirname( __FILE__ ) . '/assets/';
require_once $inc_dir . 'apiZoho.php';
/**
 * Add random values after CSS and JS added files
 * @author KK
 */
function remove_cssjs_ver( $src ) { 
	if( strpos( $src, 'style.css?ver=' ) || strpos( $src, 'custom.js?ver=' ) ){
		$src = $src.rand(0,999);
	}
	return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 1000 ); 
add_filter( 'script_loader_src', 'remove_cssjs_ver', 1000 );

/**
 * Allow only single product into cart.
 * @author KK
 * @return Custom message for user.
 */
add_filter('woocommerce_add_to_cart_validation','wc_limit_one_per_order',10,2);
function wc_limit_one_per_order( $passed_validation, $product_id ) {
	if ( WC()->cart->get_cart_contents_count() >= 1 ) {
		wc_add_notice( __( 'This product cannot be purchased with other products. Please, empty your cart first and then add it again. <a href="/checkout" class="button">Empty Cart</a>', 'woocommerce' ), 'error' );
		return false;
	} else {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		unset($_SESSION['cidi_bike_val']);
		if( $_POST['variation_id'] == '3351' ){
			$_SESSION['cidi_bike_val'] = $_POST['cidi_bike_val'];
		}
	}
	return $passed_validation;
}

/**
 * Change Product Price into Cart/Checkout page if user select custom bike option.
 * @author KK
 * @return Custom message for user.
 */
add_action('woocommerce_before_calculate_totals','cidi_woocommerce_before_calculate_totals',20);
function cidi_woocommerce_before_calculate_totals( $cart ) {
	foreach ( $cart->get_cart() as $cart_item ) {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$additionalPrice = (int)$_SESSION['cidi_bike_val'];
		if( isset($_SESSION['cidi_bike_val']) && $additionalPrice != 0 ){
			$cart_item['data']->set_price( $additionalPrice );
		}
	}
}

/**
 * Woo Commerce Customize My Account page left side bar options
 * @author KK
 * @return items list array
 */
add_filter('woocommerce_account_menu_items','cidi_woocommerce_account_menu_items_function');
function cidi_woocommerce_account_menu_items_function( $items ) {
	$items = array(
		'dashboard' => __( 'My Dashboard', 'woocommerce' ),
		'orders' => __( 'Legal', 'woocommerce' ),
		'news-feed' => __( 'News Feed', 'cidi' ),
		'edit-account' => __( 'User Details', 'woocommerce' ),
		'edit-address' => __( 'Addresses', 'woocommerce' ),
		'payment-methods' => __( 'Payment Methods', 'woocommerce' ),
		//'downloads' => __( 'Downloads', 'woocommerce' ),
		'customer-logout' => __( 'Logout', 'woocommerce' ),
	);
	return $items;
}

/**
 * Woo Commerce add new endpoint for News Feed.
 * @author KK
 */
add_action('init','cidi_add_my_account_endpoint');
function cidi_add_my_account_endpoint() {
	add_rewrite_endpoint( 'news-feed', EP_PAGES );
}

/**
 * Woo Commerce My Account Page Display News Feed ( Blogs )
 * @author KK
 * @return Display News Feed on My Account -> News Feed page
 */
add_action('woocommerce_account_news-feed_endpoint','cidi_news_feed_endpoint_content');
function cidi_news_feed_endpoint_content() {
	echo '<div class="cap-title">Your Newsfeed</div><br />';
	$args = array(
		'type' => 'post',
		'parent' => 0,
		'hide_empty' => true
	);
?>
	<ul class="nav nav-tabs theme-tabs" role="tablist">
	<?php
		foreach (get_categories($args) as $key => $value) {
	?>
			<li role="presentation" class="<?php if($key == 0) echo 'active'; ?>"><a href="#<?php echo $value->slug; ?>" aria-controls="<?php echo $value->slug; ?>" role="tab" data-toggle="tab"><?php echo $value->name; ?></a></li>
	<?php
		}
	?>
	</ul>

	<div class="tab-content">
	<?php
		foreach (get_categories($args) as $key => $value) {
	?>
		<div role="tabpanel" class="tab-pane <?php if($key == 0) echo 'active'; ?>" id="<?php echo $value->slug; ?>">
			<?php
				$query = new WP_Query( array(
					'cat' => $value->cat_ID,
					'posts_per_page' => -1,
					'orderby' => 'date',
					'order' => 'DESC'
				) );
				if($query->have_posts()){
					while ($query->have_posts()) {
						$query->the_post();
					?>
						<div class="news_feed_list">
							<div class="news_feed_img">
								<?php echo '<img src="'.get_the_post_thumbnail_url(get_the_ID(),'thumbnail').'" alt="img" />'; ?>
							</div>
							<span class="news_feed_title">
								<a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
							</span>
						</div>
					<?php
					}
				}
				wp_reset_postdata();
			?>
		</div>
	<?php
		}
	?>
	</div>
<?php
}

/**
 * Woo Commerce My Account -> Order ( Legal )
 * @author KK
 * @return Display Title on Legal / Order Page
 */
add_filter('woocommerce_before_account_orders','cidi_woocommerce_before_account_orders_function');
function cidi_woocommerce_before_account_orders_function() {
	echo '<div class="cap-title">Your Legal Documents</div><br />';
}

/**
 * Woo Commerce My Account -> Address
 * @author KK
 * @return Display Title on Address Page.
 */
add_filter('woocommerce_before_edit_account_address_form','cidi_woocommerce_before_edit_account_address_form_function');
function cidi_woocommerce_before_edit_account_address_form_function() {
	echo '<div class="cap-title">Your Addresses</div><br />';
}

/**
 * Woo Commerce My Account -> User Details
 * @author KK
 * @return Display Title on User Details Page.
 */
add_filter('woocommerce_before_edit_account_form','cidi_woocommerce_before_edit_account_form_function');
function cidi_woocommerce_before_edit_account_form_function() {
	echo '<div class="cap-title">Your Details</div>';
}

/**
 * Woo Commerce My Account -> Payment Methods
 * @author KK
 * @return Display Title on Payment Methods Page.
 */
add_filter('woocommerce_before_account_payment_methods','cidi_woocommerce_before_account_payment_methods_function');
function cidi_woocommerce_before_account_payment_methods_function() {
	echo '<div class="cap-title">Your Payment Methods</div><br />';
}

/**
 * Woo Commerce My Account -> Legal / Order - Add column at last.
 * @author KK
 * @return Add column into Order Table.
 */
add_filter('woocommerce_my_account_my_orders_columns','cidi_wc_add_my_account_orders_column');
function cidi_wc_add_my_account_orders_column( $columns ) {
	$new_columns = array();
	foreach ( $columns as $key => $name ) {
		$new_columns[ $key ] = $name;
		if ( 'order-actions' === $key ) {
			$new_columns['order-cos'] = __( 'Conditions of Sale', 'cidi' );
		}
	}
	return $new_columns;
}

/**
 * Woo Commerce My Account -> Legal / Order - Add column at last.
 * @author KK
 * @return Button for download PDF file of each order contract.
 */
add_action('woocommerce_my_account_my_orders_column_order-cos','cidi_wc_my_orders_ship_to_column');
function cidi_wc_my_orders_ship_to_column( $order ) {
	$order_items = $order->get_items();
	foreach ($order_items as $item_id => $item_data) {
		$duration = $order->get_item_meta($item_id, 'duration', true);
		$interest = $order->get_item_meta($item_id, 'interest_rate', true);
	}
	echo '<a href="'.get_stylesheet_directory_uri().'/mpdf/sales.php?order_id='.$order->get_id().'&duration='.$duration.'&interest='.$interest.'" class="woocommerce-button button cos"><i class="fa fa-download"></i></a>';
}