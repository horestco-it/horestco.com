<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=ucwords("horestco furniture products lists by {$subcategory->name} subcategory")?></title>
	<meta name="keywords" content="horestco furniture products lists by <?=strtolower($subcategory->name)?> subcategory, Horestco Furniture, Malaysia and Indonesia"/>
	<meta name="description" content="<?=strtolower(implode(', ', $subcategory->products->pluck('name')->toArray()))?>, Kuala Lumpur, Malaysia" />
	<meta name="author" content="Horestco Sdn. Bhd. - Malaysia" />
	<meta name="robots" content="index, follow" />

<?php $this->load->view( 'partials/meta-and-assets' )?>

<?php $this->load->view( config_item('theme').'nav' ) ?>

<div class="container" id="container">
	<div class="row grid">
		<div class="col s12 grid-item" data-id="image-<?=$subcategory->id?>">
			<h5 class="card-panel item-heading grey darken-3 white-text"><?=strtoupper($subcategory->name)?></h5>
			<hr class="hide show-on-print">
		</div>
	</div>

	<?php product_thumbnail($products) ?>
		
	<?php if ( count($subcategory->relations) > 0 ): ?>
		<div class="col s12 grid-item">
			<h5 class="card-panel item-heading grey darken-3 white-text" data-id="<?=$relation->id?>"><?=strtoupper($relation->name)?></h5>
			<hr class="hide show-on-print">
		</div>

		<?php product_thumbnail($relationProducts) ?>

	<?php endif ?>

</div>

<?php $this->load->view( config_item('theme').'script' ) ?>
<?php $this->load->view( 'partials/lazyload.js.php' ) ?>
<?php $this->load->view( config_item('theme').'footer' ) ?>