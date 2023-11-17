<div class="col-sm-9 col-sm-offset-2">

<?php
///////////////////////
// form add category //
///////////////////////
if (isset($_GET['stage']) && $_GET['stage'] == 'add'): ?>

	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title text-capitalize">
				add subcategory
			</h3>
		</div>
		<div class="panel-body text-capitalize">
			<form id="form" class="form-horizontal" method="post" action="/admin-php/material.php?action=add-subcategory">
				<div class="form-group">
					<div class="col-sm-5">
						<label for="">Category:</label>
					</div>
					<div class="col-sm-7">
						<select name="material_category_id" class="form-control input-sm" required>
							<option value="">-- Select --</option>
							<?php foreach ($materialLists as $key => $category): ?>
							<option value="<?=$category->id?>"><?=ucwords($category->name)?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-5">
						<label for="">Name:</label>
					</div>
					<div class="col-sm-7">
						<input type="text" name="name" class="form-control input-sm" value="" autofocus required />
					</div>
				</div>

				<button type="submit" name="add-submit" class="btn btn-sm btn-success">Submit</button>
				<a href="<?=$_SERVER['PHP_SELF']?>?action=subcategory" class="btn btn-sm btn-danger">Cancel</a>
			</form>

		</div>
	</div>
<?php
///////////////////////
// form edit subcategory //
///////////////////////
elseif( isset($_GET['stage']) && $_GET['stage'] == 'edit' ):

?>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title text-capitalize">
				Edit subcategory
			</h3>
		</div>
		<div class="panel-body">
			<form id="form" class="form-horizontal" method="post" action="/admin-php/material.php?action=edit-subcategory">
				<input type="hidden" name="id" value="<?=$subcategory->id?>">

				<div class="form-group">
					<div class="col-sm-5">
						<label for="">Category:</label>
					</div>
					<div class="col-sm-7">
						<select name="material_category_id" class="form-control input-sm" required>
							<option value="">-- Select --</option>
							<?php foreach ($materialLists as $key => $category): ?>
							<option value="<?=$category->id?>" <?php if($category->id == $subcategory->material_category_id) echo "selected" ?>><?=ucwords($category->name)?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="col-sm-5">
						<label for="">Name:</label>
					</div>
					<div class="col-sm-7">
						<input type="text" name="name" class="form-control input-sm" value="<?=$subcategory->name?>" required autofocus />
					</div>
				</div>

				<button type="submit" name="edit-submit" class="btn btn-sm btn-info">Submit</button>
				<a href="<?=$_SERVER['PHP_SELF']?>?action=subcategory" class="btn btn-sm btn-danger">Cancel</a>
			</form>

		</div>
	</div>

<?php endif ?>

	<h2>Material Subcategory</h2>
	<!-- call modal to add category -->
	<a href="<?=$_SERVER['PHP_SELF']?>?action=subcategory&amp;stage=add" class="btn btn-success">
		<span class="glyphicon glyphicon-plus"></span> New
	</a>
	<table class="table table-bordered table-striped text-capitalize">
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>category</th>
				<th>action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($materialLists as $key => $category): ?>
			<?php foreach ($category->subcategories()->orderBy('id', 'desc')->get() as $key => $subcategory): ?>
			<tr data-id="<?=$subcategory->id?>">
				<td><?=$subcategory->id?></td>
				<td><?=$subcategory->name?></td>
				<td><?=$category->name?></td>
				<td>
					<a href="<?=$_SERVER['PHP_SELF']?>?action=subcategory&amp;stage=edit&amp;id=<?=$subcategory->id?>" class="btn btn-sm btn-info">Edit</a>
					<a href="#" class="btn btn-sm btn-danger delete-subcategory" data-confirm="Are you sure delete <?=strtoupper($subcategory->name)?>">delete</a>
				</td>
			</tr>
			<?php endforeach ?>
		<?php endforeach ?>
		</tbody>
	</table>
</div>
