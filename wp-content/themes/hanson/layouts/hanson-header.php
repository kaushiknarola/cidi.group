<header id="header" class="header">
    <?php if( ! class_exists('wp_megamenu_initial_setup')) { ?>
    <nav class="navbar navbar-default hidden-xs hidden-sm">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div class="logo">
						<?php
						$theme_logo = ( get_theme_mod('theme_logo' ) != "" ) ? get_theme_mod('theme_logo') : get_template_directory_uri() . '/assets/images/logo.png';
						?>
                        <img src="<?php echo esc_url( $theme_logo ) ?>" alt="<?php echo bloginfo('name');?>">
                    </div>
                </a>
            </div>
			<?php
			wp_nav_menu( array(
					'menu' => 'primary',
					'theme_location' => 'primary',
					'depth' => 5,
					'container' => 'div',
					'container_class' => 'collapse navbar-collapse',
					'container_id' => 'imperial-navbar-collapse',
					'menu_class' => 'nav navbar-nav',
					'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
					'walker' => new wp_bootstrap_navwalker() )
			);
			?>
        </div>
    </nav>
    <div class="mobile-menu hidden-md hidden-lg">
        <div class="sm-logo">
            <img src="<?php echo esc_url( $theme_logo ) ?>" alt="<?php echo bloginfo('name');?>">
        </div>
		<?php
		wp_nav_menu( array(
				'menu' => 'primary',
				'theme_location' => 'primary',
				'depth' => 5,
				'container' => 'nav',
				'container_class' => 'mean-menu',
			)
		);
		?>
    </div>
    <?php } else { ?>
    <div class="hanson-mega-menu">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
	                <?php
	                wp_nav_menu( array(
			                'menu' => 'primary',
			                'theme_location' => 'primary',
		                )
	                );
	                ?>
                </div>
            </div>


        </div>
    </div>
    <?php } ?>
</header>
