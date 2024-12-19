<?php
/**
 * hansonbiz preloader
 */
?>

<div id="preloader" class="preloader">
<?php $preloader_style = get_theme_mod('preloader_set', 'circle');
if($preloader_style === 'circle') { ?>
	<div class="loader">
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
		<div class="dot"></div>
	</div>
<?php } ?>
<?php if($preloader_style === 'bar') { ?>
    <ul class="loader">
        <li class='one'></li>
        <li class='two'></li>
        <li class='three'></li>
        <li class='four'></li>
        <li class='five'></li>
    </ul>
<?php } ?>
</div>
