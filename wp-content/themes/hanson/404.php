<?php
get_header();
?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <section class="error-404 not-found padbottom60">
                            <header class="page-header">
                                <h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'hanson'); ?></h1>
                            </header><!-- .page-header -->

                            <div class="page-content">
                                <p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'hanson'); ?></p>

                                <?php get_search_form(); ?>
                                <a href="<?php print esc_url(home_url('/')); ?>" class="btn btn-primary"><?php esc_html_e('Go Home','hanson') ?></a>
                            </div><!-- .page-content -->
                        </section><!-- .error-404 -->
                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
