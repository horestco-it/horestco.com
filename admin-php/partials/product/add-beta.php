<?php 
$codelists = $db->query(" SELECT code FROM products ");
$code_count = count($codelists);
 ?>
<form action="<?=$_SERVER['REQUEST_URI']?>" method="POST" class="form-horizontal" role="form" enctype="multipart/form-data">
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Add New Product</h3>
    </div>
    <div class="panel-body">

      <div class="col-sm-6">

        <div class="form-group">
          <label class="col-sm-4" control-label for="">Category:</label>
          <div class="col-sm-8">
            <select name="category" id="select-category" class="form-control input-sm" required="required">
              <option value="">-- Please select --</option>
              <?php foreach($categories as $category):    ?>
              <option value="<?=$category['id']?>"><?=$category['name']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4" control-label for="">Sub category:</label>
          <div class="col-sm-8">
            <select name="subcategory" id="select-subcategory" class="form-control input-sm">
              <option value="">-- No Sub Category --</option>
                <?php foreach ($subcategories as $index => $item): ?>
              <option value="<?=$item['id']?>"><?=$item['name']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Title:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" name="title" class="form-control input-sm" id="" placeholder="Input Title" required="required"/>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Code:</label>
          </div>
          <div class="col-sm-8">
            <input type="text" list="codelists" name="code" class="form-control input-sm" id="" placeholder="Input Product Code" />
          </div>
          <script src="<?=BASE_URL?>/admin-php/assets/js/jquery.code-validator.js"></script>
          <script>
          $('input[name="code"]').inputCode({
            pathAnimation : '<?=BASE_URL?>/assets/images/loader.white.gif',
            ajax:'<?=BASE_URL?>/admin-php/partials/product/ajax/field-code.php'
          })
          </script>
        </div>

      </div>
      <div class="col-sm-6">  
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Description:</label>
          </div>
          <div class="col-sm-8">
            <textarea name="description" class="form-control input-sm" id="" placeholder="Input description" rows="5" required="required"></textarea>
          </div>
        </div>
        
        <div class="form-group">
          <div class="col-sm-4">
            <label for="">Also Like:</label>
          </div>
          <div class="col-sm-8">
            <select name="alsolike[]" multiple="multiple" id="also-add" class="form-control input-sm">
              <?php foreach($products as $product): ?>
              <option value="<?=$product['id']?>"><?=$product['name']?></option>
              <?php endforeach ?>
            </select>
            <script>
                $('#also-add').select2({
                  placeholder : 'Select other product to recommend'
                });

                
            </script>
          </div>
          
        </div>

        </div><!-- end column 6 -->
        <div class="col-sm-12">
          <div class="form-group">
            <div class="col-sm-8 col-sm-offset-4">
              <button type="submit" name="submit" class="btn btn-primary btn-sm" disabled>Submit</button>
              <button type="reset" class="btn btn-info btn-sm">Reset</button>
              <a href="<?=THIS_FILE?>" type="button" class="btn btn-danger btn-sm">Cancel</a>
            </div>
          </div>
        </div>

    </div><!-- end panel-body -->
  </div>
</form>
<div class="col-md-6">

</div>

