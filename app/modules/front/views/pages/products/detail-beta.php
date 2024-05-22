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
		border: 1px solid #ddd;
		margin-top: 0;
		padding: 10px;
		border-radius: 0;
	}
	#primary-image{
		position: relative;
		height: 305px;
		overflow: hidden;
		margin-bottom: .6rem;
	}
	figure{
		margin: 0;
		opacity: 0;
		z-index: 0;
		-webkit-transition: opacity .3s ease-in-out 0s;
		-moz-transition : opacity .3s ease-in-out 0s;
		-o-transition : opacity .3s ease-in-out 0s;
		transition: opacity .3s ease-in-out 0s;
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
	figure.active{
		opacity: 1;
		z-index: 1;
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
	#search-size{
		height: 2.3rem;
		padding: 3px;
	}
	.coret{
		text-decoration: line-through;
	}
	.promo-price{
		color: red;
		font-family: 'Comic Sans MS', cursive, sans-serif;
		font-size: 120%;
	}
	</style>
</head>
<body>

<?php $this->load->view('partials/nav.php') ?>
<?php 

if( $product->sizes()->count() > 0 )
{
	$product->size = $product->sizes()->orderBy('sort_order')->first();
	$product->prices = $product->size->prices()->first();
	// select box
	$product->sizes = $product->sizes()->where('is_enabled', 1)->get();
}
// price label
$call = '<a href="tel:+628551069988"><span style="color:#29b6f6">Call</span></a>';
$price = new stdClass();
// promo or not
$isPromo = $product->prices->is_promo;
$gap = "<span class=\"gap gap-2\"></span>";
$promoPrice  = "<span class=\"coret\">{$product->prices->normal}</span>".$gap;
$promoPrice .="<span class=\"promo-price\">{$product->prices->promo}</span>";
$price->retail  = $currency.$gap;
$price->retail = $isPromo ? $price->retail.$promoPrice : $price->retail."<span class>{$product->prices->normal}</span>";

$product->prices->normal = (int)$product->prices->normal == 0  ? $call : $price->retail;
// response data to javascript


 ?>
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
		<div class="col s12 <?php if(count($product->relations)) echo "l9"?> col-left">
			<div class="row">
				<div class="col s12 m6 push-m6 l6 push-l6" style="margin-bottom:30px">

					<div class="divider"></div>

					<h5 data-id="<?=$product->id?>"><?=$product->name?> 
						<?php if ($product->prices->promo && false ): // remove false if enabling ?>
						<a title="More Promo" href="/malaysia-furniture-promotions"><span class="badge teal white-text z-depth-2">Promo</span></a>
						<?php endif ?>
					</h5>

					<div class="divider"></div>

					<?php if ($product->sizes->count() > 0): ?>
					<div class="section size">
						<select class="browser-default" id="search-size">
							<?php foreach ($product->sizes as $key => $size): ?>
							<option value="<?=$size->id?>" <?php if($size->id == $product->size->id) echo "selected"; ?> ><?=ucwords($size->name)?></option>
							<?php endforeach ?>
						</select>

					</div>
					<?php endif ?>

					<div class="section price-label">
						<span class="fa-stack"><i class="fa fa-tag grey-text"></i></span>
						<span class="value"><?=$product->prices->normal?></span>
					</div>

					<?php if ($product->prices->promo_note): ?>
					<div class="section note" style="padding-top:0">
						<span class="fa-stack"><i class="fa fa-info-circle grey-text"></i></span>
						<span class="value"><?=$product->prices->promo_note?></span>
					</div>
					<?php endif ?>

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

					<?php if ($product->size->dimension): ?>
					<div class="section dimension">
						<span class="grey-text text-darken-1">Dimension:</span>
						<br>
						<span class="value"><?=$product->size->dimension?></span>
					</div>
					<?php endif ?>
				</div><!-- end product text -->

				<div class="col s12 m6 pull-m6 l6 pull-l6" id="images-showcase">
					<?php $image = $product->images[0]->toArray() ?>
					<div class="card-panel">
						
						<div id="primary-image">
					  	<div class="picture" itemscope itemtype="http://schema.org/ImageGallery">
					  		<figure class="loader"><img src="/assets/vendor/pswp/default-skin/preloader.gif"></figure>
					  		<?php foreach ($product->images as $key => $image): ?>
					  		<?php
					  			$options = array_merge($attr, ['itemprop'=>'thumbnail']);
					  			$options['data-src'] = (int)$image->is_primary ? base_url().product_img_url($image->name) : 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEAWgBaAAD/4gxYSUNDX1BST0ZJTEUAAQEAAAxITGlubwIQAAB...';
					  			$options['data-lazy'] = (int)$image->is_primary == 1 ? false : true;
					  		?>
							  <figure id="image-<?=$image->id?>" 
							  				data-name="<?=$image->name?>" 
							  				itemprop="associatedMedia" 
							  				itemscope itemtype="http://schema.org/ImageObject" 
							  				data-id="<?=$image->id?>"  
							  				class="image-<?=$image->id?> <?php if( (int)$image->is_primary == 1 ) echo 'active'?>">
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
													<img class="z-depth-1 responsive-img" width="80" src="<?=base_url().img_url('material/'.$material['id'].'-'.Str::slug($material['name']).'.jpg')?>">
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

    $.get('<?=$_SERVER["REQUEST_URI"]?>?action=get-sizes', selectSize);
    
    function selectSize(data){
    	var sizes = JSON.parse(data);

	    var $html = {
	    	dimension : $('.section.dimension').find('.value'),
	    	priceLabel : $('.section.price-label').find('.value'),
	    	note : $('.section.note').find('.value'),
	    };

	    $html.gap = '<span class="gap gap-2"></span>';
	    $html.call = '<a href="tel:+628551069988"><span style="color:#29b6f6">Call</span></a>';
	    $html.currency = '<span class="grey-text"><?=$currency?></span>';
	    $html.retail = $html.currency + $html.gap;


	    $('#search-size').change(function(){
	    	var id = $(this).val();
	    	var size;
		    $.each(sizes, function(i, dataSize){
		    	if( dataSize.id == id )
		    	{
		    		size = dataSize;
		    	}
		    });

	    	var promo  = '<span class="coret">'+size.prices.normal+'</span>'+$html.gap;
	    			promo += '<span class="promo-price">'+size.prices.promo+'</span>';
		    var price = parseInt(size.prices.is_promo) == 1 ? $html.retail + promo : $html.retail+'<span>'+size.prices.normal+'</span>';
			  var value = {
			  	dimension : size.dimension,
			  	note : size.prices.promo_note,
			  	price : parseInt(size.prices.normal) == 0 ? $html.call : price,
			  };

			  // result
		    $html.dimension.html(value.dimension);
		    $html.note.html(value.dimension);
		    $html.priceLabel.empty();
		    $html.priceLabel.html(value.price);
	    });
    }
    // end select size

    $('ul.tabs').tabs()

    $('.zooming-icon').show();

    // getImageHeight();
  	// $(window).resize(getImageHeight);


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
    
  	var loader = '<figure class="loader active"><img src="/assets/vendor/pswp/default-skin/preloader.gif"></figure>';
  	var $item;
  	var data;
  	var isClicked = false;
  	var target = '';
  	var $activeFigure;

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


    	$primary.find('figure').each(function(){
    		if($(this).hasClass('active'))
    		{
    			$activeFigure = $(this)
    		}
    	});

    	// prevent if current
    	if($targetfigure.hasClass('active'))
    	{
    		return;
    	}
    	// if has url in src make loader
    	if ($targetfigure.find('img').attr('src') == '')
    	{
    		$('.loader').css('opacity',1);
    	}

    	// Hover with delay
    	// see more http://stackoverflow.com/a/15576031
    	if($targetfigure.find('img').attr('src') == '' )
    	{
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
    		$('.loader').css('opacity', 0);
    		// cegah jika gambar sudah primary
    		if($activeFigure.hasClass('active')) return;

    		$activeFigure.addClass('active');
    		$targetfigure.removeClass('active');
    	}
    	clearTimeout(timer);
    }

    function actionHoverImage(selector)
    {
  		$targetfigure.find('img').attr('src', data.src);
  		$targetfigure.find('img').attr('data-src', data.src);
  		
  		$primary.imagesLoaded(function(){
  			$('.loader').css('opacity', 0);
  			// reset
    		$activeFigure.removeClass('active');
  			$targetfigure.addClass('active');
  		});
  		isClicked = false;
  		// bind image to primary with click
  		selector.click(function(){
  			// reset
    		$primary.find('figure').removeClass('active');
  			isClicked = true;
    		// set
  			$targetfigure.addClass('active');
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