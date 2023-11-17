<?php 
// the pages needs this

/*
 * 1. /front/catalog/products/lists.php
 * 2. /front/catalog/products/category.php
 * 3. /front/catalog/products/subcategory.php
 */
ob_start();
?>
<script src="<?=script_url('jquery.lazy.min.js')?>"></script>
<script>
	$(document).ready(function(){

		var $imgs = $('img.lazy');

    $imgs.lazy({
    	afterLoad: function(elm){
    		$(elm).css({
    			'width':'100%',
    			'top':0,
    			'bottom':0,
    			'right':0,
    			'left':0,
    			})
    	}
    });


	});
</script>
<?php echo minify_js(ob_get_clean()); ?>