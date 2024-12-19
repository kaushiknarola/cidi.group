<?php
if ( ! function_exists( 'hanson_setup' ) ) :
/**
* Sets up theme defaults and registers support for various WordPress features.
*
* Note that this function is hooked into the after_setup_theme hook, which
* runs before the init hook. The init hook is too late for some features, such
* as indicating support for post thumbnails.
*/
function hanson_setup() {
/*
* Make theme available for translation.
* Translations can be filed in the /languages/ directory.
* If you're building a theme based on hanson, use a find and replace
* to change 'hanson' to the name of your theme in all the template files.
*/
load_theme_textdomain( 'hanson', get_template_directory() . '/languages' );

// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );

/*
* Let WordPress manage the document title.
* By adding theme support, we declare that this theme does not use a
* hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support( 'title-tag' );

    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support( 'post-thumbnails' );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
    'primary' => esc_html__( 'Primary', 'hanson' ),
    ) );

    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    ) );

    // Set up the WordPress core custom background feature.
    add_theme_support( 'custom-background', apply_filters( 'hanson_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

    add_theme_support( 'woocommerce' );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );
    }

    add_editor_style(  );

    // Add image sizes
    add_image_size( 'itl_standard_post_thumb', 800, 500, true );
    add_image_size( 'itl_single_post_thumb', 1200, 750, true );
    add_image_size( 'itl_portfolio_square_thumb', 600, 600, true );
    add_image_size( 'itl_portfolio_rect_sm_thumb', 600, 450, true );
    add_image_size( 'itl_portfolio_rect_lg_thumb', 800, 600, true );
endif;

add_action( 'after_setup_theme', 'hanson_setup' );

    /**
    * Set the content width in pixels, based on the theme's design and stylesheet.
    *
    * Priority 0 to make it available to lower priority callbacks.
    *
    * @global int $content_width
    */
    function hanson_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'hanson_content_width', 850 );
    }
    add_action( 'after_setup_theme', 'hanson_content_width', 0 );

