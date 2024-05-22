<?php

use Illuminate\Support\Str;

	function is_active_material($allMaterial, $hasManyMaterial){
		foreach($allMaterial as $category){
			if( in_array($category->id, $hasManyMaterial) )
			{
				return $category->id;
			}
		}
		return false;
	}
 ?>
<div class="row">
	<div class="col s12 grey lighten-3 grey-text">
		<div class="section add-to-cart" style="z-index:10">

			<form class="add-cart">

				<?php if ($product->sizes->count() > 0): ?>
				<div class="size">
					<label for="search-size" class="orange-text">Size:</label>
					<select class="browser-default" v-model="size" name="product[size]" id="search-size">
						<?php foreach ($product->sizes as $key => $size): ?>
						<option value="<?=$size->id?>" <?= $key == 0 ?'selected' : '' ?>>
							<?=strtoupper($size->name)?>
						</option>
						<?php endforeach ?>
					</select>
				</div>
				<?php endif ?>

				<div class="section qty">
					<label for="qty" class="orange-text">Quantity:</label>
					<input type="number" min="1" class="form-control center" name="product[qty]" value="1">
				</div>
				
				<?php foreach ($Material['required'] as $key => $category): ?>
					<?php if (in_array($category->id, $materials['category_id'])): ?>
						
					<div class="section select-material <?=Str::slug($category->name)?>">
						<label class="orange-text"><?=ucwords($category->name)?>:</label>
						<?php $this->load->view('product-detail-material', 
							[
								'category' => $category,
								'product' => $product,
								'subcategories' => $category->subcategories,
								'materials' => $materials
							])?>
					</div>
					<?php endif ?>
				<?php endforeach ?>
				
				<div class="divider"></div>

				<?php 
				$id_sub_cat=$product['subcategory_id'];
					if ( 
							is_active_material($Material['optional'], $materials['category_id'])
						// && $product->prices->sunbrella != 0.00 
						// && $product->prices->sunproof != 0.00
					): 
					
					if($id_sub_cat==70){
					
					?>
					
					<div class="section select-material optional-material">
		      	<input type="checkbox" class="filled-in" id="add-fabric-checkbox" />
		      	<label for="add-fabric-checkbox">Add Canopy</label>
		      	<br>
							<div class="select-fabric-box">
								<label class="orange-text">Canopy Fabric:</label>
						<?php foreach ($Material['optional'] as $key => $category): ?>
								<?php $this->load->view('product-detail-material', 
								[
									'category' => $category,
									'subcategories' => $category->subcategories,
									'product' => $product,
									'materials' => $materials
								])?>
					
							</div>
					</div>
					<?php endforeach ?>
					
					<?php 
					}else{
					?>
					<div class="section select-material optional-material">
		      	<input type="checkbox" class="filled-in" id="add-fabric-checkbox" />
		      	<label for="add-fabric-checkbox">Add Cushion</label>
		      	<br>
							<div class="select-fabric-box">
								<label class="orange-text">Cushion Fabric:</label>
						<?php foreach ($Material['optional'] as $key => $category): ?>
								<?php $this->load->view('product-detail-material', 
								[
									'category' => $category,
									'subcategories' => $category->subcategories,
									'product' => $product,
									'materials' => $materials
								])?>
						
							</div>
					</div>
					<?php endforeach ?>
					<?php 
					
					}
					?>
					
					
				<?php endif ?>

				<div class="section button" style="margin-bottom: 1rem">
			    <input type="hidden" readonly="1" id="" name="product[id]" value="<?=$product->id?>">
			    <input type="hidden" readonly="1" id="" name="product[name]" value="<?=$product->name?>">
			    
			    <?php if ($categoryId = is_active_material($Material['required'], $materials['category_id'])): ?>
			    <?php endif ?>

			    <?php foreach ($Material['required'] as $key => $category): ?>
						<?php if (in_array($category->id, $materials['category_id'])): ?>
							
			    	<input type="hidden" readonly="1" id="category-<?=$category->id?>" name="materials[required][<?=$category->id?>]" value="" placeholder="<?=$category->name?>">

						<?php endif ?>
					<?php endforeach ?>

			    <?php if ($categoryId = is_active_material($Material['optional'], $materials['category_id'])): ?>
			    	<input type="hidden" readonly="1" id="category-<?=$categoryId?>" class="optional-category-field" name="materials[optional][<?=$categoryId?>]" value="" placeholder="<?=$category->name?>">
			    <?php endif ?>
			    
			    <input type="hidden" readonly="1" id="isAddOptional" name="isAddOptional" value="false">
	        <!--<button class="btn teal" type="submit" style="width:100%">-->
		      	<!--<i class="mdi-action-shop left"></i>-->
		      	<!--<span class="text-cart">Add To Cart</span> -->
	        <!--</button>-->

	        <div class="progress" style="opacity: 0">
			      <div class="indeterminate"></div>
			  	</div>

				</div>
			</form>

		</div>
	</div>
</div>

  