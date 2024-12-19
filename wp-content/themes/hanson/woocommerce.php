<?php
get_header();
get_template_part( 'layouts/hanson', 'shop-banner' );
?>

    <div id="primary" class="content-area content-pad">
        <main id="main" class="site-main" >
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
						 <div><h2><span>cidi Bike Shop</span></h2>
                            <p>To make a real and lasting difference for the poor we need to spur economic development by building strong industries that pay fairly. Africa is where the problem is particularly acute as there are more Africans living in Extreme poverty than the combined populace of North America.</p>
                        </div>
                        <?php
                        woocommerce_content();
                        ?>
                    </div> <!--/.col-->
                    <!--<div class="col-md-4">
                        <?php //get_sidebar(); ?>
                    </div>-->
                </div> <!--/.row-->
            </div> <!--/.container-->
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();

