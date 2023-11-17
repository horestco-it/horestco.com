<!DOCTYPE html>
<html lang="en">
<head>
<title><?=ucwords("horestco furniture products lists by {$subcategory->name} subcategory")?></title>
<meta name="keywords" content="horestco furniture products lists by <?=strtolower($subcategory->name)?> subcategory, Horestco Furniture, Malaysia and Indonesia"/>
<meta name="description" content="<?=strtolower(implode(', ', $subcategory->products->lists('name')))?>, Kuala Lumpur, Malaysia" />
<meta name="author" content="Horestco Sdn. Bhd. - Malaysia" />
<meta name="robots" content="index, follow" />

<?php $this->load->view('partials/meta-and-assets')?>

</head>
<body>

<?php $this->load->view('template/default/nav.php') ?>

<div class="divider"></div>

<div class="container" id="container">
	<div class="row grid">
		<div class="col s12 grid-item" data-id="image-<?=$subcategory->id?>">
			<h5 class="card-panel item-heading grey darken-3 white-text"><?=strtoupper($subcategory->name)?></h5>
			<hr class="hide show-on-print">
		</div>
	</div>

	<?php product_thumbnail($subcategory->products) ?>
		
	<?php if ( count($subcategory->relations) > 0 ): ?>
		<div class="col s12 grid-item">
			<h5 class="card-panel item-heading grey darken-3 white-text"><?=strtoupper($relations->name)?></h5>
			<hr class="hide show-on-print">
		</div>

		<?php product_thumbnail($relations->products) ?>

	<?php endif ?>

</div>



<?php $this->load->view('partials/footer') ?>

<?php $this->load->view('partials/scripts/lazyload.js.php') ?>

</body>
</html>