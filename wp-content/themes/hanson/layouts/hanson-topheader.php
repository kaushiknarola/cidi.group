<!--top header start-->
<?php if(get_theme_mod( 'top_header_setting' ) ): ?>
<div class="top-header hidden-sm hidden-xs">
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                <?php itl_top_social(); ?>
            </div> <!--/.col-->

            <div class="col-md-6">
		        <?php itl_top_header_contact(); ?>
            </div> <!--/.col-->

        </div> <!--/.row-->
    </div> <!--/.container-->
</div>
<!--top header end-->
<?php endif; ?>