<?php

get_header();
get_template_part('layouts/hanson', 'banner');
?>

    <section id="primary" class="content-area content-pad">
        <main id="main" class="site-main" role="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <?php
                        if (have_posts()) : ?>

                            <header class="search-page-header">
                                <h1 class="page-title"><?php printf(esc_html__('Search Results for: %s', 'hanson'), '<span>' . get_search_query() . '</span>'); ?></h1>
                            </header><!-- .page-header -->

                            <?php
                            /* Start the Loop */
                            while (have_posts()) : the_post();

                                /**
                                 * Run the loop for the search to output the results.
                                 * If you want to overload this in a child theme then include a file
                                 * called content-search.php and that will be used instead.
                                 */
                                get_template_part('template-parts/content', 'search');

                            endwhile;

                            the_posts_navigation( array( 'screen_reader_text' => esc_html__( '&nbsp;', 'hanson' ) ) );

                        else :

                            get_template_part('template-parts/content', 'none');

                        endif; ?>
                    </div> <!--/.col-->
                    <div class="col-md-4">
                        <?php get_sidebar(); ?>
                    </div> <!--/.col-->
                </div> <!--/.row-->
            </div> <!--/.container-->
        </main><!-- #main -->
    </section><!-- #primary -->

<?php
get_sidebar();
get_footer();
