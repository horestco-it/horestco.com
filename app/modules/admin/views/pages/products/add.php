<div class="container">
	 <div class="row">
    <form class="col s12" method="post" action="?">

    	<h5>Basic Information</h5>
    	<div class="divider"></div>
      <div class="row">

        <input type="hidden" id="created_at" name="created_at" class="validate" value="<?=\Carbon\Carbon::now('Asia/Jakarta')?>" required>

        <div class="col s12 m6 input-field">
          <select id="select-categories" name="category_id" class="browser-default validate" required>
          	<option value="" disabled selected>- - Category/Area - -</option>
          	<?php
              foreach ($categories as $key => $category) {
          			echo "<option value=\"$category->id\">$category->name  [ $category->slug ]</span></option>";
          		}
          	?>
          </select>
        </div>

        <div class="col s12 m6 input-field">
          <select id="select-subcategories" name="subcategory_id" class="browser-default validate" disabled>
          	<option value="" disabled selected>- - Subcategory - -</option>
          </select>
        </div>

        <div class="col s12 m6 input-field">
        	<input type="text" id="name" name="name" class="validate" required>
        	<label for="name">Name:</label>
        </div>

        <div class="col s12 m6 input-field">
        	<input type="text" id="code" name="code" class="validate" required>
        	<label for="code">Code:</label>
        	<div class="info-field red-text"></div>
        </div>

        <div class="col s12 m6 input-field">
        	<textarea name="description" id="description" class="materialize-textarea"></textarea>
        	<label for="description">Description:</label>
        </div>

        <div class="col s12 m6 input-field">
        	<textarea name="dimension" id="dimension" class="materialize-textarea"></textarea>
        	<label for="dimension">Dimension:</label>
        </div>

        <div class="col s12 submit">
        	<div id="result"></div>
          <button class="btn" type="submit">create</button>
        </div>

      </div>

    </form>
  </div>
</div>

<?php $this->load->view('partials/scripts/product-form.js.php') ?>