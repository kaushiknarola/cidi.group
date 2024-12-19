<?php
$wp_customize->add_section( 'blog_banner_section' , array(
    'title'      => __( 'Default Banner', 'hanson' ),
    'panel'		 => 'header_panel',
    'priority'   => 30,
) );

$wp_customize->add_setting( 'blog_page_banner', array(
    'default' => get_template_directory_uri() . '/assets/images/default-banner.jpg',
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'blog_banner_img',
        array(
            'label'      => __( 'Upload an image', 'hanson' ),
            'section'    => 'blog_banner_section',
            'settings'   => 'blog_page_banner',
        )
    )
);
$wp_customize->add_setting('banner_overley',array(
    'default'	=> '',
    'transport' => 'refresh',
    'capability' => 'edit_theme_options',
    'sanitize_callback'	=> 'sanitize_hex_color'
));
$wp_customize->add_control(
    new WP_Customize_Color_Control($wp_customize,'banner_overley_color',array(
        'label' => __('Overley Color','hanson'),
        'section' => 'blog_banner_section',
        'settings' => 'banner_overley'
    ))
);