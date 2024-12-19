<?php
get_header();
get_template_part( 'layouts/hanson', 'banner' );
?>

    <div id="primary" class="content-area content-pad">
        <main id="main" class="site-main" >
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <?php
                        while ( have_posts() ) : the_post();

                            get_template_part( 'template-parts/content', get_post_format() );

                        endwhile;

                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif; ?>
						
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

