<?php 
// the pages needs this

/*
 * 1. /front/catalog/products/lists.php
 * 2. /front/catalog/products/category.php
 * 3. /front/catalog/products/subcategory.php
 */

?>
<script src="<?=script_url('masonry.pkgd.min.js')?>"></script>
<script src="<?=script_url('jquery.lazy.min.js')?>"></script>
<script src="<?=script_url('imagesloaded.pkgd.min.js')?>"></script>
<script>
	$(document).ready(function(){

		var $imgs = $('img.lazy');
		var $grid = $('.grid');

    $imgs.lazy();

		// $grid.masonry({
		// 	itemSelector: '.grid-item',
		// 	percentPosition: true,
		// 	columnWidth: '.grid-sizer',
		// });

		// $grid.imagesLoaded(function(){
		// 	$grid.masonry('layout');
		// }).progress(function(){
		// });


	});
</script>