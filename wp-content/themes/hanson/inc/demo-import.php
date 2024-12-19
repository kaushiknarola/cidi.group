<?php 
function hanson_demo_import() {
    return array(
        array(
            'import_file_name'             => 'Hanson Demo Import',
            'categories'                   => array( 'Hanson' ),
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/demo-data/sample-data.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/demo-data/widgets.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/demo-data/customizer.dat',
            'import_preview_image_url'     => 'http://www.your_domain.com/ocdi/preview_import_image1.jpg',
            'import_notice'                => __( 'Please keep patients while importing sample data.', 'hanson' ),
            'preview_url'                  => 'http://www.your_domain.com/my-demo-1',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'hanson_demo_import' );

function hanson_after_import_setup() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home Page 1' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    //Import Revolution Slider
    if ( class_exists( 'RevSlider' ) ) {
    $absolute_path = __FILE__;
    $path_to_file = explode( 'wp-content', $absolute_path );
    $path_to_wp = $path_to_file[0];
     
    get_template_part( $path_to_wp.'/wp-load.php' );
    get_template_part( $path_to_wp.'/wp-includes/functions.php');
    
       $slider_array = array(
          get_template_directory()."/inc/demo-data/slideshow-1.zip",
          get_template_directory()."/inc/demo-data/slideshow-2.zip",
          get_template_directory()."/inc/demo-data/slideshow-3.zip",
          get_template_directory()."/inc/demo-data/slideshow-4.zip",
          );

       $slider = new RevSlider();
    
       foreach($slider_array as $filepath){
         $slider->importSliderFromPost(true,true,$filepath);  
       }
       echo 'Hanson Slideshows Imported';
   }

}
add_action( 'pt-ocdi/after_import', 'hanson_after_import_setup' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );