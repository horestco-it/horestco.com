<!DOCTYPE html>
<html lang="en">
<head>

<?=get_meta($page); ?>

<?php $this->load->view('partials/meta-and-assets')?>

	
</head>
<body>

<?php $this->load->view('template/default/nav.php') ?>

<div class="container">
	<?php foreach ($subcategories as $key => $subcategory): ?>
	<div class="row">
		<div class="col s12 grid-item">
			<h5 class="card-panel grey darken-3 item-heading">
				<a class="white-text" href="<?=base_url().'furniture/'.$subcategory->category["slug"].'/'.$subcategory->slug?>">
					<?=strtoupper($subcategory->name)?>
					<span class="right">
						<i class="fa fa-angle-double-right"></i>
					</span>
				</a>
			</h5>
			<hr class="hide show-on-print">
		</div>
	</div>

	<?php product_thumbnail($subcategory->products); // go to => app/helpers/product_helper.php ?>
			
	<?php endforeach ?>
</div>

<?php $this->load->view('partials/footer') ?>

<?php $this->load->view('partials/scripts/lazyload.js.php') ?>
</body>
</html>