<?php
/**
 * Enqueue styles.
 */
function hanson_styles() {

	wp_enqueue_style( 'montserrat-font', '//fonts.googleapis.com/css?family=Montserrat:400,500,600,700' );
	wp_enqueue_style( 'opensans-font', '//fonts.googleapis.com/css?family=Open+Sans:400,700' );

	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/vendor/bootstrap.min.css' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/assets/css/vendor/font-awesome.min.css' );
	wp_enqueue_style( 'line-icon', get_template_directory_uri() . '/assets/fonts/lineicon/line-icon.css' );
	wp_enqueue_style( 'hover-css', get_template_directory_uri() . '/assets/css/vendor/hover-min.css' );
	wp_enqueue_style( 'mean-menu', get_template_directory_uri() . '/assets/css/vendor/meanmenu.min.css' );

	wp_enqueue_style( 'hanson-theme-style', get_template_directory_uri() . '/assets/css/theme-style.css' );
	wp_enqueue_style( 'hanson-theme-responsive', get_template_directory_uri() . '/assets/css/responsive.css' );

	wp_enqueue_style( 'hanson-style', get_stylesheet_uri() );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'hanson_styles' );

/**
 * Enqueue scripts.
 */
function hanson_scripts() {

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/vendor/bootstrap.min.js', array( 'jquery' ), false, true );
    //wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/js/vendor/owl.carousel.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'appear', get_template_directory_uri() . '/assets/js/vendor/jquery.appear.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'countTo', get_template_directory_uri() . '/assets/js/vendor/jquery.countTo.js', array( 'appear' ), false, true );
    wp_enqueue_script( 'mean-menu', get_template_directory_uri() . '/assets/js/vendor/jquery.meanmenu.min.js', array( 'jquery' ), false, true );
	$preloader = get_theme_mod('preloader_set', 'circle');
	if($preloader) {
		wp_enqueue_script( 'preloader', get_template_directory_uri() . '/assets/js/preloader.js', array( 'jquery' ), false, true );
	}
    wp_enqueue_script( 'hanson-main', get_template_directory_uri() . '/assets/js/main.js', array( 'bootstrap' ), false, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'hanson_scripts' );