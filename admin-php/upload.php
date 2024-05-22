<?php

use Illuminate\Support\Str;

ini_set('display_errors', 1);

require 'api/check_session.php';

include '../config.php';
include BASE_DIR . '/classes/Helper.php';
include BASE_DIR . '/classes/DB.php';


if( isset($_GET['product']) && isset($_GET['id']) ):

	$product = Product::find($_GET['id']);

	$materialLists = MaterialCategory::materialLists();
	$material = MaterialCategory::associateWithProduct($product->id);

	$unique['ids'] = array_unique($product->materials->lists('id'));
	$unique['catid'] = array_unique($product->materials->lists('material_category_id'));
	$unique['subcatid'] = array_unique($product->materials->lists('material_subcategory_id'));

	//////////////////
	// upload image //
	//////////////////
	if( isset($_GET['action']) && $_GET['action'] == 'upload-image' )
	{
		$upload = upload_product_image($_FILES['images'], array('product_id'=>$product->id));

		if( $upload )
		{
			header("Location:$_SERVER[PHP_SELF]?product&id=$_GET[id]");
		}
	}

endif;
//////////////////
// Ajax REquest //
//////////////////
if(check_ajax())
{
	if( isset($_GET['action']) && $_GET['action'] == 'update-material' )
	{
		$product = Product::find($_GET['id']);

		$product->materials()->sync( json_decode($_POST['materialId']) );
		echo $product->materials()->count();
		exit;
	}
	exit;
}



 ?>
<?php include 'partials/header.php'; ?>

<style type="text/css">

	.panel-material .panel-heading{
		position: relative;
		padding: 20px 15px;
	}
	.panel-material .panel-heading .btn{
		position: absolute;
		top: 13px;
		right: 15px;
	}
	.tree-panel{
		padding: 5px;
	}
</style>


<script>
$(document).ready(function(){
	var $tree = $('.tree-panel');
	var $modal = $('#myModal');
	var $material = $('.material');
	var materialId;

	var tree = $tree.easytree({
		allowActivate : false,
		built : function(nodes){
			addCheckbox()
		}
	});

	function addCheckbox(){
		$('.material').each(function(){
			var $expander = $(this).find('.easytree-expander');
			if($(this).hasClass('active'))
			{
				$expander.html('<input type="checkbox" checked>')
			}
			else{
				$expander.html('<input type="checkbox">')
			}
		})
	}

	function opacitized(){
		console.log('changed')
		var $this = $(this);
		var $material = $this.closest('.material');
		// if checked
		if($this.prop('checked'))
		{
			$material.removeClass('inactive').addClass('active')
		}
		else{
			$material.removeClass('active').addClass('inactive')
		}
	}	
	$('.material').find('input[type="checkbox"]').change(opacitized);

	$('.material').each(function(){
		var $this = $(this);
		var $checkbox = $this.find('input[type="checkbox"]');
		// open modal
		$this.find('.easytree-title').click(function(){
			if($this.hasClass('active'))
			{
				materialId = $this.attr('id');
				$modal.modal()
			}
		});
	});

	// when modal is opening
	$modal.on('show.bs.modal', function(event){
		var $modal = $(event.target);
		var id = $modal.data('id');
		// modal
		var $body = $modal.find('.modal-content');
		var data = {
			'url':'upload.php',
			'section':'material',
			'materialId':materialId,
			'id':'<?=$_GET["id"]?>',
		};
		$body.empty();
		$body.load('/admin-php/partials/material/load-image.php?id=<?=$_GET["id"]?>',data);
	});

	// update button
	$('#edit-material-btn').click(function(){
		var ids = [];
		$('.material').each(function(){
			var $this = $(this);
			var $checkbox = $this.find('input[type="checkbox"]');
			if($checkbox.prop('checked'))
			{
				var id = $checkbox.closest('.material').attr('id')
				ids.push(id);
			}
		});

		var post = $.post('<?=$_SERVER["REQUEST_URI"]?>&action=update-material', {materialId : JSON.stringify(ids)});
		post.success(function(data){
			location.reload()
		})
	});
})
</script>

<div id="wrap">
  <div id="dashboard" class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="jumbotron">
					<div class="container">
						<div class="text-center">

							<a href="<?= $product->admin_route ?>" class="pull-left">
							<span class="glyphicon glyphicon-chevron-left"></span> 
								Back
							</a>

							<a href="<?= $product->route ?>" class="pull-right" target="_blank">
							<span class="glyphicon glyphicon-eye-open"></span> 
								View Online 
							</a>

							<h2><?=$product->name?></h2>
	        		<h4><?=$product->code?></h4>
	        		<p><?=$product->description?></p>
						</div>
						<hr style="border-color:#ddd">
						<form action="<?=$_SERVER['REQUEST_URI']?>&amp;action=upload-image" 
							method="POST" 
							role="form" 
							enctype="multipart/form-data" 
							style="max-width:330px; margin:0 auto;">

							<div class="form-group">
								<label for="">Upload Image(s):</label>
								<div class="input-group">
									<input type="file" name="images[]" class="form-control" multiple="multiple" accept="image/*" >
									<span class="input-group-btn">
										<button type="submit" name="upload-new" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span></button>
									</span>
								</div>
								<p class="text-warning" style="font-size:14px">Dimension : 800x600 px <br/> Max size : 200KB</p>
							</div>
						
						</form>
						<!-- end upload image -->
						<!-- images -->
						<div class="panel panel-default" style="margin-top:30px">
        		  <div class="panel-heading">
        				<!-- <h3 class="panel-title">Manage Images</h3> -->
        		  </div>
        		  <div class="panel-body">
        		  	
        				<div class="row">
        					<?php foreach ($product->images as $key => $image): ?>
        					<div class="col-sm-6 col-md-2 col-lg-2" data-alt="<?=$image->alt?>" data-id="<?=$image->id?>" data-material="">
        						<div class="thumbnail">
        							<img width="240px" height="90px" src="<?=src($image->name)?>">
        						</div>
        					</div>
        					<?php endforeach ?>
        				</div>
        		  </div>
	        	</div>
	        	<!-- end images -->
					</div>
				</div>
		
				<!-- Setting material tree menus -->
				<div class="panel panel-default panel-material">
	        <div class="panel-heading">
	        	<h3 class="panel-title">Setting Material for <?=$product->name?></h3>
	        	<button class="btn btn-sm btn-info" id="edit-material-btn">Update</button>
	        </div>
	        <div class="panel-body">
		      	<div class="tree-panel">
		      		<ul>
		      			<?php 
		      				$classes = [
		      					'isExpanded' => '',
		      					'active'	=> 'inactive'
		      				];
		      				$checked = ['glyphicon-home'=>'glyphicon-trash'];
		      			 ?>
								<?php foreach ($materialLists as $key => $cat): ?>
								<li class="isFolder <?=setup_class([$cat->id => $unique['catid']], $classes)?>">
									<?=strtoupper($cat->name)?>
									<!-- subcategory -->
									<ul>
										<?php foreach ($cat->subcategories as $key => $sub): ?>
										<li class="isFolder <?=setup_class([$sub->id => $unique['subcatid']], $classes)?>">
											<?=strtoupper($sub->name)?>
											<ul>
												<?php foreach ($sub->materials as $key => $material): ?>
												<?php
													$image = $material->id.'-'.Str::slug($material->name).'.jpg';
													$relative = 'material/';
													$isOpacity = !in_array($material->id, $unique['ids']) ? 'inactive': '';
												?>
												<li id="<?=$material->id?>" 
														class="material <?=setup_class([$material->id => $unique['ids']], $classes)?>"
														data-toggle="modal"
														data-target="#myModal"
														>
													<!-- <span class="glyphicon <?=setup_class([$material->id => $unique['ids']], $checked)?>"></span> -->
													<img data-material-id="<?=$material->id?>" src="<?=src($image,$relative)?>" width="20px">
													<span><?=ucwords($material->name)?></span>
												</li>
												<?php endforeach ?>
											</ul>
										</li>
										<?php endforeach ?>
									</ul>
								</li>
								<?php endforeach ?>
		      		</ul>
						</div>
					</div>
	      </div>
	      <!-- end tree menus -->

         <div id="table-result"></div>
          
        </div><!-- end column -->

      </div><!-- end row -->

    </div><!-- end container -->

</div><!-- end wrap -->


<!-- Default bootstrap modal example -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php include 'partials/footer.php'; ?>


