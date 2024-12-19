<?php
if( !function_exists( 'hanson_search_form' ) ) {
    function hanson_search_form( $form )
    {
        $form = sprintf( '<form action="%s" method="get" class="search-form">
			<input type="text" class="form-control" value="%s" required name="s" placeholder="%s">
			<button type="submit"><span><i class="fa fa-search" aria-hidden="true"></i></span></button>
		</form>', esc_url( home_url( '/' ) ), esc_attr( get_search_query() ), esc_html__( 'Type and Hit Enter', 'hanson' ) );
        return $form;
    }

    add_filter( 'get_search_form', 'hanson_search_form' );
}

if( !function_exists( 'hanson_readmore_btn' ) ) {
    function hanson_readmore_btn() { ?>
        <div class="read-more-btn">
            <a class="btn btn-readmore hvr-sweep-to-right" href="<?php print the_permalink(); ?>"><?php print esc_html_e( 'Read more...','hanson' ); ?></a>
        </div>
    <?php
    }
}

function hanson_excerpt_more( $excerpt ) {
    return ' ...';
}
add_filter( 'excerpt_more', 'hanson_excerpt_more' );

if ( class_exists( 'woocommerce' ) ) {
function add_cart_to_menu_item( $items, $args ) {
    $css_class = 'menu-item menu-item-type-cart menu-item-type-woocommerce-cart';
    
    $item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'hanson' ),
                WC()->cart->get_cart_contents_count() );
    $items .= '<li class="' . esc_attr( $css_class ) . '">';
    $items .= '<a href="'. esc_url( wc_get_cart_url() ) .'"><i class="cart-icon fa fa-shopping-cart"></i> ';
    $items .= '<span class="amount">'. wp_kses_data( WC()->cart->get_cart_subtotal() ).'</span>';
    $items .= ' - ';
    $items .= '<span class="count">'. esc_html( $item_count_text ).'</span>';
    $items .= '</a>';
    $items .= '</li>';

    return $items;
}

add_filter( 'wp_nav_menu_items', 'add_cart_to_menu_item', 10, 2 );

add_filter( 'woocommerce_add_to_cart_fragments', 'cart_to_menu_fragments' );
function cart_to_menu_fragments( $fragments ) {
	// Add our fragment
	$fragments['li.menu-item-type-woocommerce-cart'] = add_cart_to_menu_item( '', new stdClass(), true );
	return $fragments;
}
}