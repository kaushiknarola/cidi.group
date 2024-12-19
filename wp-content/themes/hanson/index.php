<?php
get_header();
get_template_part( 'layouts/hanson', 'banner' );
?>
<style>	
.cat{background-color:transparent!important;display:inline-block;}
.cat a{color:#272727; text-transform:uppercase!important; font-weight:600!important; margin:15px 0px!important; padding:0px 5px!important;}
.cat a:hover{color:#0066ff}
</style>

	<div id="primary" class="content-area content-pad">
		<div class="container"><?php
                $categories = get_categories( array(
                     'orderby' => 'name',
                     'order'   => 'ASC'
                    ) );

            foreach( $categories as $category ) {
                echo '<div class="cat"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></div>';   
			} ?></div>	
		<br><br>
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
