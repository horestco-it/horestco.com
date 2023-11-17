<?php
require 'api/check_session.php';
require_once '../classes/Db.class.php';
require_once '../classes/Helper.php';
require '../config.php';

$db = new DB;
$categoryGet = $db->query(" SELECT * FROM main_categories ORDER BY id DESC ");
?>

<?php include '_partials/header.php'; ?>
<div id="wrap">
	<div class="container">
		<div class="row">
	    <div class="col-sm-12 main">
				<div class="add-info text-center"></div>
				<h2 class="text-center">Manage Main Category</h2>
				<?php if (isset($_GET['action']) && $_GET['action'] ==  'add' ): ?>
				<div class="row">
					<div class="col-sm-offset-3 col-sm-6">
					<?php include '_partials/maincategory/add.php'; ?>
					</div>
				</div>
				<?php endif ?>
				<?php if (isset($_GET['action']) && $_GET['action'] ==  'edit' ): ?>
				<div class="row">
					<div class="col-sm-offset-3 col-sm-6">
					<?php include '_partials/maincategory/edit.php'; ?>
					</div>
				</div>
				<?php endif ?>
				<?php if ( empty($_GET['action']) ): ?>
					<p class="text-center">
						<a href="<?=$_SERVER['PHP_SELF']?>?action=add" class="btn btn-sm btn-success">
							<span class="glyphicon glyphicon-plus"></span> Add Main Category
						</a>
					</p>
				<?php endif ?>

			</div>
		</div>
	</div>

	<div class="container lists">
		<div class="row">
			<div class="col-sm-12">

				<div class="table-responsive">
	    		<table id="table-maincategory" class="table table-bordered table-striped">
	    			<thead>
	    				<tr>
	    					<th data-column-id="maincatId">Main Cat id</th>
	    					<th data-column-id="name">Name</th>
	    					<th data-column-id="des">Description</th>
	    					<th data-column-id="status">Status</th>
	    					<th data-column-id="action">Action</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				<?php foreach ($categoryGet as $row): ?>
	    					<tr>
	    						<td><?=$row['id']?></td>
	    						<td><?=$row['name']?></td>
	    						<td><?=$row['description']?></td>
	    						<td><?=Helper::status($row['is_enabled'])?></td>
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
</div><!-- end wrap -->


<?php include '_partials/footer.php'; ?>

<script>
	$(document).ready(function(){

		$('#form-add-maincategory').submit(function(e){
			e.preventDefault()
			$.ajax({
				url : '_partials/maincategory/add-submit.php',
				data : $(this).serialize(),
				method : 'post',
				success : function(res){
					var category = JSON.parse(res)
					var html 	= '<tr style="color:#18bc9c">'
							html += '<td>'+ category.id +'</td>'
							html += '<td>'+ category.name +'</td>'
							html += '<td>'+ category.des +'</td>'
							html += '<td style="color:green">'+ category.status +'</td>'
							html += '<td><a href="<?=$_SERVER['PHP_SELF']?>?action=edit&amp;id='+ category.id +'" class="btn btn-info btn-xs edit-category">'
    					html +=	'<span class="glyphicon glyphicon-edit"></span> Edit</a> '
    					//html += '<button type="button" class="btn btn-danger btn-xs deletebtn" data-id="'+ category.id +'">'
    					//html += '<span class="glyphicon glyphicon-trash"></span> Delete</button></td>'
    					html += '</td>'
							html += '</tr>'
					var msg  = '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Add <strong>'+ category.name +'</strong> Success</div>'
					$('#form-add-maincategory')[0].reset()
					$('tbody').prepend(html)
					$('.add-info').append(msg).delay(1000).fadeOut(function(){
						location.reload()
					})
				}
			})
		})

		$('#form-edit-maincategory').submit(function(e){
			e.preventDefault()
			$.ajax({
				url : '_partials/maincategory/edit-submit.php',
				data : $(this).serialize(),
				method : 'post',
				success : function(res){
						location.assign('maincategory.php')
				}
			})
		})


		$('.deletebtn').click(function(){
			var id = $(this).data('id')
			var confirmasi = confirm("Are you sure to DELETE this Main Category?")
			if ( confirmasi ) {
				$.get('_partials/maincategory/delete.php', {id:id}, function(res){
						location.reload()
				})
			}
			else{
				return false
			}
		})
			
	})
</script>
