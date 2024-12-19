<?php
/**
 * Template Name: Blog Page Template
 */

get_header();
get_template_part( 'layouts/hanson', 'banner' );
?>

	<div id="primary" class="content-area content-pad">
		<main id="main" class="site-main" role="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <?php
                        if ( have_posts() ) :

                            while ( have_posts() ) : the_post();

                                get_template_part( 'template-parts/content', get_post_format() );

                            endwhile;

                            the_posts_navigation( array( 'screen_reader_text' => esc_html__( '&nbsp;', 'hanson' ) ) );

                        else :

                            get_template_part( 'template-parts/content', 'none' );

                        endif; 
                        ?>
                    </div> <!--/.col-->
                    <div class="col-md-4">
                        <?php get_sidebar(); ?>
                    </div> <!--/.col-->
                </div> <!--/.row-->
            </div> <!--/.container-->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
