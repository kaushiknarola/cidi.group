<?php
$wp_customize->add_panel( 'default_panel', array(
    'title' => esc_html__('General Settings', 'hanson'),
    'priority' => 10,
) );
$wp_customize->get_section('static_front_page')->panel = 'default_panel';
$wp_customize->get_section('colors')->panel = 'default_panel';
