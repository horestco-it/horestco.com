<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'api/check_session.php';

if (!isset($_SESSION['type']) || $_SESSION['type'] != 'A' ){
  echo "Access Denied. <br/>";
  echo "<a href='/admin-php/dashboard.php'>Dashboard</a>";
  return;
}

require '../config.php';
require '../classes/Helper.php';
require '../classes/DB.php';

$helper = new Helper;
$db = $capsule;


?>

<?php
  $categories = Category::enabled()->orderBy('name')->get();
  $subcatid = '';
  $catid = '';
?>

<?php include 'partials/header.php'; ?>

<div class="container main" style="padding-top: 6em">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <!-- <div class="alert alert-info">
        columns: <br/>
        <code>[id, name, sku, description, Weight (kg), Length (cm), Width (cm), Height (cm), Regular price, Categories, Images]</code>
      </div> -->
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h3 class="panel-title">Export products for WooCommerce</h3>
        </div>
    
        <div class="panel-body">
          <form id="form" action="<?=BASE_URL?>/admin-php/export-submit.php" method="POST" role="form">
    
            <div class="form-group row">
              <label class="col-sm-4" control-label for="">Category:</label>
              <div class="col-sm-8">
                <select name="category" id="select-category" class="form-control input-sm" required="required">
                  <option value="">-- Please select --</option>
                  <?php foreach($categories as $category):    ?>
                  <option value="<?=$category['id']?>" <?= ($category['id'] == $catid) ? 'selected':'' ?>><?=$category['name']?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>     
            
            <div class="form-group row">
              <label class="col-sm-4" control-label for="">Sub Category:</label>
              <div class="col-sm-8">
                <select name="subcategory" id="select-subcategory" class="form-control input-sm select-subcategory" required>
                  <option value="">-- No Sub Category --</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-8 col-sm-offset-4">
                <button type="submit" name="submit" class="btn btn-info">Export CSV</button>
                <a href="<?=$_SERVER['PHP_SELF']?>" name="cancel" class="btn btn-warning">Cancel</a>
              </div>
            </div>
    
    
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  // dinamic subcategory
  $('#select-category').change(function(){
    console.log('change')
    $('.loader').remove()

    var catid = $(this).val();

    $('.select-subcategory').attr('disabled', 'disabled')
    $(this).attr('disabled', 'disabled')
    
    $.post('/admin-php/dashboard.php?action=get-subcategories', {catid:catid}, function (data){
      // reset option tag
      $('.select-subcategory').empty()
      //result to select
        var option = '<option value="">--Choose--</option>'
      $.each(JSON.parse(data), function(index, value){
        option += '<option value="'+value.id+'">'+value.name+'</option>'
      })
      $('.select-subcategory').html(option)
      $('#select-category').removeAttr('disabled')
      $('.select-subcategory').removeAttr('disabled')
      $('.loader').remove()
    })

  });

  // $('#form').submit(function(e){
  //   e.preventDefault();
  //   console.log('submit')
  //   saveData(data, fileName);

  //   $.ajax({
  //     url: $(this).attr('action'),
  //     method: $(this).attr('method'),
  //     dataType: 'json',
  //     data: $(this).serialize(),
  //     success: function(data){
  //       console.log('data', data)
  //     }
  //   })
  // })


</script>

<?php include 'partials/footer.php'; ?>
