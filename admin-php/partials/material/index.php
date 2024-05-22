<div class="col-sm-12">
<?php

use Illuminate\Support\Str;

 foreach ($materialLists as $key => $cat): ?>
	<div class="row">
		<h2 id="<?=$cat->name?>">.::<?=ucwords($cat->name)?>::.</h2>
		<hr>

		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

			<?php foreach ($cat->subcategories as $i => $sub):
				$id = "$key-$i";
				$isOpen = $i == 0 ? true : false;
			?>
		  <div class="panel panel-default">
		    <div class="panel-heading" role="tab" id="sub-role-<?=$id?>">
		      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#sub-col-<?=$id?>" aria-expanded="<?=$isOpen?>" aria-controls="collapse<?=$id?>">
		      	<h4 class="panel-title">
		          <?=ucwords($sub->name)?>
		      	</h4>
		       </a>
		    </div>
		    <div class="panel-collapse collapse in" 
		    		id="sub-col-<?=$id?>" 
				    role="tabpanel" 
				    aria-labelledby="sub-role-<?=$id?>">
		      <div class="panel-body">
		      	<ul class="list-inline">
		      	<?php
		      		foreach ($sub->materials as $im => $material):
		      		$image = img_path('material/'.$material->id.'-'.Str::slug($material->name).'.jpg');
		      		$src = file_exists(base_path($image)) ? base_url($image) : base_url(img_path('not-available.jpg'));
		      	?>
		      		<li class="thumbnail item" data-id="<?=$material->id?>">
		      			<a href="?action=edit&amp;id=<?=$material->id?>" target="_blank">
		      				<img width="120px" height="90px" src="<?=$src?>" data-original="<?=base_url($image)?>">
		      				<center><?=ucwords($material->name)?></center>
		      			</a>
		      			<br>
		      			<ul class="list-inline">
		      				<li>
		      					<div class="checkbox">
		      						<label>
		      							<input type="checkbox" class="enabling" <?= $material->is_enabled == 1? 'checked':'' ?> >
		      							Enable
		      						</label>
		      						<span class="info"></span>
		      					</div>
		      				</li>
		      				<li>
		      					<a href="#" data-id="<?=$material->id?>" data-confirm="Are you sure delete <?=$material->name?>?" class="delete-material" title="delete"><span class="glyphicon glyphicon-trash text-danger"></span> Delete</a>
		      				</li>
		      			</ul>
		      		</li>
		      	<?php endforeach ?>
		      	</ul>
		      </div>
		    </div>
		  </div>
			<?php endforeach ?>

		</div>

	</div>
<?php endforeach ?>
</div>

