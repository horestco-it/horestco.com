<?php 

if ( $_GET['action'] == 'add' ):
 ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title text-capitalize">
			Add new main category
		</h3>
	</div>
	<div class="panel-body">
				
		<form class="form-horizontal" id="form-add-maincategory">
			
			<div class="form-group">
				<div class="col-sm-4">
					<label for="">Name:</label>
				</div>
				<div class="col-sm-8">
					<input type="text" name="name" class="form-control input-sm" autofocus required />
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
			<button type="submit" name="submit" class="btn btn-sm btn-primary">Submit</button>
			<a href="<?=$_SERVER['PHP_SELF']?>" class="btn btn-sm btn-danger">Cancel</a>
		</form>

	</div>
</div>
<?php
endif;
 ?>