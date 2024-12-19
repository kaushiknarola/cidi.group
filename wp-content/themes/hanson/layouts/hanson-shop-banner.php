<?php
$banner_img_cmb2 = get_post_meta( get_the_ID(), 'banner_img', true );
$banner_class = !empty( $banner_img_cmb2 ) ? 'parallax-banner-cmb2' : 'parallax-banner';
if( !is_front_page() && !is_home() && !is_search() && !is_404() ) { 
?>
<div style="display:none;" class="page-head <?php print esc_attr( $banner_class ); ?>">
    <div class="container">
        <div class="row">

            <div class="col-md-12 mb20">
                    <h2 class="page-head-title"><?php woocommerce_page_title(); ?></h2>
            </div> <!-- /.col -->
            <div class="col-md-12">
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</div>
<?php } ?>