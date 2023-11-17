<section class="section">

	<div class="container">

	<?php if($this->uri->segment(5) == 'preview' ): ?>
	<div class="col s12">
		<div class="card-panel card-panel-title grey lighten-3 grey-text">
			<h5>
			This page is preview
			<a href="/admin/catalog/edit/<?=$product->id?>" id="go-to-edit" title="edit">
				<i class="mdi-image-edit small"></i> 
			</a>
			</h5> 
		</div>
	</div>
	<?php endif?>

	<form class="col s12" id="edit-product" action="?" method="post">
		<div class="row card-panel">
			<div class="card-panel card-panel-title green z-depth-0">
				<h5>Basic Information</h5>
			</div>
			<div class="col s12">
					
					<div class="row">
						<input type="hidden" name="id" class="basic" value="<?=$product->id?>">

						<div class="col s12 m6 input-field">
		          <select id="select-categories" name="category_id" class="browser-default basic validate" required>
		          		<option value="" disabled selected>- - Category/Area - -</option>
		          	<?php
		          		foreach ($categories as $key => $category) {
		          			$selected = $category->id == $product->category_id ? 'selected' : null;
		          			echo "<option value=\"$category->id\" $selected> $category->name [$category->slug] </span></option>";
		          		}
		          	?>
		          </select>
		          <label for="select-categories" class="active">Category</label>
		        </div>

		        <div class="col s12 m6 input-field">
		          <select id="select-subcategories" name="subcategory_id" class="browser-default basic validate">
		          	<option value="" disabled>- - Subcategory - -</option>
		          	<?php foreach ($subcategories as $key => $subcategory): ?>
		          		<option value="<?=$subcategory->id?>" <?php if($subcategory->id == $product->subcategory_id) echo "selected"?> ><?=$subcategory->name?></option>
		          	<?php endforeach ?>
		          </select>
		          <label for="select-subcategories" class="active">Subcategory</label>
		        </div>

		        <div class="col s12 m6 input-field">
		        	<input type="text" id="name" name="name" class="basic validate" value="<?=$product->name?>" placeholder="Name" required>
		        	<label for="name" class="active">Name:</label>
		        </div>

		        <div class="col s12 m6 input-field">
		        	<input type="text" id="code" name="code" class="basic validate" value="<?=$product->code?>" placeholder="Code" required>
		        	<label for="code" class="active">Code:</label>
		        	<div class="info-field red-text"></div>
		        </div>

		        <div class="col s12 m6 input-field">
		        	<textarea name="description" class="browser-default materialize-textarea basic validate" id="description"><?=$product->description?></textarea>
		        	<label for="description" class="active">Description:</label>
		        </div>

		        <div class="col s12 m6 input-field">
		        	<textarea name="dimension" class="materialize-textarea basic validate" id="dimension"><?=$product->dimension?></textarea>
		        	<label for="dimension" class="active">Dimension:</label>
		        </div>

		        <div class="col s12 submit">
		          <button  id="submit" class="btn-floating btn-large fixed waves-effect waves-light blue darken-3" disabled>update</button>
		          <!-- <button  id="submit" class="btn-floating btn-large fixed waves-effect waves-light blue darken-3" name="submit" type="submit">update</button> -->
		        </div>
					</div><!-- end row basic -->


					<div class="row" id="is_enabled">
						<div class="card-panel card-panel-title grey lighten-3 z-depth-0">
							<h5>Active Product</h5>
						</div>
						<div class="switch">
		      		<label>
		      			Off
		      			<input type="checkbox" <?php if($product->is_enabled) echo "checked"; ?>>
		      			<span class="lever"></span>
		      			On
		      		</label>
		      		<input type="hidden" class="basic validate" name="is_enabled" value="<?=$product->is_enabled?>">
		      	</div>
					</div>

					<div class="row" id="is_promo">
						<div class="card-panel card-panel-title grey lighten-3 z-depth-0">
							<h5>Set Promotion</h5>
						</div>
	        	<!-- Switch -->
	        	<div class="switch">
	        		<label>
	        			Off
	        			<input type="checkbox" <?php if($product->is_promo) echo "checked"; ?>>
	        			<span class="lever"></span>
	        			On
	        		</label>
	        		<input type="hidden" class="basic validate" name="is_promo" value="<?=$product->is_promo?>">
	        	</div>
					</div>
					<div class="row pricing">
						<div class="card-panel card-panel-title grey lighten-3 z-depth-0">
							<h5>Pricing</h5>
						</div>

						<input type="hidden" name="id" class="prices" value="<?=$prices['id']?>">
						<?php foreach ($prices as $key => $price): ?>
							<?php
							if (
								 $key == 'normal'
							|| $key == 'promo'
							|| $key == 'promo_note'
							|| $key == 'promo_description'
							|| $key == 'export'
							|| $key == 'project'
								): 
							?>
								
								<div class="col s12 m6 input-field">
									<input type="text" name="<?=$key?>" class="prices" id="<?=$key?>" value="<?=$price?>">
									<label for="<?=$key?>" class="active">
										<?=ucwords(str_replace('_', ' ', $key))?>
										<?php if ($key != 'promo_description' && $key != 'promo_note'): ?>
										( MYR )
										<?php endif ?>
									</label>
								</div>

							<?php endif ?>
						<?php endforeach ?>
					</div><!-- end row pricing -->

			</div>
		</div>


		</form>

		<div class="row card-panel">
			<div class="card-panel card-panel-title green z-depth-0">
				<h5>Photos</h5>
			</div>
				<form  class="col s12" action="/admin/upload/do_upload"  id="form-upload-images" method="post" enctype="multipart/form-data">
					<input type="hidden" name="pid" value="<?=$product->id?>">
					<div id="drop" class="card-panel z-depth-0 center" style="border:1px dotted #ddd;min-height: 150px">
						<h5 class="grey-text">Drop Here</h5>
						<div class="file-field input-field center">
				      <div class="btn btn-small grey">
				        <span>BROWSE</span>
				        <input type="file" name="files" id="upload-images" multiple>
				      </div>
				    </div>

				    <div id="result" style="margin-top:2rem"></div>
					</div>
				</form>


<!-- ===================================================== -->
			<div class="col s12" id="images-draggable">
				<?php foreach ($product->images as $key => $image): ?>
					<div class="card draggable item" data-image="<?=$image->id?>" id="image-<?=$image->id?>">
						<div class="row">
							<div class="col xs12 s4 card-image">
								<?=image_thumb(product_img_url($image->name), 200);?>
								<input type="hidden" name="id" class="images-<?=$key?>" value="<?=$image->id?>">
							</div>
							<div class="col xs12 s6 card-content">
								<ul>
									<li class="enabling">
										<!-- Switch -->
									  <div class="switch">
									    <label>
									      Disable
									      <input type="checkbox" <?php if($image->is_enabled) echo "checked"; ?>>
									      <span class="lever"></span>
									      Enable
									    </label>
									  	<input type="hidden" name="is_enabled" class="images-<?=$key?>" value="<?=$image->is_enabled?>">
									  </div>
									</li>
									<li><span class="gap-5"></span></li>
									<li class="sort_order editable">
										<span class="grey-text">sort order:</span>
										<span class="gap-5"></span>
										<span class="text blue-text" title="Click to Edit"><?=$image->sort_order?></span>
									  <input type="hidden" name="sort_order" min="1" class="images-<?=$key?>" style="width:20%" value="<?=$image->sort_order?>">
									</li>
									<li class="name editable">
										<span class="grey-text">Name:</span>
										<span class="gap-5"></span>
										<span class="text blue-text" title="Click to Edit text"><?=$image->name?></span>
									  <input type="hidden" name="name" class="images-<?=$key?>" value="<?=$image->name?>">
									</li>
									<li class="alt editable">
										<span class="grey-text">Alt: </span>
										<span class="gap-5"></span>
										<span class="text blue-text" title="Click to Edit text"><?=$image->alt?></span>
										<input type="hidden" name="alt" class="images-<?=$key?>" value="<?=$image->alt?>">
									</li>
									<li class="verify editable hide">
										<span class="grey-text">Status: </span>
										<span class="gap-5"></span>
										<span class="text blue-text" title="Click to Edit text"><?=$image->is_verified?></span>
										<input type="hidden" name="is_verified" class="images-<?=$key?>" value="<?=$image->is_verified?>">
									</li>
									<li>
										
									</li>
								</ul>
							</div>
							<div class="col xs12 s2 card-control center">
								<ul>
									<li><a href="#confirm-delete" class="modal-trigger delete">Delete</a></li>
								</ul>
							</div>
						</div>

					</div>
				<?php endforeach ?>
			</div>
		</div><!-- end row image -->

		<div class="row card-panel related-item">
			<div class="card-panel card-panel-title green z-depth-0">
				<h5>Related Items</h5>
			</div>

			<div class="col s12 input-field" style="margin-bottom:2rem">
				<select name="" id="add-related-item" class="" multiple="multiple" style="width:100%;height:auto">
				<?php 
					foreach ($products as $sub) {
						echo "<optgroup label=\"".strtoupper($sub->name)."\">";
						foreach ($sub->products as $product){
							$selected = in_array($product->id, $relationIds) ? "selected" : null;
							echo "<option value=\"$product->id\" $selected >".ucwords(strtolower($product->name))."</option>";
						}
						echo "</optgroup>";
					}
				 ?>
				</select>
			</div>
			<div class="col s12">
				<div class="row">
				<?php echo $relations ?>
				</div>
			</div>
		</div>

	</div>

</section>

<div id="confirm-delete" data-id="" class="modal">
  <div class="modal-content">
  	<h5>Remove Photo</h5>
    <p>Are you sure delete this photo?</p>
  </div>
  <div class="modal-footer">
    <button class="btn red modal-action waves-effect waves-red agree-delete">Agree</button>
    <a href="javascript:void(0)" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
  </div>
</div>

<?php $this->load->view('partials/scripts/product-form.js.php') ?>


<script src="<?=script_url('packery.pkgd.min.js')?>"></script>
<script src="<?=assets_url('/vendor/jquery.ui.widget.js')?>"></script>
<script src="<?=script_url('jquery.iframe-transport.js')?>"></script>
<script src="<?=script_url('jquery.tmpl.min.js')?>"></script>
<script src="<?=script_url('jquery.fileupload.js')?>"></script>
<script>  
</script>
<?php if($this->uri->segment(5) == 'preview' ): ?>
<script>
	$('input,select,textarea,a,button').attr('disabled', 'disabled');
</script>
<?php endif?>
>

<script>

	$(document).ready(function(){
		var $container = $('#images-draggable');
		var $images = $container.find('.item');
		var $modalDelete = $('#confirm-delete')
		var $btnUpdateImage = $('#update-image');
		var $submitBtn = $('#submit');
		var data = {};
		var imageId = '';
		var $imgJson = $('#image-json');
		var url = '<?=base_url()?>admin/catalog/update';
		var $uploadImages = $('#upload-images');
		var $formUploadImages = $('#form-upload-images');

		// init();

		$('#edit-product').submit(function(e){
			e.preventDefault();
			init();
			// console.log(JSON.stringify(data));return;
			$.post(url, {data:JSON.stringify(data)}, function(data){
				// console.log(data);
				location.reload();
			});
		});

		$('.prices, .basic').each(function(i, field){
			$(field).keyup(function(){
				setTimeout(function(){
					init();
				}, 300);
			});
		});

		function init()
		{
			$submitBtn.removeAttr('disabled');

			data = getData($('.basic'));
			data['prices'] = getData($('.prices'));
			data['images'] = getDataImages();
			data['relations'] = $('#add-related-item').val();
			return data;
		}

		function getData(inputs)
		{
			var data = {};
			inputs.each(function(i, input){
				var $input = $(input);
				// first data
				data[$input.attr('name')] = $input.val();
				// update when changed
				$input.change(function(){
					data[$(this).attr('name')] = $(this).val();
				});
			});
			return data;
		}

		$uploadImages.submit(function(e){
			e.preventDefault();
			console.log(new FormData())
		});

		function getDataImages()
		{
			var $images = $container.find('.item');
			var images = {};
			var arr = [];
			console.log($images)
			$images.each(function(i, item){
				var imgs = $(item).find('.images-'+i);
				// var id = $(item).data('image');
				images[i] = {};
				imgs.each(function(indx, image){
					var $image = $(image);
					images[i][$image.attr('name')] = $image.val();
					images[i]['is_verified'] = 0;
				});
					arr.push(images[i]);
			});
			return arr;
		}

		function deleteImage(id, images)
		{
			images = images || data['images'];
			$.each(images, function(i, image){
				if(image.id == id)
				{
					delete images[i];
				}
			});
			return images;
		}

		function editable(){
			console.log('clicked')
			var input = $(this).find('input');
			var type = $(this).hasClass('sort_order') ? 'number' : 'text';
			input.prev('.text').remove();
			input.attr('type', type).focus();
			input.blur(init);
		}		

		// activing item
		$('#is_enabled').find('input[type="checkbox"]').change(function(){
			var value = $(this).prop('checked') ? 1 : 0;
			$(this).closest('#is_enabled').find('input[type="hidden"]').val(value);
			init();
		});
		// activing promo
		$('#is_promo').find('input[type="checkbox"]').change(function(){
			var value = $(this).prop('checked') ? 1 : 0;
			$(this).closest('#is_promo').find('input[type="hidden"]').val(value);
			init();
		});
		// switch enabling IMAGE
		$('.enabling').find('input').change(function(){
			var value = $(this).prop('checked') ? 1 : 0;
			$(this).closest('.enabling').find('input[type="hidden"]').val(value);
			init();
		});
		
		// EDIT IMAGE
		$('.editable').click(editable);

		$('#add-related-item').select2({
			placeholder : 'Select item to add related items',
			tags : true,
			allowClear : true,
		})
		.change(function(){
			var value = $(this).val(); // ["484"]
			console.log(value)
			value = value === null ? '' : value;
			// update data
			data['also'] = value;
			$('#related-items').attr('value', value);
			init();
		});

		// if confim delete is agree
		$('.agree-delete').click(function(e){
			// ajax
			var card = $('#image-'+imageId);
			$modalDelete.closeModal();
			deleteImage(imageId);
			card.fadeOut(900, function(){
				card.remove();
			});
			init();
		});

		var $upload = $('#form-upload-images');
    // Initialize the jQuery File Upload widget:
    $upload.fileupload({
    	dropZone : $('#drop'),
    	dataType : 'json',
        add: function (e, data) {
    			var jqXHR = data.submit();
    			console.log(jqXHR)
        },
        done: function(e, data){
        	console.log(data.result.file)
        	if(data.result.status == 'success')
        	{
        		$('.loader').remove();
        		$('#result').append('<img src="/files/'+data.result.file+'" style="width:300px">');
        	}
        		
        },
        progressall: function(e, data){
        	$('#result').html('<span class="loader">Loading...</span>');
        }
    });

    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
      e.preventDefault();
    });

		// // Image upload validation
		// $(function(){
		// 	var allowTypes = ['image/png', 'image/jpeg', 'image/jpg'];
		// 	$uploadImages.change(function(e){
		// 		var file = this.files[0];
		// 		var type = file.type;
		// 		if(type == '' || allowTypes.indexOf(type) == -1)
		// 		{
		// 			console.log('error')
		// 			return false;
		// 		}
				
		// 		var reader = new FileReader();
		// 		reader.readAsDataURL(file);
		// 		reader.onload = imagesLoaded;

		// 	});
		// });

		// UPLOAD image
		// $formUploadImages.submit(doUpload)

		function imagesLoaded(e)
		{
			var url = e.target.result;
			var newImage = {
					id:9999, 
					name:'image.jpg', 
					alt:'Horestco', 
					sort_order:10, 
					is_enabled:1, 
			};
			// $('#images-draggable').append(imageCardTmpl(newImage));

			$('#previewing').attr({'src':url, 'width':300});
			// remove text
			$('#upload-image-text').val('');
			$('#upload-image-btn').removeAttr('disabled');
		}

		function doUpload(e){
			e.preventDefault();

			$.ajax({
				url: "/admin/catalog/upload?ajax=true&pid="+$('input[name="id"]').val(), // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,        // To send DOMDocument or non processed data file it is set to false
				success: function(data)   // A function to be called if request succeeds
				{
					console.log(data)
					// location.reload()
				},
				error: function(data){
					console.log(data)
				}
			});
		}


		$('.modal-trigger.delete')
		.click(function(e){
			// send image id to modal data-id
			imageId = $(this).closest('.card.item').data('image');
			// open modal
			$modalDelete.openModal();
			e.preventDefault();
		});

		// ADD RELATED PRODUCT


		$container.disableSelection();

		$('#add-product-image').change(function(){
			console.log($(this).val())
		});

	});


</script>

<script type="text/html" id="image-draggable-template">
	<div class="card draggable item">
		<h1>New Card Image</h1>
		<input type="text" class="image-9999" value="">
	</div>
</script>