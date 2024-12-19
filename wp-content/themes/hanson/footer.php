<?php
$allowed_html = array(
    'a' => array(
        'href' => array(),
        'target' => array(),
    ),
);
?>
        </div><!-- #content -->
        <!-- footer start -->
        <footer>
            <?php if( is_active_sidebar( 'footer-sidebar-1' ) || is_active_sidebar( 'footer-sidebar-2' ) || is_active_sidebar( 'footer-sidebar-3' ) || is_active_sidebar( 'footer-sidebar-4' ) ) : ?>
            <div class="footer pad60">

                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12"><?php dynamic_sidebar( 'footer-sidebar-1' ); ?></div>
                      <!--  <div class="col-md-3 col-sm-6 col-xs-12"><?php //dynamic_sidebar( 'footer-sidebar-2' ); ?></div>-->
                        <div class="col-md-4 col-sm-6 col-xs-12"><?php dynamic_sidebar( 'footer-sidebar-3' ); ?></div>
                        <div class="col-md-4 col-sm-6 col-xs-12"><?php dynamic_sidebar( 'footer-sidebar-4' ); ?></div>
                    </div> <!-- /.row -->
                </div> <!-- /.container -->

            </div> <!-- /.footer -->
            <?php endif; ?>

            <?php $copyright = get_theme_mod( 'copyright_text', 'Copyright Hanson WordPress Theme - by <a href="#" target="_blank">iThemesLab</a>' ); ?>

            <div id="copyright" style="display:none;" class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="t-center">
                                <p id="copyright-text"><?php echo wp_kses($copyright, $allowed_html); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer end -->

        <?php get_template_part( 'layouts/hanson', 'totop' ); ?>

    </div> <!--/.main-container-->
    <?php wp_footer(); ?>
</body>
</html>
<script type="text/javascript">
var $zoho=$zoho || {};$zoho.salesiq = $zoho.salesiq || 
{widgetcode:"6a1ab921aecd35bd3d3f7b9f53c8d856d2200e49ec9ef5b3e3964e3c599feb6e", values:{},ready:function(){}};
var d=document;s=d.createElement("script");s.type="text/javascript";s.id="zsiqscript";s.defer=true;
s.src="https://salesiq.zoho.com/widget";t=d.getElementsByTagName("script")[0];t.parentNode.insertBefore(s,t);d.write("<div id='zsiqwidget'></div>");
</script>