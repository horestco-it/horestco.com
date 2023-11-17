<?php 

$app = include 'frame.php';

if(isset($_POST['submit']) ):
	
	$mpdf = new mPDF('','A4');

	// Buffer the following html with PHP so we can store it to a variable later
	ob_start();

	// This is where your script would normally output the HTML using echo or print
	echo $app->html;
	// Now collect the output buffer into a variable
	$html = ob_get_contents();

	ob_end_clean();
	
	// send the captured HTML from the output buffer to the mPDF class for processing
	$mpdf->WriteHTML($html,0);

	$mpdf->Output();

endif;
// exit;

include '../partials/header.php';
 ?>
 <div class="jumbotron">
	<div class="container">
		<h1>PRICE TAG</h1>
	</div>
</div>

<div class="container">
	<form action="?" method="post">
		<div class="form-group">
			<input type="number" name="_i" min="1" class="form-control input-sm" style="width:100px" placeholder="Number of Item" id="itemNumber" value="1">
		</div>
		<div class="form-group">
			<button class="btn btn-sm" type="submit">Set</button>
		</div>
	</form>
	<form action="?_s=preview" method="POST" role="form">
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Select image</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($app->data as $key => $product): ?>
					<tr class="p-row" data-row-id="<?=$key?>">
						<td style="width:350px">
							<select id="selectProduct" class="selectProduct form-control input-sm">
								<option value="">-- Select --</option>
								<?php foreach ($tag->allProducts() as $p): ?>
									<option value="<?=$p->id?>" <?=$p->id == $product->id? 'selected' : ''?> ><?=$p->name?> <?=$p->id?></option>
								<?php endforeach ?>
							</select>
						</td>
						<td>
							<div class="selectImages">
								<?php foreach($product->images()->get() as $image): ?>
									<img src="<?=base_url('assets/images/furniture/'.$image->name) ?>" data-image-id="<?=$image->id?>" class="select-image" width="100">
								<?php endforeach ?>
								<input type="hidden" class="image-value" value="<?=$image->id?>">
							</div>
						</td>
						<td>
							<a href="#rm" class="btn btn-sm btn-danger remove-item"><span class="glyphicon glyphicon-trash"></span></a>
						</td>
					</tr>
					<?php endforeach ?>

				</tbody>
			</table>
				<input type="hidden" name="_s" id="data">
				<button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
				
			
		</div>
	</div>
	
	</form>

</div>

<script>
	$(document).ready(function(){
		var $btnSetItem = $('#setNumber');
		var $itemNumber = $('#itemNumber');
		var $store = $('#data');

		var $products = $('.selectProduct');
		/**
		 * CONTROL
		 */
		// Class CSS name for select image
		var imageClass = 'select-image';
		// remove item
		var $remove = $('.remove-item');

		update();

		$('.'+imageClass).click(function(e){
			var id = $(this).data('image-id');
			$(this).closest('.selectImages').find('input').val(id);
			update();
		});
		
		// remove item
		$remove.click(function(e){
			$(this).closest('.p-row').remove();
			update();
			e.preventDefault();
		})

		// item loader
		var loader = "Loading...";

		// Class CSS name for select image
		var imageClass = 'select-image';

		$products.change(function(){
			var $row = $(this).closest('.p-row');
			var rowId = $row.data('row-id');
			var $image = $row.find('.selectImages')
			var pid = $(this).val();
			var asset = '<?=base_url()?>assets/images/furniture/';

			$image.empty();
			$image.html(loader);

			$.post('<?=base_url()?>api/productApi/getImagesByProductId/'+pid, function(images){
				$image.emvar $products = $('.selectProduct');

		// item loader
		var loader = "Loading...";

		// Class CSS name for select image
		var imageClass = 'select-image';

		$products.change(function(){
			var $row = $(this).closest('.p-row');
			var rowId = $row.data('row-id');
			var $image = $row.find('.selectImages')
			var pid = $(this).val();
			var asset = '<?=base_url()?>assets/images/furniture/';

			$image.empty();
			$image.html(loader);

			$.post('<?=base_url()?>api/productApi/getImagesByProductId/'+pid, function(images){
				$image.empty();
				images = JSON.parse(images);

				$.each(images, function(i, image){
					var html = '<img src="'+asset+image.name+'" class="'+imageClass+'" data-image-id="'+image.id+'" width="100">';
					$image.append(html);
				});

				$image.append('<input type="text" style="width:100px" class="form-control image-value" name="products['+pid.toString()+']">')

				$('.'+imageClass).click(function(e){
					var id = $(this).data('image-id');
					$(this).closest('.selectImages').find('input').val(id);
				});
			});
		});pty();
				images = JSON.parse(images);

				$.each(images, function(i, image){
					var html = '<img src="'+asset+image.name+'" class="'+imageClass+'" data-image-id="'+image.id+'" width="100">';
					$image.append(html);
				});

				$image.append('<input type="text" style="width:100px" class="form-control image-value" name="products['+pid.toString()+']">')

				$('.'+imageClass).click(function(e){
					var id = $(this).data('image-id');
					$(this).closest('.selectImages').find('input').val(id);
					update();
				});


			});

			update();
			
		});
		function update(){
			var storage = {};
			$('.p-row').each(function(){
				var obj = {};
				var pid = $(this).find('.selectProduct').val();
				var image = $(this).find('.image-value').val();
				// obj[pid] = image;
				// obj.id = $(this).data('row-id');
				storage[pid] = image;
			});
			console.log(storage);

			$store.attr('value', JSON.stringify(storage));
			return storage;
		}

		return;

		var products = [];

		function getProducts(){
			$.post('<?=base_url()?>api/productApi/all', function(data){
				data = JSON.parse(data);
				$.each(data, function(i, v){
					var obj = {id:i, name:v};
					products.push(obj);
				});
			});
		}
		getProducts();

		var $checkout = $('#checkout');
		var $frame = $('#pricetagFrame');

		$frame.hide();


		// collect values
		$checkout.click(function(e){

			var storage = [];
			var ids = [];
			$('.p-row').each(function(){
				var obj = {};
				obj.id = $(this).data('row-id');
				obj.pid = $(this).find('.selectProduct').val();
				obj.image = $(this).find('.image-value').val();
				storage.push(obj);

				ids.push(obj.pid);
			});

			console.log(JSON.stringify(ids));
			$frame.show();

			print('<?=base_url()?>admin-php/pricetag/read.php?ids='+JSON.stringify(ids));
			e.preventDefault();

		});
	});
</script>

<?php include '../partials/footer.php' ?>