<?php $this->load->view( config_item('theme').'header' )?>

<?php $this->load->view( config_item('theme').'nav') ?>

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

<?php $this->load->view( config_item('theme').'script' ) ?>
<?php $this->load->view( 'partials/lazyload.js.php' ) ?>
<?php $this->load->view( config_item('theme').'footer' ) ?>
