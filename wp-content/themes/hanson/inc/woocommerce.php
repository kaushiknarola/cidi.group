<?php
function hanson_woocommerce_setup() {
	add_theme_support( 'woocommerce', array(
		'product_grid' => array(
			'default_rows' => 1,
			'default_columns' => 4,
		)
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'hanson_woocommerce_setup' );

function hanson_woocommerce_scripts() {
	wp_enqueue_style( 'hanson-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css' );
	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';
	wp_add_inline_style( 'hanson-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'hanson_woocommerce_scripts' );

function hanson_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';
	return $classes;
}

add_filter( 'body_class', 'hanson_woocommerce_active_body_class' );

function hanson_woocommerce_products_per_page( $countnumber ) {
	$countnumber = 12;
	return $countnumber;
}
add_filter( 'loop_shop_per_page', 'hanson_woocommerce_products_per_page', 20 );

function hanson_woocommerce_thumbnail_columns() {
	return 4;
}
add_filter( 'woocommerce_product_thumbnails_columns', 'hanson_woocommerce_thumbnail_columns', 20 );

function hanson_woocommerce_loop_columns() {
	return 3;
}
add_filter( 'loop_shop_columns', 'hanson_woocommerce_loop_columns' );


add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 6;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'hanson_related_products_args' );
  function hanson_related_products_args( $args ) {
	$args['posts_per_page'] = 6; // 6 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}

add_filter( 'woocommerce_show_page_title', '__return_false' );

function itl_affiliate_id(){
    return 414;
}
add_filter('gwp_affiliate_id', 'itl_affiliate_id');