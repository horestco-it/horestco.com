<!-- <div class="container"> -->
	<div class="row grid">

		<div class="col s12 grid-item">
			<h1>Welcome <?=$user['name']?></h1>
		</div>

		<div class="col s12 m8 grid-item">
			<div class="card-panel">
				<div class="card-panel card-panel-title teal white-text">
					<h5>Catalog Approval</h5>
				</div>
				<?php if (count($products) == 0): ?>
					<h5 class="center grey-text">No Item</h5>
				<?php else: ?>
				<table class="borderd highlight">
					<thead>
						<tr>
							<th>Product Name</th>
							<th>User</th>
							<th>Created Date</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach($products as $key => $product):?>
					<tr data-id="<?=$product->id?>">
						<td><?=$product->product['name']?></td>
						<td><?=$product->user['name']?></td>
						<td><?=$product->created_at?></td>
						<td>
							<?php 
								echo $product->is_approved ? '<div class="chip white-text green">Approved</div>':'<div class="chip white-text grey">Pending</div>';
							?>
						</td>
						<td class="dropdown-button center" data-activates="dropdown<?=$key?>">
							<a href="#">
								<i class="mdi-navigation-more-vert small grey-text"></i>
							</a>
							<ul id="dropdown<?=$key?>" class="dropdown-content">
								<?php if (!$product->is_approved && $user['type'] == 'A'): ?>
								<li>
								  <a href="#" class="approve-btn green-text center"><i class="mdi-navigation-check small"></i><br>Approve</a>
								</li>
								<li class="divider"></li>
								<?php endif ?>
								<li>
									<a href="/admin/catalog/edit/<?=$product->product_id?>" class="center"><i class="mdi-image-edit small"></i><br>Edit</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="/admin/catalog/edit/<?=$product->product_id?>/preview" class="grey-text text-darken-3 center" target="_blank">
										<i class="mdi-action-pageview small"></i><br>Preview
									</a>
								</li>
								<li class="divider"></li>
								<li>
								  <a href="#" class="approve-delete-btn red-text center"><i class="mdi-action-delete small"></i><br>Delete</a>
								</li>
							</ul>
						</td>
					</tr>
					<?php endforeach?>
					</tbody>
				</table>
				<?php endif ?>
			</div>
		</div>
		
	</div>
<!-- </div> -->

<script>
	$(document).ready(function(){
		var $approve = $('.approve-btn');
		var $actBtn = $('.dropdown-button');
		var $deleteBtn = $('.approve-delete-btn');

		$approve.click(function(e){
			e.preventDefault();
			var id = $(this).closest('tr').data('id');
			console.log(id)
			var post = $.post('/admin/base/productApprove/approve', {jqxhr:true, id:id});
			post.success(function(data){
				if(data)
				{
					console.log(data);
					location.reload()
				}
			});
		});

		$deleteBtn.click(function(e){
			e.preventDefault();
			var id = $(this).closest('tr').data('id');
			var post = $.post('/admin/base/productApprove/delete',{jqxhr:true, id:id});
			post.success(function(data){
				console.log(data)
				if(data)
				{
					location.reload()
				}
			});
		});

		$actBtn.dropdown({
			hover: true,
			belowOrigin : true,
		})

	});
</script>