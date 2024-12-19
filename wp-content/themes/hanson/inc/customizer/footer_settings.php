<?php
$wp_customize->add_panel( 'footer_panel', array(
    'title' => esc_html__('Footer Settings', 'hanson'),
    'priority' => 120,
) );
$wp_customize->add_section( 'footer_color_section', array(
	'title' => esc_html__( 'Color Settings', 'hanson' ),
	'panel' => 'footer_panel',
	'priority' => 100,
) );
/*footer bg color start*/
$wp_customize->add_setting('footer_bg_color',array(
	'default'	=> '#111111',
	'transport' => 'refresh',
	'capability' => 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color'
));
$wp_customize->add_control(
	new WP_Customize_Color_Control($wp_customize,'footer_bg_color_control',array(
		'label' => __('Footer Background Color','hanson'),
		'section' => 'footer_color_section',
		'settings' => 'footer_bg_color'
	))
);
/*footer bg color end*/
/*footer widget title color start*/
$wp_customize->add_setting('footer_widget_title_color',array(
	'default'	=> '#ffffff',
	'transport' => 'refresh',
	'capability' => 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color'
));
$wp_customize->add_control(
	new WP_Customize_Color_Control($wp_customize,'footer_widget_title_color_control',array(
		'label' => __('Footer Widget Title Color','hanson'),
		'section' => 'footer_color_section',
		'settings' => 'footer_widget_title_color'
	))
);
/*footer widget title color end*/
/*footer widget text color start*/
$wp_customize->add_setting('footer_widget_text_color',array(
	'default'	=> '#bbbbbb',
	'transport' => 'refresh',
	'capability' => 'edit_theme_options',
	'sanitize_callback'	=> 'sanitize_hex_color'
));
$wp_customize->add_control(
	new WP_Customize_Color_Control($wp_customize,'footer_widget_text_color_control',array(
		'label' => __('Footer Widget Text Color','hanson'),
		'section' => 'footer_color_section',
		'settings' => 'footer_widget_text_color'
	))
);

$wp_customize->add_section( 'copyright_sec', array(
    'title' => esc_html__( 'Copyright', 'hanson' ),
    'panel' => 'footer_panel',
    'priority' => 100,
) );
$wp_customize->add_setting( 'copyright_text', array(
    'default' => __( 'Copyright Hanson WordPress Theme - by iThemesLab', 'hanson' ),
    'transport' => 'postMessage',
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'wp_kses_post',
) );
$wp_customize->add_control(
    new WP_Customize_Control(
        $wp_customize,
        'copyright_text_control',
        array(
            'label' => esc_html__( 'Copyright Text', 'hanson' ),
            'section' => 'copyright_sec',
            'settings' => 'copyright_text',
            'type' => 'textarea',
        )
    )
);