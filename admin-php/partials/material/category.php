<div class="col-sm-9 col-sm-offset-2">

<?php
///////////////////////
// form add category //
///////////////////////
if (isset($_GET['stage']) && $_GET['stage'] == 'add'): ?>

	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title text-capitalize">
				add category
			</h3>
		</div>
		<div class="panel-body">
			<form id="form" class="form-horizontal" method="post" action="/admin-php/material.php?action=add-category">
				<div class="form-group">
					<div class="col-sm-5">
						<label for="">Name:</label>
					</div>
					<div class="col-sm-7">
						<input type="text" name="name" class="form-control input-sm" value="" autofocus required />
					</div>
				</div>

				<button type="submit" name="add-submit" class="btn btn-sm btn-success">Submit</button>
				<a href="<?=$_SERVER['PHP_SELF']?>?action=category" class="btn btn-sm btn-danger">Cancel</a>
			</form>

		</div>
	</div>
<?php
///////////////////////
// form edit category //
///////////////////////
elseif( isset($_GET['stage']) && $_GET['stage'] == 'edit' ):

?>

	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title text-capitalize">
				Edit category
			</h3>
		</div>
		<div class="panel-body">
			<form id="form" class="form-horizontal" method="post" action="/admin-php/material.php?action=edit-category">
				<input type="hidden" name="id" value="<?=$category->id?>">
				<div class="form-group">
					<div class="col-sm-5">
						<label for="">Name:</label>
					</div>
					<div class="col-sm-7">
						<input type="text" name="name" class="form-control input-sm" value="<?=$category->name?>" required autofocus />
					</div>
				</div>

				<button type="submit" name="edit-submit" class="btn btn-sm btn-info">Submit</button>
				<a href="<?=$_SERVER['PHP_SELF']?>?action=category" class="btn btn-sm btn-danger">Cancel</a>
			</form>

		</div>
	</div>

<?php endif ?>

	<h2>Material Category</h2>
	<!-- call modal to add category -->
	<a href="<?=$_SERVER['PHP_SELF']?>?action=category&amp;stage=add" class="btn btn-success">
		<span class="glyphicon glyphicon-plus"></span> New
	</a>
	<table class="table table-bordered table-striped text-capitalize">
		<thead>
			<tr>
				<th>id</th>
				<th>name</th>
				<th>action</th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($materialLists as $key => $category): ?>
		<tr data-id="<?=$category->id?>">
			<td><?=$category->id?></td>
			<td><?=$category->name?></td>
			<td>
				<a href="<?=$_SERVER['PHP_SELF']?>?action=category&amp;stage=edit&amp;id=<?=$category->id?>" class="btn btn-sm btn-info">Edit</a>
				<a href="#" class="btn btn-sm btn-danger delete-category" data-confirm="Are you sure delete <?=strtoupper($category->name)?>">delete</a>
			</td>
			<td class="data hide">
				<?php echo $category->toJson()?>
			</td>
		</tr>
		<?php endforeach ?>
		</tbody>
	</table>
</div>
