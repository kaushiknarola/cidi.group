<?php
$wp_customize->add_section( 'preloader_section', array(
    'title' => esc_html__( 'Preloader Settings', 'hanson' ),
    'priority' => 13,
) );
$wp_customize->add_setting( 'preloader_set', array(
	'default' => 'circle',
	'transport' => 'refresh',
	'capability' => 'edit_theme_options',
	'sanitize_callback' => 'hanson_sanitize_select',
) );
$wp_customize->add_control( 'preloader_set', array(
	'type' => 'select',
	'section' => 'preloader_section', // Add a default or your own section
	'label' => __( 'Choose preloader style', 'hanson' ),
//	'description' => __( 'This is a custom select option.' ),
	'choices' => array(
		'' => __( 'None', 'hanson' ),
		'circle' => __( 'Circle Preloader', 'hanson' ),
		'bar' => __( 'Bar Preloader', 'hanson' ),
	),
) );
function hanson_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}