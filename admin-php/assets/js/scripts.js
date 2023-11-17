function opacitized(){
	console.log('changed')
	var $this = $(this);
	var $material = $this.closest('.material');
	// if checked
	if($this.prop('checked'))
	{
		$material.removeClass('inactive').addClass('active')
	}
	else{
		$material.removeClass('active').addClass('inactive')
	}
}