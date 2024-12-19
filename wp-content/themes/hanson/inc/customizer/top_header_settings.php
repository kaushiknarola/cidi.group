<?php
$wp_customize->add_panel( 'top_header_panel', array(
    'title' => esc_html__('Top Header Settings', 'hanson'),
    'priority' => 18,
) );

$wp_customize->add_section( 'enable_top_header_section', array(
	'title' => esc_html__( 'Enable / Disable', 'hanson' ),
	'panel' => 'top_header_panel',
	'priority' => 10,
) );

$wp_customize->add_setting( 'top_header_setting', array(
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'itl_sanitize_checkbox',
) );

$wp_customize->add_control( 'top_header_control', array(
	'type' => 'checkbox',
	'settings' => 'top_header_setting',
	'section' => 'enable_top_header_section',
	'label' => __( 'Enable Top Header', 'hanson' ),
	'description' => __( 'Check this box to show top header section', 'hanson' ),
) );

function itl_sanitize_checkbox( $checked ) {
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

$wp_customize->add_section( 'contact_section', array(
    'title' => esc_html__( 'Contact Section', 'hanson' ),
    'panel' => 'top_header_panel',
    'priority' => 11,
) );

$wp_customize->add_setting( 'contact_phone', array (
    'transport' => 'refresh',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'contact_phone_control',
        array(
            'label' => esc_html__( 'Contact Number', 'hanson' ),
            'section' => 'contact_section',
            'settings' => 'contact_phone',
            'type' => 'text',
        )
    )
);

$wp_customize->add_setting( 'contact_email', array (
    'transport' => 'refresh',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'contact_email_control',
        array(
            'label' => esc_html__( 'Address', 'hanson' ),
            'section' => 'contact_section',
            'settings' => 'contact_email',
            'type' => 'text',
        )
    )
);


$wp_customize->add_section( 'social_icon_sec', array(
    'title' => esc_html__( 'Social Section', 'hanson' ),
    'panel' => 'top_header_panel',
    'priority' => 12,
) );
$wp_customize->add_setting( 'socail_text', array (
        'default' => esc_html( '' ),
        'transport' => 'refresh',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'socail_text_control',
        array(
            'label' => esc_html__( 'Social Text', 'hanson' ),
            'section' => 'social_icon_sec',
            'settings' => 'socail_text',
            'type' => 'text',
        )
    )
);

$wp_customize->add_setting( 'fb_url', array (
    'default' => '',
    'transport' => 'refresh',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'fb_url_control',
        array(
            'label' => esc_html__( 'Facebook', 'hanson' ),
            'section' => 'social_icon_sec',
            'settings' => 'fb_url',
            'type' => 'text',
        )
    )
);
$wp_customize->add_setting( 'tw_url', array (
    'default' => '',
    'transport' => 'refresh',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'tw_url_control',
        array(
            'label' => esc_html__( 'Twitter', 'hanson' ),
            'section' => 'social_icon_sec',
            'settings' => 'tw_url',
            'type' => 'text',
        )
    )
);
$wp_customize->add_setting( 'gplus_url', array (
    'default' => '',
    'transport' => 'refresh',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'esc_url_raw'
) );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'gplus_url_control',
        array(
            'label' => esc_html__( 'Google Plus', 'hanson' ),
            'section' => 'social_icon_sec',
            'settings' => 'gplus_url',
            'type' => 'text',
        )
    )
);
$wp_customize->add_setting( 'lin_url', array (
    'default' => '',
    'transport' => 'refresh',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'lin_url_control',
        array(
            'label' => esc_html__( 'Linked In', 'hanson' ),
            'section' => 'social_icon_sec',
            'settings' => 'lin_url',
            'type' => 'text',
        )
    )
);
$wp_customize->add_setting( 'pin_url', array (
    'default' => '',
    'transport' => 'refresh',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'pin_url_control',
        array(
            'label' => esc_html__( 'Pinterest', 'hanson' ),
            'section' => 'social_icon_sec',
            'settings' => 'pin_url',
            'type' => 'text',
        )
    )
);
