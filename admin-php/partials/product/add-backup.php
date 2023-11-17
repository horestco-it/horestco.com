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
              <?php foreach($category as $item):    ?>
              <option <?php if( isset($_GET['id']) && $_GET['id'] == $item['id'] ) echo "selected" ?> value="<?=$item['id']?>"><?=$item['name']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label class="col-sm-4" control-label for="">Sub category:</label>
          <div class="col-sm-8">
            <select name="subcategory" id="select-subcategory" class="form-control input-sm">
              <?php
                if(isset($_GET['id'])):
                  $catid = (int)$_GET['id'];
                  $db->bind('catid', $catid);
                  $subcategory = $db->query(" SELECT id, name FROM subcategories WHERE category_id = :catid AND is_enabled = 1 ORDER BY name ");
                  $helper->dd($subcategory);
               ?>
              <option value="">-- No Sub Category --</option>
                <?php foreach ($subcategory as $index => $item): ?>
              <option value="<?=$item['id']?>" <?php if(!isset($_GET['id']) && $index == 0) echo "selected"?>><?=$item['name']?></option>
              <?php endforeach ?>
              <?php endif ?>
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

        <div class="panel panel-default">
          <div class="panel-heading">
            <h5 class="panel-title">Pricing</h5>
          </div>
          <div class="panel-body">

            <div class="form-group">
              <div class="col-sm-offset-4 col-sm-10">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="setpromo" /> Set Promotion
                  </label>
                </div>
              </div>
            </div>

            <?php 
              $prices = array(
                'normal',
                'promo',
                'project',
                'export'
              );
             ?>
             <?php foreach ($prices as $value): ?>  
             <?php 
              // currency
              $currency = $value == 'export' ? '$ USD' : 'MYR';
              ?>         
              <div class="form-group">
                <div class="col-sm-4">
                  <label for="" class="text-capitalize"><?=$value?>:</label>
                </div>
                <div class="col-sm-8">
                  <div class="input-group">
                    <div class="input-group-addon input-sm">
                      <?=$currency?>
                    </div>
                    <input type="text" value="0.00" name="<?=$value?>-price" class="form-control input-sm " placeholder="<?=$value?> price" />
                  </div>
                </div>
              </div>
              <?php endforeach ?>

              <hr>
            
              <div class="form-group">
                <div class="col-sm-4">
                  <label for="" class="text-capitalize">Promo Description:</label>
                </div>
                <div class="col-sm-8">
                  <textarea name="promo-description" id="" class="form-control" rows="1"></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-4">
                  <label for="" class="text-capitalize">Promo Note:</label>
                </div>
                <div class="col-sm-8">
                  <textarea name="promo-note" id="" class="form-control" rows="1"></textarea>
                </div>
              </div>
          </div>
        </div>

        <script>
          $(document).ready(function(){
            $('input[name="setpromo"]').change(function(){
              var isChecked = $(this).prop('checked')
              var normal    = $('input[name="normal-price"]')
              var promo     = $('input[name="promo-price"]')
              if ( isChecked ) {
                promo.attr({'required':'required', 'placeholder':'Promo price is required'})
                normal.attr({'required':'required', 'placeholder':'Normal price is required'})
                if ( promo.val() == "" ) promo.focus()
                if ( normal.val() == "" ) normal.focus()
              }else{
                promo.attr({'required': false, 'placeholder':'Promo price'})
                normal.attr({'required': false, 'placeholder':'Normal price'})
              }
            });
          });
        </script>
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
            <label for="">Dimension:</label>
          </div>
          <div class="col-sm-8">
            <textarea name="dimension" class="form-control input-sm" id="" placeholder="Input dimension" rows="3"></textarea>
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

<!--         <div class="form-group">
          <div class="col-sm-4">
            <label for="">image(s)</label>
          </div>
          <div class="col-sm-8">
            <input type="file" name="images[]" multiple="multiple" accept="image/*" class="form-control input-sm"/>
            <p class="help-block"><em>You can select multiple images</em></p>
          </div>
        </div>   -->

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

