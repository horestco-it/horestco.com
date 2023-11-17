<?php echo validation_errors(); ?>

<?php echo form_open('admin/login/validate', array()); ?>

<div class="card">
  <div class="card-content">
    <div class="row">
      <div class="col s12 center">
        <i class="material-icons medium  teal-text">perm_identity</i><br>
        <span class="card-title">HORESTCO</span>
      </div>

      <input type="hidden" name="goto" value="<?=$redirect?>">

      <div class="input-field col s12">
        <input id="email" type="email" name="email" class="validate" value="<?=set_value('email')?>" autofocus required>
        <label for="email">Email</label>
      </div>
      <div class="input-field col s12">
        <input id="password" type="password" minLength="8" name="password" class="validate" value="<?=set_value('password')?>" required>
        <label for="password">Password</label>
      </div>
    </div>
  </div>
  <div class="card-action">
    <button class="btn waves-effect waves-light" type="submit" name="action">Submit</button>
  </div>
</div>

<?php echo form_close(); ?>



