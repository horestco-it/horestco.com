<?php
ini_set("display_errors", 1);
require 'api/check_session.php';
require '../config.php';
require_once '../classes/DB.php';
require_once '../classes/Db.class.php';
require_once '../classes/Helper.php';

// spl_autoload_register(function($class){
// 	include '../'.$class.'.php';
// });
$db = new Db;
// $db->bind('q', '%'.@$_GET['q'].'%');
$query = "
	SELECT subcategories.*, categories.slug as category_slug
	FROM subcategories 
	LEFT JOIN categories 
	ON subcategories.category_id = categories.id 
";

if(@$_GET['q']){
	$query .="WHERE (subcategories.name like :q ) ";
}

$query .= "ORDER BY subcategories.is_enabled DESC, subcategories.id DESC";
$messages = [];
$errors = [];
$res = $db->query($query);

	$data['categories'] = Category::enabled()->orderBy('name')->get();
	$data['subcategories'] = Subcategory::enabled()->orderBy('name')->get();

	$dataJoiner = array();
	foreach ($data['subcategories'] as $key => $sub) {
		$dataJoiner[$key]['id'] = $sub->subcatid;
		$dataJoiner[$key]['text'] = $sub->name;
	}
// add submit
// if ( isset($_GET['action']) && $_GET['action'] == 'add' )
// {

	// Submit
	if ( isset($_POST['add-submit']) )
	{
		// insert to subcatgory table
		$id = Subcategory::insertGetId(array(
				'category_id' => $_POST['catid'],
				'name' => $_POST['name'],
				'description' => $_POST['des']
			));

		// insert to subcategory_also table
		// -- next --

		// redirect to edit
		if($id){
			header("Location:subcategory.php?action=edit&id=$id");
		}


	}
// }

// edit
if( isset($_GET['action']) && $_GET['action'] == 'edit' )
{
	$sub = Subcategory::find($_GET['id']);
	if(is_null($sub)){
		header("Location:subcategory.php");
	}
	// submit
	if(isset($_POST['edit-submit'])){
		// update to subcatgory table
		$sub->update(array(
				'category_id' => $_POST['catid'],
				'name' => $_POST['name'],
				'description' => $_POST['des'],
				'is_enabled'=> $_POST['status']
			));

			
			if( isset($_POST['relations']) ){
				$sub->relations()->sync($_POST['relations']);
			}
		
		header("Location: ".$_SERVER['REQUEST_URI']);
	}
	
}

// delete
if ( isset($_GET['action']) && $_GET['action'] == 'delete') {
	Subcategory::find($_GET['id'])->delete();
}
?>

<?php include 'partials/header.php'; ?>


<div id="wrap">
	<div class="container">
		<div class="row">
			
	    <div class="col-sm-12 main">
				<h2 class="text-center">Manage Sub Categoy</h2>

				<?php if (isset($_GET['action']) && $_GET['action'] ==  'add' ): ?>
				<div class="row">
					<div class="col-sm-offset-3 col-sm-6">
					<?php include 'partials/subcategory/add.php'; ?>
					</div>
				</div>
				<?php endif ?>
				<?php if (isset($_GET['action']) && $_GET['action'] ==  'edit' ): ?>
				<div class="row">
					<div class="col-sm-offset-3 col-sm-6">
					<?php include 'partials/subcategory/edit.php'; ?>
					</div>
				</div>
				<?php endif ?>
				<?php if ( empty($_GET['action']) ): ?>
					<p class="text-center">
						<a href="<?=$_SERVER['PHP_SELF']?>?action=add" class="btn btn-sm btn-success">
							<span class="glyphicon glyphicon-plus"></span> Add Sub Category
						</a>
					</p>
				<?php endif ?>

			</div>
		</div>
	</div>
	<?php if( empty($_GET['action']) ): ?>
	<div class="container lists">
		<div class="row">

			<form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
				<div class="col-sm-2">
					<input type="text" placeholder="Search" class="form-control" name="q" value="<?=@$_GET['q']?>">
				</div>
				<div class="col-sm-2">
					<button type="submit" class="btn btn-primary">Filter</button>
				</div>
			</form>
		</div>
		<hr/>
		<div class="row">
			<div class="col-sm-12">

				<div class="table-responsive">


					<table class="table table-bordered table-striped"  style="position:relative">
					<button class="btn btn-sm btn-primary btn-toggle" 
									style="	position:absolute;
													left:-16px;
													z-index:1;
													height:120px;
													background-color:#7b7b7b;
													border:none;
													border-radius:0">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</button>
						<thead>
							<tr>
								<th>ID</th>
								<th>Sub-Category Name</th>
								<th>Description</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($res as $row): ?>
								<tr class="<?=$row['is_enabled'] == 0 ? 'inactive':'' ?>">
									<td>
										<?= $row['id']?>
									</td>
									<td>
										<a href="<?=base_url('furniture')?>/<?=$row['category_slug']?>/<?=$row['slug']?>" target="_blank">
											<?=$row['name']?>
										</a>
									</td>
									<td><?=$row['description']?></td>
									<td><?=$helper->status($row['is_enabled'])?></td>
									<td>
										<a href="<?=$_SERVER['PHP_SELF']?>?action=edit&amp;id=<?=$row['id']?>" class="btn btn-info btn-xs edit-category">
											<span class="glyphicon glyphicon-edit"></span> Edit</a>
										<?php if (isset($_SESSION['type']) && $_SESSION['type'] == 'A'): ?>
											
										<button type="button" class="btn btn-danger btn-xs deletebtn" data-id="<?=$row['id']?>">
											<span class="glyphicon glyphicon-trash"></span> Delete
										</button>
										<?php endif ?>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<?php endif;?>
</div><!-- end wrap -->

<?php include 'partials/footer.php'; ?>


<script>
	$(document).ready(function(){
		var SUB_DIR = 'partials/subcategory/';

		$('.toggle').hide()
		$('.btn-toggle').click(function(){
			$('.toggle').toggle()
		})

		$('.deletebtn').click(function(){
			var id = $(this).data('id')
			var confirmasi = confirm("Are you sure to DELETE this subcategory ?")
			if ( confirmasi ) {
				$.get('<?=$_SERVER["PHP_SELF"]?>', {action:'delete',id:id}, function(res){
						location.reload()
				})
			}
			else{
				return false
			}
		})
			
	})
</script>
<style>
	tr.inactive td{
		background-color: #ffeae8;
	}
</style>