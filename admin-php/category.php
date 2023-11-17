<?php
ini_set("display_errors", 1);
require 'api/check_session.php';
require_once '../classes/Db.class.php';
require_once '../classes/Helper.php';
require '../config.php';

$db = new DB;
$categoryGet = $db->query(" SELECT * FROM categories ORDER BY id DESC ");
?>

<?php include 'partials/header.php'; ?>
<div id="wrap">
	<div class="container">
		<div class="row">
	    <div class="col-sm-12 main">
				<div class="add-info"></div>
				<h2 class="text-center">Manage Category</h2>
				<?php if (isset($_GET['action']) && $_GET['action'] ==  'add' ): ?>
				<div class="row">
					<div class="col-sm-offset-3 col-sm-6">
					<?php include 'partials/category/add.php'; ?>
					</div>
				</div>
				<?php endif ?>
				<?php if (isset($_GET['action']) && $_GET['action'] ==  'edit' ): ?>
				<div class="row">
					<div class="col-sm-offset-3 col-sm-6">
					<?php include 'partials/category/edit.php'; ?>
					</div>
				</div>
				<?php endif ?>
				<?php if ( empty($_GET['action']) ): ?>
				<p class="text-center">
					<a href="category.php?action=add" class="btn btn-sm btn-success">
						<span class="glyphicon glyphicon-plus"></span> Add Category
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
	    		<table class="table table-bordered table-striped" style="position:relative">
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
	    					<th class="toggle">ID</th>
	    					<th>Category Name</th>
	    					<th>Description</th>
	    					<th>Status</th>
	    					<th>Action</th>
	    				</tr>
	    			</thead>
	    			<tbody>
	    				<?php foreach ($categoryGet as $row): ?>
	    					<tr>
	    						<td class="toggle">
	    							<?=$row['id']?>
	    						</td>
	    						<td><?=$row['name']?></td>
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
</div><!-- end wrap -->


<?php include 'partials/footer.php'; ?>

<script>
	$(document).ready(function(){
		$('.toggle').hide()
		$('.btn-toggle').click(function(){
			$('.toggle').toggle()
		})
		
		$('#form-add-category').submit(function(e){
			e.preventDefault()
			$.ajax({
				url : 'partials/category/add-submit.php',
				data : $(this).serialize(),
				method : 'post',
				success : function(res){
					var category = JSON.parse(res)
					var html 	= '<tr style="color:#18bc9c">'
							html += '<td>'+ category.id +'</td>'
							html += '<td>'+ category.name +'</td>'
							html += '<td>'+ category.des +'</td>'
							html += '<td style="color:green">'+ category.status +'</td>'
							html += '<td><a href="<?=$_SERVER['PHP_SELF']?>?action=edit&amp;id='+ category.catid +'" class="btn btn-info btn-xs edit-category">'
    					html +=	'<span class="glyphicon glyphicon-edit"></span> Edit</a> '
    					//html += '<button type="button" class="btn btn-danger btn-xs deletebtn" data-id="'+ category.catid +'">'
    					//html += '<span class="glyphicon glyphicon-trash"></span> Delete</button>'
							html += '</td></tr>'
					var msg  = '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> Add <strong>'+ category.name +'</strong> Success</div>'
					$('.toggle').show()
					$('#form-add-category')[0].reset()
					$('tbody').prepend(html)
					$('.add-info').append(msg).delay(1000).fadeOut(function(){
						location.reload();
					})
				}
			})
		})

		$('#form-edit-category').submit(function(e){
			e.preventDefault()
			console.log($(this).serialize())
			$.ajax({
				url : 'partials/category/edit-submit.php',
				data : $(this).serialize(),
				method : 'post',
				success : function(res){
					if (res) {
						location.assign('category.php')
					};
				}
			})
		})

		$('.deletebtn').click(function(){
			var id = $(this).data('id')
			var confirmasi = confirm("Are you sure to DELETE this Category?")
			if ( confirmasi ) {
				$.get('partials/category/delete.php', {id:id}, function(res){
						location.reload()
				})
			}
			else{
				return false
			}
		})
			
	})
</script>
