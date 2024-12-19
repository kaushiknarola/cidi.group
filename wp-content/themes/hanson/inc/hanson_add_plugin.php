<?php

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'hanson_register_required_plugins' );

function hanson_register_required_plugins() {

	$plugins = array(
        array(
            'name'               => esc_html__( 'Elementor','hanson' ),
            'slug'               => 'elementor',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__( 'CMB2','hanson' ),
            'slug'               => 'cmb2',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__( 'Contact Form 7','hanson' ),
            'slug'               => 'contact-form-7',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
        array(
            'name'               => esc_html__( 'Hanson Core','hanson' ),
            'slug'               => 'hanson-core',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
            'source'             => 'http://extensions.ithemeslab.com/hanson-core.zip',
        ),
        array(
            'name'               => esc_html__( 'WP Instagram Widget','hanson' ),
            'slug'               => 'wp-instagram-widget',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
            'name'               => esc_html__( 'Mail Chimp for WP','hanson' ),
            'slug'               => 'mailchimp-for-wp',
            'required'           => true,
            'force_activation'   => false,
            'force_deactivation' => false,
        ),
		array(
			'name'               => esc_html__( 'WP Mega Menu','hanson' ),
			'slug'               => 'wp-megamenu',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'WooCommerce','hanson' ),
			'slug'               => 'woocommerce',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'WooCommerce Variation Swatches','hanson' ),
			'slug'               => 'woo-variation-swatches',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'YITH WooCommerce Wishlist','hanson' ),
			'slug'               => 'yith-woocommerce-wishlist',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
		),
		array(
			'name'               => esc_html__( 'Slider Revolution','hanson' ),
			'slug'               => 'revslider',
			'required'           => true,
			'force_activation'   => false,
			'force_deactivation' => false,
			'source'             => 'http://extensions.ithemeslab.com/revslider.zip',
		),
	);

	$config = array(
		'id'           => 'hanson',               // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.


		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'hanson' ),
			'menu_title'                      => __( 'Install Plugins', 'hanson' ),
			'installing'                      => __( 'Installing Plugin: %s', 'hanson' ),
			'updating'                        => __( 'Updating Plugin: %s', 'hanson' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'hanson' ),
			'notice_can_install_required'     => _n_noop(

				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'hanson'
			),
			'notice_can_install_recommended'  => _n_noop(
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'hanson'
			),
			'notice_ask_to_update'            => _n_noop(
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'hanson'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'hanson'
			),
			'notice_can_activate_required'    => _n_noop(
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'hanson'
			),
			'notice_can_activate_recommended' => _n_noop(
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'hanson'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'hanson'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'hanson'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'hanson'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'hanson' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'hanson' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'hanson' ),
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'hanson' ),
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'hanson' ),
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'hanson' ),
			'dismiss'                         => __( 'Dismiss this notice', 'hanson' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'hanson' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'hanson' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),

	);

	tgmpa( $plugins, $config );
}
