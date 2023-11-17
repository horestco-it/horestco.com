<script src="<?=script_url('imagesloaded.pkgd.min.js')?>"></script>

<script>
	var card = $('.card');
 
	$(document).ready(function(){
		// set height card onload
		card.imagesLoaded(function(target){
  		setMaxHeight($(target.elements));
	  });

		// set height card on resize
		$(window).resize(function(e){
			setMaxHeight(card);
		});

	});


	function imageSize(){
		var height = $('#image-1').innerHeight()+1;
		var width = $('#image-1').innerWidth()+1;
		var res = $('.lazy').height(height).width(width);
	}

	function setMaxHeight(selector){
		selector.height('');
		var maxHeight = 0;
  	selector.each(function(i, elm){
  		var height = $(elm).innerHeight();
  		if(maxHeight < height)
  		{
  			maxHeight = $(elm).innerHeight();
  		}
  	});

  	selector.height(maxHeight);
	}

</script>