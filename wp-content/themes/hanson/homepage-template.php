<?php
/**
 * Template Name: Home Page Template
 */

get_header(); ?>
<div class="fullwidth-main-container">
    <div class="container">
            <?php
            if( have_posts() ) :
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            else :
                print '<h2>'. esc_html__( 'Not found', 'hanson' ) .'</h2>';
            endif;
            ?>
    </div> <!--/.container-->
</div> <!--/.fullwidth-main-container-->
<?php
get_footer();

