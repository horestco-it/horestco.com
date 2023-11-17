<script src="<?=script_url('imagesloaded.pkgd.min.js')?>"></script>
<script src="<?=script_url('owl.carousel.min.js')?>"></script>
<script src="<?=script_url('owl.carousel2.thumbs.js')?>"></script>
<script>
	$(document).ready(function(){

		//////////////////
    // select sizes //
    //////////////////
    $.getJSON('<?=$_SERVER["REQUEST_URI"]?>?action=get-sizes', selectSize);
    
    function selectSize(data){

	    var $html = {
	    	dimension : $('.section.dimension').find('.value'),
	    	priceLabel : $('.section.price-label').find('.value'),
	    	note : $('.section.note'),
	    	size_id : $('input#size_id'),
	    };

	    $('#search-size').change(function(){
	    	var id = $(this).val();
	    	var size;

		    $.each(data, function(i, dataSize){
		    	if( dataSize.id == id )
		    	{
		    		size = dataSize;
		    	}
		    });

			  // result
		    $html.dimension.html(size.dimension);
		    $html.note.find('.value').html(size.prices.promo_note);
		    $html.priceLabel.html(size.prices.normal);
		    $html.size_id.attr('value', size.id);

		    // manage promo
		    if( parseInt(size.prices.is_promo) == 1 )
		    {
		    	$html.priceLabel.next().html(size.prices.promo);

		    	if( !$html.priceLabel.hasClass('text-del') )
		    		$html.priceLabel.addClass('text-del')
		    }
		    else{
		    	$html.priceLabel.next().empty();
		    	$html.priceLabel.removeClass('text-del');
		    }
		    // manage note
		    if( size.prices.promo_note == '' )
		    {
		    	if( !$html.note.hasClass('hide') )
		    		$html.note.addClass('hide');
		    }
		    else{
		    	$html.note.removeClass('hide')
		    }
		    
	    });
    }
    // end select size
	});
</script>

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
			        showHideOpacity: true,
							shareButtons: [
								{id:'whatsapp', label:'Whatsapp', url:'https://wa.me/60162240799?text={{url}}'},
								{id:'facebook', label:'Share on Facebook', url:'https://www.facebook.com/sharer/sharer.php?u={{url}}'},
								{id:'twitter', label:'Tweet', url:'https://twitter.com/intent/tweet?text={{text}}&url={{url}}'},
								{id:'pinterest', label:'Pin it', url:'http://www.pinterest.com/pin/create/button/'+
																	'?url={{url}}&media={{image_url}}&description={{text}}'},
								{id:'download', label:'Download image', url:'{{raw_image_url}}', download:true}
							],
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

    // hover action in thumbnail
    $('.owl-item').hover(function(e){
    	$item = $(this).find('.item');
    	hoverImageToPrimary($item)
    }, leaveHover);

    ////////////////////////
    // action in material //
    ////////////////////////
    $('.material-lists').find('.item').each(function(){
      $(this).hover(function(e){
        hoverImageToPrimary($(this));
      }, leaveHover);
    });

    function hoverImageToPrimary(selector){

      data = {
        target : selector.data('target'),
        src : selector.children().data('original')
      }

    	if(data.target == '' || data.target == 'image-') return false;

      $targetfigure = $primary.find('#'+data.target);

    	if($targetfigure.hasClass('active'))return;

    	// Hover with delay
    	// see more http://stackoverflow.com/a/15576031
    	if($targetfigure.find('img').attr('src') == '' )
    	{
    		$('.picture').prepend(loader);
    		timer = setTimeout(function(){
    			actionHoverImage_(selector);
    		}, delay);
    	}
    	else{
    		timer = setTimeout(function(){
    			actionHoverImage_(selector);
    		}, 300);
    	}
    }

    var classActive = {'z-index':99, 'opacity':1};
    var classDisable = {'z-index':0, 'opacity':0};

    function leaveHover(){
      if(!isClicked)
      {
        if(data.target == '' || data.target == 'image-') return false;
        $('.loader').remove();
        // cegah jika gambar sudah primary
        if($targetfigure.hasClass('active')) return;
        $targetfigure.css(classDisable);
      }
      clearTimeout(timer);
    }

    function actionHoverImage_(selector)
    {

      $targetfigure.find('img').attr('src', data.src);
      $targetfigure.find('img').attr('data-src', data.src);
        $('.loader').remove();
      $primary.imagesLoaded(function(){
        $targetfigure.css(classActive);
        $targetfigure.fadeIn(250);
      });
      isClicked = false;
      // bind image to primary with click
      
    }
    
  	// get max figure height
	  function getImageHeight(){
	  	var maxHeight;
	  	$primary.imagesLoaded(function(elm){
		  	$.each(elm.images, function(i, image){
		  		if(image.isLoaded && $(image.img).closest('figure').hasClass('active'))
		  		{
		  			maxHeight = $(image.img).height() + 10; // plus 10 for padding bottom
		  			// console.log(maxHeight)
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
