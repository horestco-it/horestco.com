<?php ob_start() ?>
<?php foreach ($products as $key => $product): ?>
	<?= $product->name ?>
<?php endforeach ?>
<?php echo minify_html(ob_get_clean()) ?>