<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title text-capitalize">
			edit sub category
		</h3>
	</div>
	<div class="panel-body">
				
		<form class="form-horizontal" method="post" action="<?=$_SERVER['REQUEST_URI']?>" id="form-edit">
			
			<input type="hidden" name="id" value="<?=$sub->subcatid?>" />

			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Under Category: <small class="text-muted">(<?=$sub->category_id?>)</small></label>
				</div>
				<div class="col-sm-8">
					<select name="catid" class="form-control input-sm">
						<?php if ( count($data['categories']) > 0 ): ?>
							<?php foreach ($data['categories'] as $category): ?>
								<option value="<?=$category->id?>" <?php if( $category->id == $sub->category_id ) echo 'selected' ?>><?=$category->name?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Name:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="name" class="form-control input-sm" value="<?=$sub->name?>" required />
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Description:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="des" class="form-control input-sm" value="<?=$sub->description?>" />
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Status:</label>
				</div>
				<div class="col-sm-8">
					<select type="text" name="status" class="form-control input-sm">
						<option value="1" <?php if ( $sub->is_enabled == 1 ) echo "selected"; ?> >Active</option>
						<option value="0" <?php if ( $sub->is_enabled == 0 ) echo "selected"; ?> >Inactive</option>
					</select>
				</div>
			</div>


			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Relations:</label>
					<p><small><em>Connections</em></small></p>
				</div>
				<div class="col-sm-8">
				<?php
					$items = Subcategory::where('is_enabled', 1)->orderBy('name', 'asc');

					if(isset($_GET['id']) && $_GET['id']){
						$items->where('id', '!=', $_GET['id']);
					}
				?>
					<select name="relations[]" id="" class="form-control input-sm sub" multiple>
						<option value="">--Select--</option>
						<?php foreach($items->get() as $item): ?>
							<option  <?php if(in_array($item->id, $sub->relations->pluck('id')->toArray())) echo "selected"; ?>
							value="<?=$item->id?>"><?=$item->name ?></option>
						<?php endforeach; ?>
					</select>
					<p><small><em>Display other products subcategories</em></small></p>

				</div>
			</div>

			
			<button type="submit" name="edit-submit" class="btn btn-sm btn-info">Save Changes</button>
			<a href="subcategory.php" class="btn btn-sm btn-danger">Cancel</a>
		</form>

	</div>
</div>

<script>
	$(document).ready(function(){

		$('.sub').select2({
			tags: true
		})
	})
</script>