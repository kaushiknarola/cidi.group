<?php
$wp_customize->add_panel( 'header_panel', array(
    'title' => esc_html__('Header Settings', 'hanson'),
    'priority' => 20,
) );
$wp_customize->add_section( 'custom_logo_sec', array(
    'title' => esc_html__( 'Custom Logo', 'hanson' ),
    'panel' => 'header_panel',
    'priority' => 12,
) );
$wp_customize->add_setting( 'theme_logo', array(
    'default' => get_template_directory_uri() . '/assets/images/logo.png',
    'transport' => 'refresh',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw',
) );
$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'logo_control',
        array(
            'label'      => __( 'Upload a logo', 'hanson' ),
            'section'    => 'custom_logo_sec',
            'settings'   => 'theme_logo',
            'context'    => 'theme-custom-logo'
        )
    )
);

$wp_customize->get_section('title_tagline')->panel = 'header_panel';
$wp_customize->get_section('title_tagline')->priority = 11;
