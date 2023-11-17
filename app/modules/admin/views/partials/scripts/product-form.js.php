<script>
	var global = {
		inputCode : $('#code').val(),
		timeout: null
	};

	$(document).ready(function(){
		var progress = $('#top-progress');
		var selectSub = $('#select-subcategories');
		var selectCat = $('#select-categories');
		var inputCode = $('#code');

		// page : admin/catalog/products/add
		selectCat.change(function()
		{
			var id = selectCat.val();
			var options = '<option value="" selected disabled>--Subcategory--</option>';
			selectCat.attr('disabled', 'disabled');
			$.post('/admin/catalog/subcategories/json', {act:'subcategories', id:id}, function(data)
			{
				selectCat.removeAttr('disabled');
				console.log(data);
				$.each(JSON.parse(data), function(i, subcategory)
				{
					options += '<option value="'+subcategory.id+'">'+subcategory.name+'</option>';
				});
				selectSub.html(options)
								.removeAttr('disabled')
								.attr('required', 'required');
								// .material_select();
			});
		});

		// $('#add-product').submit(function(e)
		// {
		// 	progress.show();
		// 	$.post('/admin/catalog/add', $(this).serialize(), function(data){
		// 		progress.hide();
		// 		if(data){
		// 			location.href = '/admin/catalog/edit/'+data
		// 		}
		// 	})
		// 	e.preventDefault();
		// });

		/*
		 * VALIDATE UNIQUE CODE
		 * ref : http://stackoverflow.com/a/1909490
		 */
		inputCode.keyup(function() {
		  if (global.timeout != null) {
		    clearTimeout(global.timeout);
		  }

		  if (global.inputCode != inputCode.val()) {
			  global.timeout = setTimeout(function() {
			    global.timeout = null;  
			    //ajax code
			    $.post('/admin/catalog/code', {code:inputCode.val().toUpperCase()}, function(data){
			    	// available
			    	if(data){
			    		inputCode.closest('.input-field').removeClass('error');
			    		inputCode.find('.info-field').remove();
			    	}
			    	// not available
			    	else{
			    		inputCode.closest('.input-field')
			    		.addClass('error')
			    	}
			    })
			  }, 500);  
		  }
		});


		$('#add-related-item').select2({
			placeholder : 'Select item to add related items',
			tags : true,
			allowClear : true,
		});

		$('#is_enabled').find('.switch').find('input[type="checkbox"]').change(function(){
			var value = $(this).prop('checked') ? 1 : 0;
			console.log(value)
			$(this).closest('.switch').find('input[type="hidden"]').val(value);
		});
		// activing promo
		$('#is_promo').find('.switch').find('input[type="checkbox"]').change(function(){
			var value = $(this).prop('checked') ? 1 : 0;
			console.log(value)
			$(this).closest('.switch').find('input[type="hidden"]').val(value);
		});
		// switch enabling IMAGE
		$('.enabling').find('input').change(function(){
			var value = $(this).prop('checked') ? 1 : 0;
			$(this).closest('.enabling').find('input[type="hidden"]').val(value);
		});


	});
</script>