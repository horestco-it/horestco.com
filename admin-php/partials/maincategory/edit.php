<?php

$db->bind('id', $_GET['id']);
$maincategory = $db->row(" SELECT * FROM main_categories WHERE id = :id ");


if ( $_GET['action'] == 'edit' ) :

?>
<div class="panel panel-info">
	<div class="panel-heading">
		<h3 class="panel-title text-capitalize">
			Edit main category
		</h3>
	</div>
	<div class="panel-body">
				
		<form class="form-horizontal" id="form-edit-maincategory">
			
			<input type="hidden" name="maincatid" class="form-control input-sm" value="<?=$maincategory['id']?>" style="width:20%" readonly/>

			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Name:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="name" class="form-control input-sm" value="<?=$maincategory['name']?>" required />
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Description:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="des" class="form-control input-sm" value="<?=$maincategory['description']?>" />
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Status:</label>
				</div>
				<div class="col-sm-8">
					<select type="text" name="status" class="form-control input-sm">
						<option value="1" <?php if ( $maincategory['is_enabled'] == 1 ) echo "selected"; ?> >Active</option>
						<option value="0" <?php if ( $maincategory['is_enabled'] == 0 ) echo "selected"; ?> >Inactive</option>
					</select>
				</div>
			</div>
			<button type="submit" name="submit" class="btn btn-sm btn-info">Save Change</button>
			<a href="maincategory.php" class="btn btn-sm btn-danger">Cancel</a>
		</form>

	</div>
</div>
<?php	endif; ?>
