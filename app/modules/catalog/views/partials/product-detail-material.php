<ul class="collapsible z-depth-0" data-collapsible="accordion">
	<?php

use Illuminate\Support\Str;

		foreach ($subcategories as $key => $sub):
			if( in_array($sub->id, $materials['subcategory_id']) ):
	?>
				<li class="<?=$key?>">
					<div class="collapsible-header grey lighten-4 teal-text active">
						<?=strtoupper($sub->name)?> 
						<?php if ( in_array($category->id, [1,2]) ): ?>
							<sup class="grey-text">&reg;</sup>
						<?php endif ?>
						<i class="fa fa-caret-down grey-text right"></i>
					</div>
					<div class="collapsible-body white" style="padding:1rem">
						<ul class="material-lists">
							<?php
								foreach ($sub->materials()->enabled()->get() as $idx => $material): 
									if( in_array($material->id, $materials['id']) ):

							?>
										<li class="item tooltipped" 
												data-position="top" 
												data-delay="50" 
												data-tooltip="<?=$material->name?>" 
												data-id="<?=$material->id?>"
												data-target="image-<?= $material->images->count() > 0 ? $material->images[0]->id : '' ?>"
												data-target-field="#category-<?=$sub->material_category_id?>"
												>
											<a href="javascript:void(0)" 
													class="" 
													data-original="<?=base_url().product_img_url($material->images->count() > 0 ? $material->images[0]->name : '' )?>">
												<div class="image">
													<img class="z-depth-1 responsive-img" width="50" src="<?=base_url().img_url('material/'.$material['id'].'-'.Str::slug($material['name']).'.jpg')?>" alt="<?=$material->name?>">
												</div>
												<div class="caption center">
														<span class="grey-text">Stock: </span> 
														<span>
															<?= isset($product->stocks[$material->code]) ? $product->stocks[$material->code] : 0 ?>
														</span>
												</div>
											</a>
										</li>
							<?php
									endif;
								endforeach;
							?>
						</ul>
					</div>
				</li>
	<?php
			endif;
		endforeach;
	?>
</ul>
