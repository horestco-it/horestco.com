
<div class="col-sm-8 col-sm-offset-2">
	<div class="panel panel-primary">

		<div class="panel-heading">
			<h3 class="panel-title text-capitalize">
				Add new Material
			</h3>
		</div>

		<div class="panel-body">
			<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="form-horizontal" id="form-add">
				
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
									<option value="<?=$sub->id?>"><?=ucfirst($sub->name)?></option>
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
						<input type="text" name="code" class="form-control input-sm" />
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
						<textarea name="description" class="form-control"></textarea>
					</div>
				</div>

				<button type="submit" name="add-submit" class="btn btn-sm btn-primary">Submit</button>
				<a href="<?=$_SERVER['PHP_SELF']?>" class="btn btn-sm btn-danger">Cancel</a>

			</form>



		</div>

	</div>
</div>

