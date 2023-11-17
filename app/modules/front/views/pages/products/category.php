<!DOCTYPE html>
<html lang="en">
<head>
<?php echo get_meta('furniture/area/'.$category->name)?>

<?php $this->load->view('partials/meta-and-assets')?>

</head>
<body>

<?php $this->load->view('template/default/nav.php') ?>

<div class="container" id="container">

	<?php foreach ($subcategories as $key => $sub): ?>

		<div class="row">
			<div class="col s12 grid-item" data-id="image-<?=$sub->id?>">
				<hr class="hide show-on-print">
				<h5 class="card-panel grey darken-3 item-heading">
					<a class="white-text" href="<?=base_url().'furniture/'.$category->slug.'/'.$sub->slug?>">
					<?=strtoupper($sub->name)?>
					<span class="right">
						<i class="fa fa-angle-double-right"></i>
					</span>
					</a>
				</h5>
				<hr class="hide show-on-print">
			</div>
		</div>

		<?php product_thumbnail($sub->products);?>

	<?php endforeach ?>
	
	<?php if ($addSubcategory != ''): ?>
		<?php foreach ($addSubcategory as $key => $sub): ?>
		<div class="row">
			<div class="col s12 grid-item" data-id="image-<?=$sub->id?>">
				<hr class="hide show-on-print">
				<h5 class="card-panel grey darken-3 item-heading">
					<a class="white-text" href="<?=base_url().'furniture/'.$category->slug.'/'.$sub->slug?>">
					<?=strtoupper($sub->name)?>
					<span class="right">
						<i class="fa fa-angle-double-right"></i>
					</span>
					</a>
				</h5>
				<hr class="hide show-on-print">
			</div>
		</div>

		<?php product_thumbnail($sub->products);?>

		<?php endforeach ?>
	<?php endif ?>

</div>


<?php $this->load->view('partials/footer') ?>

<?php $this->load->view('partials/scripts/lazyload.js.php') ?>
</body>
</html>
