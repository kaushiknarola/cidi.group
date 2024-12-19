<?php
function hanson_banner_styles() {
    wp_enqueue_style( 'hanson-custom-style', get_template_directory_uri() . '/assets/css/custom.css' );

    //get banner image from cmb2
    $banner_img_cmb2 = esc_url( get_post_meta( get_the_ID(), 'banner_img', true ) );
    //get banner image from customizer
    $bannaer_customizer = get_theme_mod( 'blog_page_banner', get_template_directory_uri() . '/assets/images/default-banner.jpg' );

    $banner_overley = get_theme_mod( 'banner_overley' );
    
    $custom_css = "
        .page-head:before {
            background: $banner_overley;
        }
        .parallax-banner-cmb2 {
            background-image: url('$banner_img_cmb2');
        }
        .parallax-banner {
            background-image: url('$bannaer_customizer');
        }
        ";
    wp_add_inline_style( 'hanson-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'hanson_banner_styles' );

function hanson_color_styles() {
    $primary_color = get_theme_mod( 'primary_color', '#11bde8' );
    $text_color = get_theme_mod( 'text_color' );

	$footer_bg_color = get_theme_mod('footer_bg_color', '#111111');
	$footer_widget_title_color = get_theme_mod('footer_widget_title_color', '#ffffff');
	$footer_widget_text_color = get_theme_mod('footer_widget_text_color', '#bbbbbb');

    $custom_css = "
        body {
            color: $text_color;
        }
    
        .navbar.navbar-default .navbar-nav > li.current-menu-item > a,
        .navbar.navbar-default .navbar-nav > li.current-menu-parent > a,
        .navbar.navbar-default .navbar-nav > li > a:hover,
        .navbar.navbar-default .navbar-nav .dropdown .dropdown-menu > li > a:hover,
        .fa-ul li i, .animated-counter .icon i.fa,.page-head .breadcrumbs span a,
        .wpcf7 label span, .woocommerce .woocommerce-breadcrumb a,
        .sidebar .widget ul li a:hover,.sidebar .widget ul li a:hover:before,
        .footer .widget ul li a:hover,.footer .widget ul li a:hover:before,
        .project-addon .project-item .project-overley .content .project-tags,
        .post .entry-header span i,
        .post .entry-footer span i,.page .entry-header span i,
        .page-head .page-head-title,
        .post .entry-header h1.entry-title a:hover,
        .post .entry-header h2.entry-title a:hover,
        .page .entry-header h1.entry-title a:hover,
        .page .entry-header h2.entry-title a:hover,
        .page .entry-footer span i{color: $primary_color;}
         table th,
        .back-to-top,.project-nav ul li:hover,.project-nav ul li.active,
        .footer .widget .widget-title:after,
        .team-wrap .team-img .overley .team-social a:hover i,
        .animated-counter .timer:after,.comment-respond .submit,
        .wpcf7 input[type=\"submit\"],.sidebar .widget.widget_search .search-form button[type=\"submit\"],
        .footer .widget.widget_search .search-form button[type=\"submit\"],.navbar.navbar-default .navbar-toggle {background: $primary_color;}
         
        .btn.btn-readmore, .skill .progress-bar,
         .itl-portfolio .itl-portfolio-item:hover .buttons span a i:hover {background: $primary_color;}
        .blog .post,
        .archive .post {border-color: $primary_color;}
        
        .team-wrap:hover, 
        .testimonial-carousel .feedback-item .feedback-text,
        .team-wrap .team-img .overley .team-social a i,
        .team-wrap .team-img .overley .team-social a:hover i,
        .post.sticky, .page.sticky,
        .team-wrap:hover .team-img,.feature-number .number {border-color: $primary_color;}
        
        .sidebar .widget.widget_tag_cloud .tagcloud a:hover,
        .footer .widget.widget_tag_cloud .tagcloud a:hover {
            background: $primary_color;
            border-color: $primary_color;
        }

        .testimonial-carousel .feedback-item .feedback-text:after {
           border-color: $primary_color transparent transparent transparent;
        }
        
        .footer {background: $footer_bg_color;}
        .footer .widget .widget-title h3 {color: $footer_widget_title_color;}
        .footer,
        .footer .widget ul li,
        .footer .widget ul li a,
        .footer .widget ul li a:before,
        .footer .widget.widget_tag_cloud .tagcloud a {color: $footer_widget_text_color;}
        ";
    wp_add_inline_style( 'hanson-custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'hanson_color_styles' );