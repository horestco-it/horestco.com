<div class="input-field"> 
  <div class="form-group">
    <input type="email" 
    				name="customer[email]" 
    				value="<?=set_value('customer[email]')?>" 
    				class="" 
    				id="email" required>
    <label class="control-label" for="email">Email <sup class="required">*</sup></label>
  </div>
</div>

<div class="row">
	<div class="col s12 m6">
		<div class="input-field"> 
			<div class="form-group">
				<input type="text" 
								name="customer[name]" 
								class="" 
								value="<?=set_value('customer[name]')?>" 
								id="customer-fname" required>
				<label class="control-label" for="customer-fname">First Name <sup class="required">*</sup></label>
			</div>
		</div>
	</div>

	<div class="col s12 m6">
		<div class="input-field"> 
			<div class="form-group">
				<input type="text" 
								name="customer[last_name]" 
								value="<?=set_value('customer[last_name]')?>" 
								class="" 
								id="customer-lname">
				<label class="control-label" for="customer-lname">Last Name</label>
			</div>
		</div>
	</div>
</div>

<div class="input-field">
	<div class="form-group">
		<input type="text" 
						name="customer[contact][address]" 
						id="customer-address" 
						value="<?=set_value('customer[contact][address]')?>" 
						class="" required>
		<label for="customer-address">Delivery Address <sup class="required">*</sup></label>
	</div>
</div>


<div class="input-field">
	<div class="form-group">
		<input type="text" 
						name="customer[contact][city]" 
						id="customer-city" 
						value="<?=set_value('customer[contact][city]')?>" 
						class="" required>
		<label for="customer-city">City <sup class="required">*</sup></label>
	</div>
</div>

<div class="row">
	<div class="col s12 m6">
		<div class="input-field"> 
			<div class="form-group">
				<select name="customer[contact][country_id]" id="customer-country" class="browser-default" required>
					<option value="">-- Country --</option>
					<?php foreach ($countries as $id => $name): ?>
						<option value="<?php echo $id ?>" <?= strtolower($name) == 'malaysia'?'selected' : '' ?>><?=$name?></option>

						<!-- <option value="<?=$id?>" <?= strtolower($name) == 'malaysia'?'selected' : 'disabled' ?>><?=$name?></option> -->

					<?php endforeach ?>
				</select>
			</div>
		</div>
	</div>

	<div class="col s12 m6">
		<div class="input-field"> 
			<div class="form-group">
				<input type="text" 
								name="customer[contact][zip]" 
								class="" 
								id="customer-zip" 
								value="<?=set_value('customer[contact][zip]')?>" required>
				<label class="control-label" for="customer-zip">Zip <sup class="required">*</sup></label>
			</div>
		</div>
	</div>
</div>

<div class="input-field">
	<div class="form-group">
		<input type="tel" 
						name="customer[contact][telephone]" 
						id="customer-phone" 
						value="<?=set_value('customer[contact][telephone]')?>" 
						class="" required>
		<label for="customer-phone">Phone <sup class="required">*</sup></label>
	</div>
</div>
