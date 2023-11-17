<?php 
$columns = (isset($_GET['search'])) ? array('col-sm-7', 'col-sm-5') : array('col-sm-8 col-sm-offset-2', 'col-sm-12');
 ?>
<div class="<?=$columns[0]?>">
	<h2 class="text-center">Edit Material</h2>
	<div class="panel panel-primary">

		<div class="panel-heading">
			<h3 class="panel-title text-capitalize">
				<?=$material->name?>
			</h3>
		</div>

		<div class="panel-body">
			<?php 
				$action = 'material.php?action=edit&amp;id=' . $_GET['id'];
				$action = (isset($_GET['search'])) ? $action . '&amp;search' : $action;
			 ?>
			<form action="<?=$action?>" method="POST" class="form-horizontal" id="form-add" enctype="multipart/form-data">
				

<!-- 				<div class="form-group">
					<div class="col-sm-4">
						<label for="">Category</label>
					</div>
					<div class="col-sm-8">
						<select type="text" id="category-material" name="category" class="edit-group form-control" disabled>
							<option value=""></option>
							<?php foreach ($materialLists as $cat): ?>
								<option value="<?=$cat->id?>" <?php if($cat->id == $material->material_category_id) echo "selected"; ?> ><?=ucfirst($cat->name)?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div> -->
				<div class="form-group item" data-id="<?=$material->id?>">
					<div class="col-sm-8 col-sm-offset-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" class="enabling" <?=$material->is_enabled?'checked':''?> >
								Enable
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-4">
						<label for="">Sub Category</label>
					</div>
					<div class="col-sm-8">
						<select type="text" id="subcategory-material" name="subcategory" class="form-control" required>
							<option value=""></option>
							<?php foreach ($materialLists as $key => $cat): ?>
								<optgroup label="<?=$cat->name?>"></optgroup>
								<?php foreach ($cat->subcategories as $sub): ?>
									<option value="<?=$sub->id?>" <?php if($sub->id == $material->material_subcategory_id) echo "selected"; ?> ><?=ucfirst($sub->name)?></option>
								<?php endforeach ?>

							<?php endforeach ?>
						</select>
					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-4">
						<label for="">Code:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" name="code" class="form-control input-sm" value="<?=$material->code?>" />
					</div>
				</div>


				<div class="form-group">
					<div class="col-sm-4">
						<label for="">Name:</label>
					</div>
					<div class="col-sm-8">
						<input type="text" name="name" class="form-control input-sm" value="<?=$material->name?>" required />
					</div>
				</div>

				

				<div class="form-group">
					<div class="col-sm-4">
						<label for="">Description:</label>
					</div>
					<div class="col-sm-8">
						<textarea name="description" class="form-control"><?=$material->description?></textarea>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-4">
						<label for="">Change Image:</label>
					</div>
					<div class="col-sm-8">
					    
						<?php 
							$image =  img_path('material/').$material->id . '-' . $helper->url_slug($material->name) . '.jpg';
							$file = ( file_exists(base_path($image)) ) ? base_url($image) : base_url('/assets/images/not-available.jpg');
						 ?>
						 <input type="file" name="image" class="form-control input-sm" id="imgInp">
						 <p class="help-block">Max Width : 390px <br> Max File Size : 200KB </p>
						 <img id="blah" src="<?=$file?>" class="img-responsive" data-original="<?=$image?>" style="width: 390px;">
					</div>
				</div>

				<button type="submit" name="edit-submit" class="btn btn-sm btn-primary">Submit</button>
				<a href="<?=$_SERVER['PHP_SELF']?>" class="btn btn-sm btn-danger">Cancel</a>

			</form>



		</div>

	</div>
</div>

<?php if(isset($_GET['search'])): ?>

<div class="<?=$columns[1]?>">
	<?php include 'search.php'; ?>
	<br>
	<div id="table-result"></div>
</div>

<?php endif ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#blah').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
			}
		}

		$("#imgInp").change(function() {
		readURL(this);
	});
</script>