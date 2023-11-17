<?php

$db->bind('id', $_GET['id']);
$category = $db->row(" SELECT * FROM categories WHERE id = :id");
// $main = $db->query(" SELECT * FROM main_categories ORDER BY name ");

if ( $_GET['action'] == 'edit' && $category ) :

?>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title text-capitalize">
			edit category
		</h3>
	</div>	
	<div class="panel-body">
		<form class="form-horizontal" id="form-edit-category">
			<input type="hidden" name="id" value="<?=$_GET['id']?>" />
<!-- 			<div class="form-group">
				<div class="col-sm-5">
					<label for="">Under Main Category:</label>
				</div>
				<div class="col-sm-7">
					<select type="text" name="maincatid" class="form-control input-sm" >
						<?php if ( $main ): ?>
							<?php foreach ($main as $row): ?>
								<option value="<?=$row['id']?>" <?php if($row['id']==$category['maincat_id']) echo 'selected' ?>><?=$row['name']?></option>
							<?php endforeach ?>
						<?php endif ?>
					</select>
				</div>
			</div>
			 -->
			<div class="form-group">
				<div class="col-sm-5">
					<label for="">Name:</label>
				</div>
				<div class="col-sm-7">
					<input type="text" name="name" class="form-control input-sm" value="<?=$category['name']?>" required />
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-5">
					<label for="">Description:</label>
				</div>
				<div class="col-sm-7">
					<input type="text" name="des" class="form-control input-sm" value="<?=$category['description']?>" />
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="col-sm-5">
					<label for="">Status:</label>
				</div>
				<div class="col-sm-7">
					<select type="text" name="status" class="form-control input-sm">
						<option value="1" <?php if ( $category['is_enabled'] == 1 ) echo "selected"; ?> >Active</option>
						<option value="0" <?php if ( $category['is_enabled'] == 0 ) echo "selected"; ?> >Inactive</option>
					</select>
				</div>
			</div>
			<button type="submit" name="submit" class="btn btn-sm btn-info">Save Change</button>
			<a href="category.php" class="btn btn-sm btn-danger">Cancel</a>
		</form>

	</div>
</div>
<?php	endif; ?>
