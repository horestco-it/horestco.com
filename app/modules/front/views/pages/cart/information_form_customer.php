<div class="input-field"> 
  <div class="form-group">
    <input type="email" name="customer[email]" class="form-control" id="email" required>
    <label class="control-label" for="email">Email <sup class="required">*</sup></label>
  </div>
</div>

<div class="row">
	<div class="col s12 m6">
		<div class="input-field"> 
			<div class="form-group">
				<input type="text" name="customer[fname]" class="form-control" id="customer-fname" required>
				<label class="control-label" for="customer-fname">First Name <sup class="required">*</sup></label>
			</div>
		</div>
	</div>

	<div class="col s12 m6">
		<div class="input-field"> 
			<div class="form-group">
				<input type="text" name="customer[lname]" class="form-control" id="customer-lname">
				<label class="control-label" for="customer-lname">Last Name</label>
			</div>
		</div>
	</div>
</div>

<div class="input-field">
	<div class="form-group">
		<input type="text" name="customer[address]" id="customer-address" class="form-control" required>
		<label for="customer-address">Address <sup class="required">*</sup></label>
	</div>
</div>


<div class="input-field">
	<div class="form-group">
		<input type="text" name="customer[city]" id="customer-city" class="form-control" required>
		<label for="customer-city">City <sup class="required">*</sup></label>
	</div>
</div>

<div class="row">
	<div class="col s12 m6">
		<div class="input-field"> 
			<div class="form-group">
				<select name="customer[country]" id="customer-country" class="browser-default" required>
					<option value="">-- Country --</option>
					<?php foreach ($countries as $id => $name): ?>
						<option value="<?=$id?>"><?=$name?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
	</div>

	<div class="col s12 m6">
		<div class="input-field"> 
			<div class="form-group">
				<input type="text" name="customer[zip]" class="form-control" id="customer-zip" required>
				<label class="control-label" for="customer-zip">Zip <sup class="required">*</sup></label>
			</div>
		</div>
	</div>
</div>

<div class="input-field">
	<div class="form-group">
		<input type="tel" name="customer[telephone]" id="customer-phone" class="form-control" required>
		<label for="customer-phone">Phone <sup class="required">*</sup></label>
	</div>
</div>
