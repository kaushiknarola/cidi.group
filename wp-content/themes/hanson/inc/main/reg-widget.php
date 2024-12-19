<?php
/**
 * Register widget area.
 */
function hanson_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Right Sidebar Area', 'hanson' ),
        'id'            => 'right-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'hanson' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title"><h3>',
        'after_title'   => '</h3></div>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'WooCommerce Sidebar Area', 'hanson' ),
        'id'            => 'woo-sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'hanson' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title"><h3>',
        'after_title'   => '</h3></div>',
    ) );
    register_sidebar( array(
        'name'          => esc_html__( 'Footer - 1 Widget Area', 'hanson' ),
        'id'            => 'footer-sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'hanson' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<div class="widget-title"><h3>',
        'after_title'   => '</h3></div>',
    ) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer - 2 Widget Area', 'hanson' ),
		'id'            => 'footer-sidebar-2',
		'description'   => esc_html__( 'Add widgets here.', 'hanson' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer - 3 Widget Area', 'hanson' ),
		'id'            => 'footer-sidebar-3',
		'description'   => esc_html__( 'Add widgets here.', 'hanson' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer - 4 Widget Area', 'hanson' ),
		'id'            => 'footer-sidebar-4',
		'description'   => esc_html__( 'Add widgets here.', 'hanson' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><h3>',
		'after_title'   => '</h3></div>',
	) );
}
add_action( 'widgets_init', 'hanson_widgets_init' );