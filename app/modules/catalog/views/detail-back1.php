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
      <a href="/furniture/<?=$product->slug?>-<?=$product->code?>" class="breadcrumb"><?=ucwords(strtolower($product->name))?></a>
    </div>
  </div>
</nav>

<div class="container" id="product-detail-container">
	<div class="row">

		<div class="col s12 m6 push-m6 l4 push-l5" style="margin-bottom:30px">
			<div class="divider"></div>
			<h5 data-id="<?=$product->id?>"><?=$product->name?> 

				<?php if ($product->prices['promo'] && false ): // remove false if enabling ?>
				<a title="More Promo" href="/malaysia-furniture-promotions"><span class="badge teal white-text z-depth-2">Promo</span></a>
				<?php endif ?>

			</h5>
			<div class="divider"></div>
			<?php if (count($product->prices) > 0): ?>
			<div class="section price-label">
				<span style="font-size:18px"><i class="mdi-action-label small grey-text text-darken-1 left"></i><?=$price?></span>
				<?php if ($product->is_promo && $product->prices['promo_note']): ?>
				<div><i class="material-icons grey-text text-darken-1 left">info</i><?=$product->prices['promo_note']?></div>
				<?php endif ?>
			</div>
			<?php endif ?>

			<?php if ($product->code): ?>
				<div class="section">
					<span class="grey-text text-darken-1">Code:</span>
					<br>
					<span><?=$product->code?></span>
				</div>
			<?php endif ?>

			<?php if ($product->description): ?>
			<div class="section">
				<span class="grey-text text-darken-1">Description:</span>
				<br>
				<?=$product->description?>
			</div>
			<?php endif ?>

			<?php if ($product->dimension): ?>
			<div class="section">
				<span class="grey-text text-darken-1">Dimension:</span>
				<br>
				<?=$product->dimension?>
			</div>
			<?php endif ?>

		</div>

		<div class="col s12 m6 pull-m6 l5 pull-l4" id="images-showcase">
			<?php $image = $product->images[0]->toArray() ?>
			<div class="card-panel">
				
				<div id="primary-image">
			  	<div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
			  		<?php foreach ($product->images as $key => $image): ?>
			  		<?php
			  			$primary = $image->is_primary || $key == 0 ? 1 : 0;

			  			$zIndex = $primary ? count($product->images) : $key;
			  			$isActive = $primary ? 'active' : '';
			  			$display = $primary ? 'block' : 'none';
			  			$options = array_merge($attr, ['itemprop'=>'thumbnail']);

			  			$options['data-src'] = $primary ? base_url().product_img_url($image->name) : 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAWgBaAAD/4gxYSUNDX1BST0ZJTEUAAQEAAAxITGlubwIQAAB...';
			  			// $options['src'] = $primary ? base_url().product_img_url($image->name) : '';
			  		?>
					  <figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" data-name="<?=$image->name?>" data-id="<?=$image->id?>"  style="z-index:<?=$zIndex?>;display:<?=$display?>" class="image-<?=$image->id?> <?=$isActive?>">
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
			      <div class="item" data-image-id="<?=$image->id?>">
						<?php
							update_to_lower($image->id, $image->name);
							$options = ['data-original'=>base_url().product_img_url($image->name)];
						?>
						<?php echo image_thumb(product_img_url($image->name), 100, $options);?>
			      </div>
					<?php endforeach ?>
				</div>
			</div>
		</div>

		<?php if(count($product->relations)): ?>
		<div class="col s12 l3" id="related-items">
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
		</div>
		<?php endif ?>
		
	</div><!-- end row -->
</div>

<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="pswp__bg"></div>
    <div class="pswp__scroll-wrap">
 
        <div class="pswp__container">
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>
 
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>
            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>
        </div>
    </div>
</div>


<?php $this->load->view('partials/footer') ?>

<script src="<?=script_url('imagesloaded.pkgd.min.js')?>"></script>
<script src="<?=script_url('owl.carousel.min.js')?>"></script>
<script src="<?=script_url('owl.carousel2.thumbs.js')?>"></script>
<script src="<?=assets_url('/vendor/pswp/photoswipe.min.js')?>"></script>
<script src="<?=assets_url('/vendor/pswp/photoswipe-ui-default.min.js')?>"></script>
<script>

  $(document).ready(function(){
  	var $primary = $('#primary-image');
  	var $images = $primary.find('img');
    var $targetfigure;
    var timer;
    var delay = 700;

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
                    h   : $height,
                }
 
                items.push(item);
            });
            return items;
        }
 
	    items = getItems();

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

    $('.owl-item').hover(function(){
    	$item = $(this).find('.item');
    	data = {
    		id : $item.data('image-id'),
    		src : $item.find('img').data('original')
    	}
    	$targetfigure = $primary.find('.image-'+data.id);

    	if($targetfigure.hasClass('active')) return;
    	// Hover with delay
    	// see more http://stackoverflow.com/a/15576031
    	if($targetfigure.find('img').attr('src') == '' )
    	{
    		$('.picture').prepend(loader);
    		timer = setTimeout(hoverImage, delay);
    	}
    	else{
    		timer = setTimeout(hoverImage, 300);
    	}
    }, function(){
    	if(!isClicked)
    	{
    		$('.loader').remove();
    		// cegah jika gambar sudah primary
    		if($targetfigure.hasClass('active')) return;
    		$targetfigure.css({'z-index':0, 'display':'none'});
    	}
    	clearTimeout(timer);
    });

    function hoverImage()
    {
    	if($item.is(':hover'))
    	{
    		// cegah jika gambar sudah primary
    		
    		$targetfigure.find('img').attr('src', data.src);
    		$targetfigure.find('img').attr('data-src', data.src);
    			$('.loader').remove();
    		$primary.imagesLoaded(function(){
    			$targetfigure.css('z-index', 99);
    			$targetfigure.fadeIn(250);
    		});
    		isClicked = false;
    		// bind image to primary with click
    		$item.click(function(){
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