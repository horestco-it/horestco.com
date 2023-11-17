<div class="input-field"> 
  <div class="form-group">
  	<span class="grey-text">Payment method</span><br>
    <input class="with-gap" name="payment-id" type="radio" id="payment-method" checked />
    <label for="payment-method" class="radio"><img class="materialboxed bill-credit" height="30" src="<?=base_url().img_url()?>bill-card.jpg"></label>
  </div>
</div>

<div class="row">
	<div class="col s12 m8">
		<div class="input-field">
			<div class="form-group">
				<input type="text" id="cc-number">
				<label for="cc-number">Credit Card Number <sup class="required">*</sup></label>
			</div>
		</div>
	</div>
	<div class="col s12 m4">
		<div class="input-field">
			<div class="form-group">
				<input type="text" id="cc-verification">
				<label for="cc-verification">CVV <sup class="required">*</sup></label>
			</div>
		</div>
	</div>
</div>

<div class="input-field">
	<span class="grey-text">Expiration Date</span><br/>
	<div class="row">
		<div class="col s12 m4">
  		<div class="form-group">
  		  <select class="browser-default" name="cc-month" id="cc-month-exp">
  		  <?php for ($i=1; $i <= 12; $i++): ?>
  		  	<option value="<?=$i?>"><?=$i?></option>
  		  <?php endfor ?>
  		  </select>
  		</div>
		</div>
		<div class="col s12 m8">
  		<div class="form-group">
  		  <select class="browser-default" name="date" id="cc-year-exp">
  		  <?php for ($i=date('Y'); $i <= date('Y')+12; $i++): ?>
  		  	<option value="<?=$i?>"><?=$i?></option>
  		  <?php endfor ?>
  		  </select>
  		</div>
		</div>
	</div>
</div>
