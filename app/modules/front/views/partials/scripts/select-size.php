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