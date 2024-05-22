<!DOCTYPE html>
<html lang="en">
	<title><?=implode(' ',$metadata['title'])?></title>
	<meta name="keywords" content="<?=implode(', ', $metadata['keywords'])?> "/>
  <meta name="description" content="<?=$metadata['description'][0]?>" />
  <meta name="author" content="Horestco Sdn. Bhd. - Malaysia" />
  <meta name="robots" content="index, follow" />

	<?php

                                    use Illuminate\Support\Str;

 $this->load->view('partials/meta-and-assets')?>

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
	#material .tabs li > a{
		border-bottom: 2px solid #ddd;
	}
	#material .collapsible{
		margin: 0 0 1rem 0;
		box-shadow: none;
	}
	.material-lists li.item{
		display: inline-block;
		padding: 4px;
	}

	</style>
</head>
<body>

<?php $this->load->view('partials/nav.php') ?>

<div class="divider"></div>

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
		<div class="col s12 <?php if(count($product->relations)) echo "l9"?> col-left">
			<div class="row">
				<div class="col s12 m6 push-m6 l6 push-l6" style="margin-bottom:30px">

					<div class="divider"></div>

					<h5 data-id="<?=$product->id?>"><?=$product->name?>
						<?php if ($product->prices['promo'] && false ): // remove false if enabling ?>
						<a title="More Promo" href="/malaysia-furniture-promotions"><span class="badge teal white-text z-depth-2">Promo</span></a>
						<?php endif ?>
					</h5>

					<div class="divider"></div>

					<?php if ($product->sizes->count() > 0): ?>
					<div class="section size">
						<select class="browser-default" id="search-size">
							<?php foreach ($product->sizes as $key => $size): ?>
							<option value="<?=$size->id?>">
								<?=strtoupper($size->name)?>
							</option>
							<?php endforeach ?>
						</select>
					</div>
					<?php endif ?>

					<div class="section price-label">
						<span class="fa-stack"><i class="fa fa-tag grey-text"></i></span>
						<span class="grey-text"><?=$currency?></span>
						<span class="value <?= $product->sizes[0]->prices->promo == 0.00 ? '' : 'text-del' ?> "><?=$product->sizes[0]->prices->normal?></span>
						<span class="text-promo">
							<?php if ($product->sizes[0]->prices->promo != 0.00): ?>
								<?=$product->sizes[0]->prices->promo?>
							<?php endif ?>
						</span>
					</div>

					<div class="section note <?php if ($product->sizes[0]->prices->promo_note == '') echo 'hide' ?>" style="padding-top:0">
						<span class="fa-stack"><i class="fa fa-info-circle grey-text"></i></span>
						<span class="value"><?=$product->sizes[0]->prices->promo_note?></span>
					</div>

					<?php if ($product->code): ?>
						<div class="section code">
							<span class="grey-text text-darken-1">Code:</span>
							<br>
							<span class="value"><?=$product->code?></span>
						</div>
					<?php endif ?>

					<?php if ($product->description): ?>
					<div class="section description">
						<span class="grey-text text-darken-1">Description:</span>
						<br>
						<span class="value"><?=$product->description?></span>
					</div>
					<?php endif ?>

					<?php if ($product->sizes[0]->dimension): ?>
					<div class="section dimension">
						<span class="grey-text text-darken-1">Dimension:</span>
						<br>
						<span class="value"><?=$product->sizes[0]->dimension?></span>
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

					<div class="section add-to-cart" style="margin-top: 1rem">
						<div class="row">
						  <form class="col s12 addCart center">
						    <input type="hidden" name="id" value="<?=$product->id?>">
						    <input type="hidden" name="name" value="<?=$product->name?>">
						    <input type="hidden" id="size_id" name="size_id" value="<?=$product->sizes[0]->id?>">
						    <div class="input-group" style="width: 100%">
							    <input type="number" min="1" style="float:left;width:50%" class="form-control center" name="qty" value="1">
						      <span class="input-group-btn">
						        <button class="btn teal" type="submit" style="width:50%">
							      	<i class="mdi-action-shop left"></i>
							      	<span class="text-cart">Add To Cart</span> 
						        </button>
						      </span>
						    </div>
						  </form>
						</div>
					</div>
					
				</div><!-- end product text -->

				<div class="col s12 m6 pull-m6 l6 pull-l6" id="images-showcase">
					<?php $image = $product->images[0]->toArray() ?>
					<div class="card-panel">
						
						<div id="primary-image">
					  	<div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
					  		<?php foreach ($product->images as $key => $image): ?>
					  		<?php
					  			$primary = $image->is_primary || $key == 0 ? 1 : 0;

					  			$zIndex = $primary ? count($product->images) : $key;
					  			$opacity = $primary ? 1 : 0;
					  			$isActive = $primary ? 'active' : '';
					  			$display = $primary ? 'block' : 'none';
					  			$options = array_merge($attr, ['itemprop'=>'thumbnail']);

					  			$options['data-src'] = $primary ? base_url().product_img_url($image->name) : 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAWgBaAAD/4gxYSUNDX1BST0ZJTEUAAQEAAAxITGlubwIQAAB...';
					  		?>
							  <figure id="image-<?=$image->id?>" 
							  				data-name="<?=$image->name?>" 
							  				itemprop="associatedMedia" 
							  				itemscope itemtype="http://schema.org/ImageObject" 
							  				data-id="<?=$image->id?>"  
							  				style="z-index:<?=$zIndex?>" 
							  				class="image-<?=$image->id?> <?=$isActive?>">
							    <a href="<?=base_url().product_img_url($image->name)?>" itemprop="contentUrl" data-size="800x600" data-index="<?=$key?>">
					  				<i class="fa fa-search-plus fa-2x zooming-icon"></i>
							    <?php  ?>
							    	<?php  echo image_thumb(product_img_url($image->name), 465, $options) ?>
							    </a>
							  </figure>
					  		<?php endforeach ?>
							</div>
						</div>
						<div id="slide" class="owl-carousel" data-slider-id="1">
							<?php foreach ($product->images as $key => $image): ?>
					      <div class="item" data-target="image-<?=$image->id?>">
								<?php
									update_to_lower($image->id, $image->name);
									$options = ['data-original'=>base_url().product_img_url($image->name)];
								?>
								<?php echo image_thumb(product_img_url($image->name), 100, $options);?>
					      </div>
							<?php endforeach ?>
						</div>
					</div>
				</div><!-- end #images-showcase -->

				<?php if( count($materials) > 0 ): ?>
				<div class="col s12 m9" id="material">
					<!-- nav tabs -->
					<ul class="tabs">
						<?php foreach ($materials['category'] as $key => $category): ?>
							<li class="tab col s4">
								<a href="#category-<?=$key?>" class=" grey-text text-darken-3"><h5><?=$category['name']?></h5></a>
							</li>
						<?php endforeach ?>
					</ul>

					<div class="row">
						<?php foreach ($materials['category'] as $key => $category): ?>
						<div id="category-<?=$key?>" class="col s12">
							<!-- collapsible -->
							<ul class="collapsible" data-collapsible="accordion">
								<?php foreach ($category['subcategory'] as $i => $sub): ?>
								<?php $isActive = $i == 1 ? 'active': '' ?>
								<li class="<?=$isActive?> <?=$i?>">
									<div class="collapsible-header active"><?=strtoupper($sub['name'])?></div>
									<div class="collapsible-body" style="padding:1rem">
										<ul class="material-lists">
											<?php foreach ($sub['material'] as $idx => $material): ?>
											<?php 
												$image = array_key_exists($material['id'], $materialId_image) ? $materialId_image[$material['id']]['name'] : '';
												$imageId = array_key_exists($material['id'], $materialId_image) ? $materialId_image[$material['id']]['id'] : '';
												$green = $material['is_checked'] ? 'green-text': '';
												$target = $imageId ? "image-$imageId" : '';
											 ?>
											<li class="item " data-target="<?=$target?>">
												<a href="javascript:void(0)" class="<?=$green?>"data-original="<?=base_url().product_img_url($image)?>">
													<img class="z-depth-1 responsive-img" width="80" src="<?=base_url().img_url('material/'.$material['id'].'-'.Str::slug($material['name']).'.jpg')?>" alt="">
												 <!-- 	<span ><?=$material['name']?></span> -->
												</a>
											</li>
											<?php endforeach ?>
										</ul>
									</div>
								</li>
								<?php endforeach ?>
							</ul>
						</div>
						<?php endforeach ?>
					</div>
				</div><!-- end #material -->
				<?php endif	?>

			</div><!-- end row -->
		</div><!-- end col l9 col-left -->

		<?php if(count($product->relations)): ?>
		<div class="col s12 l3 col-right" id="related-items">
				<h5>Related Items</h5>
				<div class="row">
					<?php foreach($product->relations as $key => $product): ?>
							<div class="col s6 m3 l6 item">
								<a href="<?=base_url('furniture/'.Str::slug($product->name).'-'.$product->id)?>">
									<div class="card">
										<?php foreach($product->images as $image): ?>
											<?php if ($image->is_primary): ?>
											<div class="card-image">
												<?php 
												 $attr = [
												 	'alt' => strtolower($product->name),
												 	'title' => strtolower($product->name)
												 ];
												 ?>
												<?=image_thumb(product_img_url($image->name), 300, $attr)?>
												<span class="card-title"><?=$product->name?></span>
											</div>
											<?php endif ?>
										<?php endforeach ?>
										<div class="card-content hide show-on-print">
											<?=$product->name?>
										</div>
									</div>
								</a>
							</div>
					<?php endforeach ?>
				</div>
		</div><!-- end col-right -->

		<?php endif ?>
	</div><!-- end row -->

</div>

<?php $this->load->view('partials/photoswipe') ?>

<?php $this->load->view('partials/footer') ?>

<script src="<?=script_url('imagesloaded.pkgd.min.js')?>"></script>
<script src="<?=script_url('owl.carousel.min.js')?>"></script>
<script src="<?=script_url('owl.carousel2.thumbs.js')?>"></script>

<?php $this->load->view('partials/scripts/select-size') ?>

<script>

  $(document).ready(function(){
  	var $primary = $('#primary-image');
  	var $images = $primary.find('img');
    var $targetfigure;
    var timer;
    var delay = 700;

    $('ul.tabs').tabs()
    // $('.collapsible').collapsible();

    $('.zooming-icon').show();

    getImageHeight();

  	$(window).resize(getImageHeight);

    $('#slide').owlCarousel({
      loop:true,
      responsive : {
      	0 : {
      		items : 4
      	},
      	480 : {
      		items : 5
      	},
      	992 : {
      		items : 5
      	}
      },
      autoplay:true,
      autoplayHoverPause:true,
      margin: 10
    });

    // preparing data for photoswipe
  	$('.picture').each( function() {
    	var $pic     = $(this);
      var getItems = function() {
            var items = [];
            $pic.find('a').each(function() {
                var $href   = $(this).attr('href'),
                    $size   = $(this).data('size').split('x'),
                    $width  = $size[0],
                    $id  = $(this).data('id'),
                    $name = $(this).closest('figure').data('name'),
                    $height = $size[1];
 
                var item = {
                		id : $id,
                		pid : $name,
                    src : $href,
                    w   : $width,
                    h   : $height
                }
 
                items.push(item);
            });
            return items;
        }
 			// store data
	    items = getItems();

	    // photoswipe action
	    var $pswp = $('.pswp')[0];
			$pic.on('click', 'figure', function(event) {
			    event.preventDefault();
			     
			    var $index = $(this).index();
			    var options = {
			        index: $index,
			        bgOpacity: 0.8,
			        showHideOpacity: true
			    }
			     
			    // Initialize PhotoSwipe
			    var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
			    lightBox.init();
			});
		});
    
    	var loader = '<figure class="loader"><img src="/assets/vendor/pswp/default-skin/preloader.gif"></figure>';
    	var $item;
    	var data;
    	var isClicked = false;
    	var target = '';

    $('.owl-item').hover(function(e){
    	$item = $(this).find('.item');
    	hoverImageToPrimary($item)
    }, leaveHover);

    $('.collapsible .collapsible-body').find('.item').hover(function(){
    	$item = $(this);
    	hoverImageToPrimary($item)
    }, leaveHover);

    function hoverImageToPrimary(selector){
    	target = selector.data('target');

    	if(target == '') return false;

    	data = {
    		target : target,
    		src : selector.children().data('original')
    	}

    	$targetfigure = $primary.find('#'+data.target);

    	if($targetfigure.hasClass('active'))return;

    	// Hover with delay
    	// see more http://stackoverflow.com/a/15576031
    	if($targetfigure.find('img').attr('src') == '' )
    	{
    		$('.picture').prepend(loader);
    		timer = setTimeout(function(){
    			actionHoverImage(selector);
    		}, delay);
    	}
    	else{
    		timer = setTimeout(function(){
    			actionHoverImage(selector);
    		}, 300);
    	}
    }

    function leaveHover(){
    	if(!isClicked)
    	{
    		if(target == '') return false;
    		$('.loader').remove();
    		// cegah jika gambar sudah primary
    		if($targetfigure.hasClass('active')) return;
    		$targetfigure.css({'z-index':0, 'display':'none'});
    	}
    	clearTimeout(timer);
    }

    function actionHoverImage(selector)
    {
  		$targetfigure.find('img').attr('src', data.src);
  		$targetfigure.find('img').attr('data-src', data.src);
  			$('.loader').remove();
  		$primary.imagesLoaded(function(){
  			$targetfigure.css('z-index', 99);
  			$targetfigure.fadeIn(250);
  		});
  		isClicked = false;
  		// bind image to primary with click
  		selector.click(function(){
  			// reset
    		$primary.find('figure').css('z-index', 0);
    		$primary.find('figure').removeClass('active');
    		$primary.find('figure').hide();
  			isClicked = true;
    		// set
  			$targetfigure.addClass('active');
  			$targetfigure.css('z-index', 1);
  			$targetfigure.show();
  		});
  	}

  	// get max figure height
	  function getImageHeight(){
	  	var maxHeight;
	  	$primary.imagesLoaded(function(elm){
		  	$.each(elm.images, function(i, image){
		  		if(image.isLoaded && $(image.img).closest('figure').hasClass('active'))
		  		{
		  			maxHeight = $(image.img).height() + 10; // plus 10 for padding bottom
		  			console.log(maxHeight)
	  				$primary.css('min-height', maxHeight+'px');
	  				if(maxHeight){
	  					$primary.closest('.card-panel').css('border', '1px solid #ddd');
	  				}
		  			return maxHeight;
		  		}
		  	});
		  });
	  }

  });



</script>
</body>
</html>