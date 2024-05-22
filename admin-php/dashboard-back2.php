<?php

use Illuminate\Support\Str;

  ini_set("display_errors", 1);
  require 'api/check_session.php';

  require '../classes/DB.php';

  require '../classes/Db.class.php';

  require '../classes/Helper.php';

  require '../config.php';

  $db = new Db();

  $help = new Helper;
  $products = Product::enabled()->get();
  // Helper::dd();
  $subcategories = Subcategory::enabled()->get();
  

  $category = $db->query(" SELECT * FROM categories WHERE is_enabled = 1 ORDER BY name ");

  $product_id = $db->query(" SELECT * FROM products WHERE is_enabled = 1 ");

  // Retrieve data product for alsolike



 ?>

 <?php
if(isset($_GET['id']))
{
  $message = array();
  $prices = $db->row(" SELECT * FROM product_prices WHERE product_id = ".$_GET['id']." ");
}
$img_format = array("jpg", "png", "gif", "bmp");
$max_file_size = 83886080;
$path         = base_path()."assets/images/furniture/";
// process ADD PRODUCT
if (isset($_POST['submit'])) {

    $pdf_format = "pdf";
    $max_file_size = 83886080;
    $medium_path  = base_path()."assets/images/furniture/tmp/m/";
    $count = 0;

    // Helper::dd($_POST);return;

    $inputs = array(
      'category_id'    => $_POST['category'],
      'subcategory_id' => $_POST['subcategory'],
      'name'           => $_POST['title'],
      'code'           => str_replace(' ', '',$_POST['code']),
      'description'    => $_POST['description'],
      'dimension'      => $_POST['dimension'],
      'is_promo'       => ( @$_POST['setpromo'] == 'on' ) ? 1 : 0,
      'created_at'     => \Carbon\Carbon::now('Asia/Jakarta')
    );

    $sid = Product::insertGetId($inputs);

    $product = Product::find($sid);

    $prices = array(
      'product_id'        => $sid ,
      'normal'            => $_POST['normal-price'],
      'project'           => $_POST['project-price'],
      'export'            => $_POST['export-price'],
      'promo'             => $_POST['promo-price'],
      'promo_description' => $_POST['promo-description'],
      'promo_note'        => $_POST['promo-note'],
    );

    $insert = $product->prices()->insert($prices);

     // sync product also
    if( isset($_POST['alsolike']) || !is_null($_POST['alsolike']) )
    {
      $product->relations()->attach($_POST['alsolike']);
    }

  // REdirect
  if($insert) header("Location:dashboard.php?action=edit&id=$sid");
}

// EDIT PRODUCT
if ( isset($_GET['action']) && $_GET['action'] == 'edit' )
{
  $product = Product::whereId($_GET['id'])->with(['category'])->first();
  $productAlsoIds = $product->relations()->get()->lists('id');
  $price = $product->prices()->get()[0];
  // process EDIT PRODUCT
  if ( isset($_POST['edit-submit']) )
  {
  // ============================================================================================
  // Record to database
  // PRODUCTS
  // ============================================================================================ 

    $product->category_id     = $_POST['category'];
    $product->subcategory_id  = $_POST['subcategory'];
    $product->name            = $_POST['title'];
    $product->code            = str_replace(' ', '',$_POST['code']);
    $product->description     = $_POST['description'];
    $product->dimension       = $_POST['dimension'];
    $product->is_enabled      = (int)$_POST['status'];
    $product->sort_order      = $_POST['priority'];
    $product->is_promo        = ( @$_POST['setpromo'] == 'on' ) ? 1 : 0;
    $product->updated_at      = \Carbon\Carbon::now('Asia/Jakarta');
    $product->save();

    // sync product also
    if( !isset($_POST['alsolike']) || is_null($_POST['alsolike']) )
    {
      $product->relations()->detach();
    }
    else{
      $product->relations()->sync($_POST['alsolike']);
    }

  // ============================================================================================
  // Record to database
  // PRICES
  // ============================================================================================  
    $prices = array(
      'normal'                => $_POST['normal-price'],
      'promo'                 => $_POST['promo-price'],
      'project'               => $_POST['project-price'],
      'export'                => $_POST['export-price'],
      'promo_description'     => $_POST['promo-description'],
      'promo_note'            => $_POST['promo-note']
    );
    if (count($product->prices()->get()) == 0)
    {
      // insert new
      $prices['product_id'] = $_GET['id'];
      $price = $product->prices()->insert($prices);
    }
    else{
      // update
      $price = $product->prices()->update($prices);
    }

    
    $count = 0;
    
    if( $_FILES['images']['error'][0] == 0 ) // if isset file
    {
      try {
        foreach($_FILES['images']['name'] as $key => $name){
          $ext = pathinfo($name, PATHINFO_EXTENSION);
          if (!in_array($ext, $img_format))
          {
            throw new Exception("Format image <strong>{$name}</strong> is not allow");
          }
          if ($_FILES['images']['size'][$key] > $max_file_size) {
            throw new Exception("<strong>{$name}</strong> is too large!");
          }

          $filename = array(
            Str::slug($product->category['name']),
            'furniture',
            Str::slug($product->name),
            $product->id,
            rand(100, 999)
          );

          $filename = implode('-', $filename).".$ext";
          
          if( move_uploaded_file($_FILES["images"]["tmp_name"][$key], $path.$filename) )
          {
            $data = array(
              'product_id' => $_GET['id'],
              'name'       => $filename,
              'is_primary' => 0,
              'created_at' => \Carbon\Carbon::now('Asia/Jakarta'),
              'updated_at' => \Carbon\Carbon::now('Asia/Jakarta')
            );
            if(Image::insert($data))
            {
              echo "<span class=\"text-success\"><strong>$name</strong> is uploaded </span><br>";
              echo "Refresh...";
            }
          }
        }
      } catch (Exception $e) {
        print_r($e->getMessage());
      }
    }
    header("Refresh:0");
    return;
    
  } // end submit

}

//AJAX
if (isset($_GET['action']) && $_GET['action'] == 'get-subcategories')
{
  $subcategories = Subcategory::enabled()->where('category_id', $_POST['catid'])->orderBy('name')->get()->toArray();
  print_r(json_encode($subcategories));
  return false;
}

 ?>




    <!-- top navigation -->

<?php include 'partials/header.php'; ?>

<div id="wrap">

    <div id="dashboard" class="container">

      <div class="row">
        <div class="col-sm-6">
          <?php if (isset($message) && count($message) > 0): ?>
            <?php foreach ($message as $key => $msg): ?>
              <div class="alert alert-danger">
                <?php echo $msg ?>
              </div>
            <?php endforeach ?>
          <?php endif ?>
        </div>
        <div class="col-sm-12 main">

          <h2 class="text-center">Manage Product</h2>

          <div class="row">

          <?php

            $action = (isset($_GET['action'])) ? $_GET['action'] : null;

            switch ($action) {

              case 'add':

                include 'partials/product/add.php';

                break;

              case 'mng-com':

                include 'partials/product/commercial-settings.php';

                break;

              case 'edit':

                include 'partials/product/edit.php';

                break;

              case 'search':

                include 'partials/product/search.php';

                break;

              case 'delete':

                include 'partials/product/delete.php';

                break;

              default:

                include 'partials/product/search.php';

                break;

            }

          ?>

          </div>

          <div id="table-result"></div>
          
        </div><!-- end column -->

      </div><!-- end row -->

    </div><!-- end container -->

</div><!-- end wrap -->

    <script>

      $(document).ready(function(){



        $('#form-search-product').submit(function(e){

          e.preventDefault()

          $('#table-result').html('')

          $('#table-result').prepend('<p class="text-center">Loading...</p>')

          $.ajax({
            method: 'POST',
            data: $(this).serialize(),
            url: 'partials/product/ajax/search-product.php',
            success: function(data){
              $('#table-result').html('')
              $('#table-result').append(data)
            }
          })
        })

        // delete product

        $('#confirmdelete').on( 'show.bs.modal', function(e){

          var button  = $(e.relatedTarget)

          var row     = button.closest('tr')

          var id      = row.data('id')

          var modal   = $(this)

          var btnDel  = modal.find('#keepdelete')

          modal.find('.modal-body').text('Are you sure want to delete product id '+id+' ?')

          

          btnDel.click(function(){

            row.remove()

            $.get('<?=THIS_FILE?>', {action:'delete', id:id}) // horestco.dev/admin-php/dashboard.php?action=delete&id=$id

            modal.modal('hide')

          })

        })

      });

    </script>



    <!-- Modal confirm to delete product -->

    <div class="modal fade" id="confirmdelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

      <div class="modal-dialog modal-sm">

        <div class="modal-content">

          <div class="modal-body">

            Are you sure want to delete product id 

          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancel (Esc)</button>

            <button type="button" class="btn btn-default btn-sm" id="keepdelete">Delete</button>

          </div>

        </div>

      </div>

    </div>

    <?php include 'partials/footer.php'; ?>

    <script>
    $(document).ready(function(){
      // Global variable
      var animation = '<span class="loader"><img src="<?=BASE_URL?>/assets/images/loader.white.gif" /> Loading...</span>';
      var $selectCat = $('#select-category');
      var $selectSubcat = $('#select-subcategory');

      // dinamic subcategory
      $selectCat.change(function(){
          $('.loader').remove()

          var catid = $(this).val();

          $selectSubcat.attr('disabled', 'disabled')
          $(this).attr('disabled', 'disabled')
          $(this).parent().append(animation)
          
          $.post('/admin-php/dashboard.php?action=get-subcategories', {catid:catid}, result)

          function result(data){
            // reset option tag
            $selectSubcat.empty()
            //result to select
            $.each(JSON.parse(data), function(index, value){
              var option = '<option value="'+value.id+'">'+value.name+'</option>'
              $selectSubcat.append(option)
            })
            $selectCat.removeAttr('disabled')
            $selectSubcat.removeAttr('disabled')
            $('.loader').remove()
          }
        })
    })
    </script>
  </body>

</html>


