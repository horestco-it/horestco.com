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

	<form class="col s12" id="edit-product" action="/admin/catalogEdit/update" method="post">
		<div class="row card-panel">
			<div class="card-panel card-panel-title green z-depth-0">
				<h5>Basic Information</h5>
			</div>
			<div class="col s12">
					
					<div class="row">
						<input type="hidden" name="id" class="basic" value="<?=$product->id?>">

		        <div class="col s12 submit">
		          <!-- <button  id="submit" class="btn-floating btn-large fixed waves-effect waves-light blue darken-3" disabled>update</button> -->
		          <button  id="submit" class="btn-floating btn-large fixed waves-effect waves-light blue darken-3" name="submit" type="submit">update</button>
		        </div>

						<div class="col s12 m6 input-field">
		          <select id="select-categories" name="posts[category_id]" class="browser-default basic validate" required>
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
		          <select id="select-subcategories" name="posts[subcategory_id]" class="browser-default basic validate">
		          	<option value="" disabled>- - Subcategory - -</option>
		          	<?php foreach ($subcategories as $key => $subcategory): ?>
		          		<option value="<?=$subcategory->id?>" <?php if($subcategory->id == $product->subcategory_id) echo "selected"?> ><?=$subcategory->name?></option>
		          	<?php endforeach ?>
		          </select>
		          <label for="select-subcategories" class="active">Subcategory</label>
		        </div>

		        <div class="col s12 m6 input-field">
		        	<input type="text" id="name" name="post[name]" class="basic validate" value="<?=$product->name?>" placeholder="Name" required>
		        	<label for="name" class="active">Name:</label>
		        </div>

		        <div class="col s12 m6 input-field">
		        	<input type="text" id="code" name="post[code]" class="basic validate" value="<?=$product->code?>" placeholder="Code" required>
		        	<label for="code" class="active">Code:</label>
		        	<div class="info-field red-text"></div>
		        </div>

		        <div class="col s12 m6 input-field">
		        	<textarea name="posts[description]" class="browser-default materialize-textarea basic validate" id="description"><?=$product->description?></textarea>
		        	<label for="description" class="active">Description:</label>
		        </div>

		        <div class="col s12 m6 input-field">
		        	<textarea name="posts[dimension]" class="materialize-textarea basic validate" id="dimension"><?=$product->dimension?></textarea>
		        	<label for="dimension" class="active">Dimension:</label>
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
		      		<input type="hidden" class="basic validate" name="posts[is_enabled]" value="<?=$product->is_enabled?>">
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
	        			<input type="checkbox" class="promotion switch-checkbox" <?php if($product->is_promo) echo "checked"; ?>>
	        			<span class="lever"></span>
	        			On
	        		</label>
	        		<input type="hidden" class="switch-value" name="posts[is_promo]" value="<?=$product->is_promo?>">
	        	</div>
					</div>
					<div class="row pricing">
						<div class="card-panel card-panel-title grey lighten-3 z-depth-0">
							<h5>Pricing</h5>
						</div>

						<!-- <input type="hidden" name="id" class="prices" value="<?=$prices['id']?>"> -->
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
									<input type="text" name="posts[prices][<?=$key?>]" class="prices" id="<?=$key?>" value="<?=$price?>">
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


		</div><!-- end col -->

		<div class="row card-panel related-item">
			<div class="card-panel card-panel-title green z-depth-0">
				<h5>Related Items</h5>
			</div>

			<div class="col s12 input-field" style="margin-bottom:2rem">
				<select name="posts[relations][]" id="add-related-item" class="" multiple="multiple" style="width:100%;height:auto">
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
					<div class="card draggable item" data-image="<?=$image->id?>" id="image-<?=$image->id?>" data-key="<?=$key?>">
						<div class="row">
							<div class="col xs12 s4 card-image">
								<?=image_thumb(product_img_url($image->name), 200,['data-src'=>$image->name]);?>
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

<script src="<?=script_url('packery.pkgd.min.js')?>"></script>
<script src="<?=assets_url('/vendor/jquery.ui.widget.js')?>"></script>
<script src="<?=script_url('jquery.iframe-transport.js')?>"></script>
<script src="<?=script_url('jquery.tmpl.min.js')?>"></script>
<script src="<?=script_url('jquery.fileupload.js')?>"></script>

<?php $this->load->view('partials/scripts/product-form.js.php') ?>


<?php if($this->uri->segment(5) == 'preview' ): ?>
<script>
	$('input,select,textarea,a,button').attr('disabled', 'disabled');
</script>
<?php endif?>
>

<script>

	

	$(document).ready(function(){

		// activing item
		
		


	});


</script>
