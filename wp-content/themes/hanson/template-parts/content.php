<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!--post thumbnail start-->
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="entry-thumb">
        <?php the_post_thumbnail( 'itl_single_post_thumb', array( 'class' => 'img-responsive') ); ?>
    </div>
    <?php endif; ?>
    <!--post thumbnail start-->

    <!--post header start-->
    <?php if( !is_page() ) : ?>
    <header class="entry-header">
        <?php
        if ( !is_single() ) :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        else :
            the_title( '<h1 class="entry-title">', '</h1>' );
        endif;

        if ('post' === get_post_type()) : ?>
            <div class="entry-meta">
                <?php hanson_posts_meta_header(); ?>
            </div><!-- .entry-meta -->
            <?php
        endif; ?>
    </header><!-- .entry-header -->
    <?php endif; ?>
    <!--post header end-->

    <!--main content start-->


    <?php if( is_single() || is_page() ) : ?>
    <div class="entry-content">
        <?php
        the_content(sprintf(
        /* translators: %s: Name of current post. */
            wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'hanson'), array('span' => array('class' => array()))),
            the_title('<span class="screen-reader-text">"', '"</span>', false)
        ));

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'hanson'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->
    <?php else : ?>
        <div class="entry-summery">
            <?php the_excerpt(); ?>
        </div>
    <?php endif; ?>

    <!--main content end-->
<?php echo do_shortcode('[Sassy_Social_Share style="background-color:#000;"]'); ?>
    <!--post footer start-->
    <footer class="entry-footer">
        <?php
        if (!is_page()) :
            if (is_single()) :
                hanson_post_meta_footer();
            else :
                hanson_readmore_btn();
            endif;
        endif;
        ?>
    </footer><!-- .entry-footer -->
    <!--post footer end-->
</article><!-- #post-## -->
