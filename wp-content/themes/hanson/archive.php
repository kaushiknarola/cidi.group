<?php
get_header();
get_template_part( 'layouts/hanson', 'banner' );
?>

    <div id="primary" class="content-area content-pad">
        <main id="main" class="site-main" role="main">
            <div class="container">
                <div class="row">
                <div class="col-md-8">
                 <div class="sitebread">
                 <nav aria-label="breadcrumb">
                 <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="<?php echo site_url();?>">Home</a></li>
             <?php if(get_category_link( get_cat_ID(get_the_category( get_the_ID() )[0]->cat_name))!='')  
             {

             echo "<li class='breadcrumb-item'><a href='". esc_url( get_category_link( get_cat_ID(get_the_category( get_the_ID() )[0]->cat_name) ) ) ."'>".get_the_category( get_the_ID() )[0]->cat_name ."</a></li>";
             }
           ?>
                   
                 </ol>

                </nav>  
         </div>
     </div>
     <div class="col-md-4">
         <form role="search" method="get" action="<?php echo home_url( '/' ); ?>" >
                            <input class="searchcolom" placeholder="Enter your search term..." type="text" value="<?php get_search_query(); ?>" name="s" id="search">
                            <input class="mybutton"  type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>">
                            
                        </form>
     </div>
 </div>
               
                <div class="row">

                    <div class="col-md-12">
       
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
                   
					
                </div> <!--/.row-->
            </div> <!--/.container-->
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
