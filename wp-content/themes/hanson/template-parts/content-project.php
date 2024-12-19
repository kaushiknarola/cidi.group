<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <!--post thumbnail start-->
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="entry-thumb">
        <?php the_post_thumbnail( 'itl_single_post_thumb', array( 'class' => 'img-responsive') ); ?>
    </div>
    <?php endif; ?>
    <!--post thumbnail start-->

    <div class="row">
        <div class="col-md-3">
            <?php
            /*get all meta data start*/
            $client_name = get_post_meta( get_the_ID(), 'client_name', true );
            $location = get_post_meta( get_the_ID(), 'location', true );
            $start_date = get_post_meta( get_the_ID(), 'project_start_date', true );
            $complete_date = get_post_meta( get_the_ID(), 'handover_date', true );
            /*get all meta data end*/
            /*prepare string start*/
            $project_meta_string  = '<p><strong>'.esc_html__( 'Client name:', 'hanson' ).'</strong> %1$s</p>';
            $project_meta_string .= '<p><strong>'.esc_html__( 'Location:', 'hanson' ).'</strong> %2$s</p>';
            $project_meta_string .= '<p><strong>'.esc_html__( 'Project started on: ', 'hanson' ).'</strong> %3$s</p>';
            $project_meta_string .= '<p><strong>'.esc_html__( 'Project completed on: ', 'hanson' ).'</strong> %4$s</p>';
            /*prepare string end*/
            echo sprintf($project_meta_string, $client_name, $location, $start_date, $complete_date);
            ?>
        </div> <!--/.col-->
        <div class="col-md-9">
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
        </div> <!--/.col-->

    </div>
    <!--main content end-->

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
