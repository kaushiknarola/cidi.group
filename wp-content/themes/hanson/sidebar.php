<?php

if ( ! is_active_sidebar( 'right-sidebar' ) ) {
	return;
}
?>

<div id="secondary" class="widget-area sidebar" role="complementary">
	<?php dynamic_sidebar( 'right-sidebar' ); ?>
</div><!-- #secondary -->
