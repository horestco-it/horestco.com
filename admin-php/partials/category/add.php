<?php 
//$main = $db->query(" SELECT * FROM main_categories WHERE is_enabled = 1 ORDER BY name "); 

if ( $_GET['action'] == 'add' ):
 ?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title text-capitalize">
				add category
			</h3>
		</div>
	<div class="panel-body">
				
		<form class="form-horizontal" id="form-add-category" method="POST">
			<input type="hidden" name="id">
			
<!-- 			<div class="form-group">
				<div class="col-sm-5">
					<label for="">Under Main Category:</label>
				</div>
				<div class="col-sm-7">
					<select type="text" name="maincatid" class="form-control input-sm" autofocus required>
						<option value="">-- Select --</option>
						<?php foreach ($main as $row): ?>
							<option value="<?=$row['id']?>"><?=$row['name']?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div> -->
			
			<div class="form-group">
				<div class="col-sm-5">
					<label for="">Name:</label>
				</div>
				<div class="col-sm-7">
					<input type="text" name="name" class="form-control input-sm" value="" required />
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-5">
					<label for="">Description:</label>
				</div>
				<div class="col-sm-7">
					<textarea name="des" class="form-control"></textarea>
				</div>
			</div>
			<input type="submit" name="submit" class="btn btn-sm btn-primary" value="Submit">
			<!-- <button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button> -->
			<a href="category.php" class="btn btn-sm btn-danger">Cancel</a>
		</form>

	</div>
</div>
<?php
endif;
 ?>