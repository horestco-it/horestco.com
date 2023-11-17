<?php 

if ( isset($_GET['action']) && $_GET['action'] == 'add' ):
 ?>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title text-capitalize">
				Add new sub category
			</h3>
		</div>
	<div class="panel-body">
				
		<form class="form-horizontal" method="post" action="<?=$_SERVER['REQUEST_URI']?>" id="form-add">
			
			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Under Category:</label>
				</div>
				<div class="col-sm-8">
					<select type="text" id="select-catid" name="catid" class="form-control input-sm" required>
						<option value="">-- Select --</option>
						<?php foreach ($data['categories'] as $category): ?>
							<option value="<?=$category->catId?>"><?=$category->name?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>

			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Name:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="name" class="form-control input-sm" required />
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Description:</label>
				</div>
				<div class="col-sm-8">
					<textarea name="des" class="form-control"></textarea>
				</div>
			</div>

			<button type="submit" name="add-submit" class="btn btn-sm btn-primary">Submit</button>
			<a href="<?=$_SERVER['PHP_SELF']?>" class="btn btn-sm btn-danger">Cancel</a>
		</form>

	</div>
</div>
<?php
endif;
 ?>