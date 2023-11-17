<div class="col-sm-6 col-sm-offset-3">

<div class="form-group">
	
	<select name="group" id="selectSearch" class="form-control">
		<option value=""></option>
		<?php foreach ($groups as $key => $value): ?>
		<option value="<?=$value->id?>"><?=strtoupper($value->name)?></p>
		<?php endforeach ?>
	</select>

</div>


</div>

