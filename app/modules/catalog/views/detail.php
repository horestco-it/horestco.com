<!DOCTYPE html>
<html lang="en">
	<title><?=implode(' ',$metadata['title'])?></title>
	<meta name="keywords" content="<?=implode(', ', $metadata['keywords'])?> "/>
  <meta name="description" content="<?=$metadata['description'][0]?>" />
  <meta name="author" content="Horestco Sdn. Bhd. - Malaysia" />
  <meta name="robots" content="index, follow" />

	<?php

                                    use Illuminate\Support\Str;

 $this->load->view( 'partials/meta-and-assets' )?>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="<?=style_url('owl.carousel.css')?>">
	<link rel="stylesheet" href="<?=style_url('font-awesome.min.css')?>">
	<link rel="stylesheet" href="<?=assets_url('/vendor/pswp/photoswipe.css')?>">
	<link rel="stylesheet" href="<?=assets_url('/vendor/pswp/default-skin/default-skin.css')?>">
	<style>
	.picture figure{
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
	}
	.card .card-image .card-title{
		visibility: hidden;
		padding: 10px;
		font-size: 16px;
		line-height: 16px;
		font-weight: 400;
	}
	.card:hover .card-image .card-title{
		visibility: visible;
	}
	.section{
		padding-bottom: 0;
		line-height: 23px;
	}
	#images-showcase .card-panel{
		box-shadow: none;
		/*border: 1px solid #ddd;*/
		margin-top: 0;
		padding: 10px;
		border-radius: 0;
	}
	#primary-image{
		position: relative;
		min-height: 257px;
	}
	figure{
		margin: 0;
		-webkit-transition: all ease-in .3s;
		-moz-transition: all ease-in .3s;
		transition: all ease-in .3s;
	}
	figure a:hover{
		cursor: -webkit-zoom-in;
	}
	figure.loader{
		z-index: 999;
		background: rgba(255,255,255, .5);
	}
	figure.loader img{
		position: absolute;
		right: 50%;
		top: 50%;
	}
	#material{
		border-top: 1px solid #ddd;
		margin-top: 1rem;
	}
	#material .tabs li > a{
		border-bottom: 2px solid #ddd;
	}
	#material .collapsible{
		margin: 0 0 1rem 0;
		box-shadow: none;
	}
	.material-lists li.item{
		display: inline-block;
	}
	.material-lists li.item .image{
		padding: 5px;
		border: 1px solid transparent;
	}
	.material-lists li.item .image.active{
		border-color: #009688;
	}
	.material-lists li.item .caption{
		margin-top: -10px;
	}
	.material-lists li.item .caption span:first-child{
		font-size: 0.8rem;
	}
	.section.fabric .select-wrapper input.select-dropdown{
		margin:0;
	}
	</style>
</head>
<body>

<?php $this->load->view( config_item('theme').'nav' ) ?>

<nav class="top-nav transparent hide-on-small-only">
  <div class="container nav-wrapper">
    <div class="col s12">
      <a href="/" class="breadcrumb">Home</a>
      <a href="/furniture" class="breadcrumb">Furniture</a>
      <a href="/furniture/area/<?=$product->category['slug']?>" class="breadcrumb"><?=ucwords($product->category['name'])?></a>
      <a href="/furniture/<?=$product->category['slug']?>/<?=$product->subcategory['slug']?>" class="breadcrumb"><?=ucwords(strtolower($product->subcategory['name']))?></a>
      <a href="/furniture/<?=Str::slug($product->name)?>-<?=$product->code?>" class="breadcrumb"><?=ucwords(strtolower($product->name))?></a>
    </div>
  </div>
</nav>

<div class="container" id="product-detail-container">
	<div class="row">
		<div class="col s12 l9 col-left">
			<div class="row">
				<div class="col s12 m6 push-m6 l6 push-l6 col-middle" style="margin-bottom:30px">

					<div class="divider"></div>

					<h5 data-id="<?=$product->id?>"><?=$product->name?>
						<?php if ($product->prices['promo'] && false ): // remove false if enabling ?>
						<a title="More Promo" href="/malaysia-furniture-promotions"><span class="badge teal white-text z-depth-2">Promo</span></a>
						<?php endif ?>
					</h5>

					<div class="divider"></div>

					<!--<div class="section price-label">-->
					<!--	<span class="fa-stack"><i class="fa fa-tag grey-text"></i></span>-->
					<!--	<span class="grey-text"><?=$currency?></span>-->
					<!--	<span class="value <?= $product->sizes[0]->prices->promo == 0.00 ? '' : 'text-del' ?> "><?=$product->sizes[0]->prices->normal?></span>-->
					<!--	<span class="text-promo">-->
					<!--		<?php if ($product->sizes[0]->prices->promo != 0.00): ?>-->
					<!--			<?=$product->sizes[0]->prices->promo?>-->
					<!--		<?php endif ?>-->
					<!--	</span>-->
					<!--</div>-->

					<div class="section note <?php if ($product->sizes[0]->prices->promo_note == '') echo 'hide' ?>" style="padding-top:0">
						<span class="fa-stack"><i class="fa fa-info-circle grey-text"></i></span>
						<span class="value"><?=$product->sizes[0]->prices->promo_note?></span>
					</div>

					<?php if ($product->code): ?>
						<div class="section code">
							<span class="grey-text text-darken-1">CODE:</span>
							<span class="value"><?=$product->code?></span>
						</div>
					<?php endif ?>

					<?php if ($product->stock): ?>
						<div class="section stock">
							<span class="grey-text text-darken-1">STOCK:</span>
							<br>
							<span class="value"><?=$product->stock?></span>
						</div>
					<?php endif ?>

					<?php if ($product->description): ?>
					<div class="section description">
						<span class="grey-text text-darken-1">DESCRIPTION:</span>
						<br>
						<span class="value" align="justify">
						
						<?php
							$komen = $product->description;
							$pecah = explode("\r\n", $komen);
							$text = "";
							
							for ($i=0; $i<=count($pecah)-1; $i++)
      							{
       								$part = str_replace($pecah[$i], "<p>".$pecah[$i]."</p>", $pecah[$i]);
       								$text .= $part;
      							}
      							
      							echo $text;
						?>
						</span>
					
					</div>
					<?php endif ?>

					<?php if ($product->sizes[0]->dimension): ?>
					<div class="section dimension">
						<span class="grey-text text-darken-1">DIMENSION:</span>
						<br>
						<span class="value">
						<?php
							$komen = $product->sizes[0]->dimension;
							$pecah = explode("\r\n", $komen);
							$text = "";
							
							for ($i=0; $i<=count($pecah)-1; $i++)
      							{
       								$part = str_replace($pecah[$i], "<p>".$pecah[$i]."</p>", $pecah[$i]);
       								$text .= $part;
      							}
      							
      							echo $text;
						?>
						
						</span>
					</div>
					<?php endif ?>

					<?php if ($product->pdf != ''): ?>
					<div class="section pdf">
						<a download href="<?=base_url().config_item('productsheet_pdf').$product->pdf?>" class="btn download">
						<i class="fa fa-chevron-down"></i>
							Download Spec Sheet PDF
						</a>
					</div>
					<?php endif ?>

					<?php
						///////////////////////
						// WIDGET : MATERIAL //
						///////////////////////
						if( count($materials) > 0 )
						{
							//$this->load->view('partials/product-detail-material', compact('materials'));
						}
					?>

					
					
				</div><!-- end product text -->

				<div class="col s12 m6 pull-m6 l6 pull-l6" id="images-showcase">
					<?php 
					    $images = $product->images;
					    if($images && count($images) > 0):
					        $image = (array)$images[0];
					   ?>
					<div class="card-panel">
						
						<div id="primary-image">
					  	<div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
					  		<?php foreach ($product->images as $key => $image): ?>
					  		<?php
					  			$primary = $image->is_primary || $key == 0 ? 1 : 0;

					  			$zIndex = $primary ? count($product->images) : $key;
					  			$opacity = $primary ? 1 : 0;
					  			$display = $primary ? 'block' : 'none';
					  			$options = array_merge($attr, ['itemprop'=>'thumbnail']);

					  			$options['data-src'] = $primary ? base_url().product_img_url($image->name) : 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAWgBaAAD/4gxYSUNDX1BST0ZJTEUAAQEAAAxITGlubwIQAAB...';
					  		?>
							  <figure id="image-<?=$image->id?>" 
							  				data-name="<?=$image->name?>" 
							  				itemprop="associatedMedia" 
							  				itemscope itemtype="http://schema.org/ImageObject" 
							  				data-id="<?=$image->id?>"  
							  				style="z-index:<?=$zIndex?>;opacity:<?=$opacity?>" 
							  				class="image-<?=$image->id?> <?=$image->is_primary?'active':''?>">
							    <a href="<?=base_url().product_img_url($image->name)?>" itemprop="contentUrl" data-size="800x600" data-index="<?=$key?>">
					  				<i class="fa fa-search-plus fa-2x zooming-icon"></i>
							    <?php  ?>
							    	<?php  echo image_thumb(product_img_url($image->name), 465, $options) ?>
							    </a>
							  </figure>
					  		<?php endforeach ?>
							</div> 
						</div>
						<?php endif; ?>
						<div id="slide" class="owl-carousel" data-slider-id="1">
							<?php foreach ($product->images as $key => $image): ?>
					      <div class="item" data-target="image-<?=$image->id?>">
								<?php
									// update_to_lower($image->id, $image->name);
									$options = ['data-original'=>base_url().product_img_url($image->name)];
								?>
								<?php echo image_thumb(product_img_url($image->name), 100, $options);?>
					      </div>
							<?php endforeach ?>
						</div>
					</div>
				</div><!-- end #images-showcase -->

			</div><!-- end row -->
		</div><!-- end col l9 col-left -->

		<div class="col s12 l3 col-right">
			<?php
				/////////////////////
				// WIDGET : BASKET //
				/////////////////////
				$this->load->view('partials/product-detail-basket', compact('product', 'materials', 'Material'));
			?>
		</div><!-- end col-right -->

	</div><!-- end row -->
	<?php if (!empty($product->relations) && count($product->relations) > 0): ?>
	<div class="row" id="related-items">
		<h5>Related Items</h5>
		<div class="col s12">
			<div class="row">
				<?php foreach($product->relations as $key => $relProduct): ?>
						<div class="col s6 m3 l2 item">
							<a href="<?=base_url('furniture/'.Str::slug($relProduct->name).'-'.$relProduct->id)?>">
								<div class="card">
									<?php foreach($relProduct->images as $image): ?>
										<?php if (!empty($image->is_primary)): ?>
										<div class="card-image">
											<?php 
											 $attr = [
											 	'alt' => strtolower($relProduct->name),
											 	'title' => strtolower($relProduct->name)
											 ];
											 ?>
											<?=image_thumb(product_img_url($image->name), 300, $attr)?>
											<span class="card-title"><?=$relProduct->name?></span>
										</div>
										<?php endif ?>
									<?php endforeach ?>
									<div class="card-content hide show-on-print">
										<?=$relProduct->name?>
									</div>
								</div>
							</a>
						</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
	<?php endif ?>

</div>

<?php $this->load->view('template/photoswipe') ?>

<?php $this->load->view( config_item('theme').'script' ) ?>
<?php $this->load->view('partials/product-detail.js.php') ?>
<?php // $this->load->view('partials/product-detail-cart.js.php') ?>
<?php $this->load->view( config_item('theme').'footer' ) ?>
