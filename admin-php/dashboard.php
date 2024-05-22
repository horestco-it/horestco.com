<?php

use Illuminate\Support\Str;

  ini_set("display_errors", 'On');
  require 'api/check_session.php';
  require '../classes/DB.php';
  require '../classes/Db.class.php';
  require '../classes/Helper.php';
  $help = new Helper;

  require '../config.php';
  
  include 'api/form-product.php';
  $db = new Db();
  $date = \Carbon\Carbon::now('Asia/Jakarta');
  $products = Product::orderBy('name')->get();
  $categories = Category::enabled()->orderBy('name')->get();
  $subcategories = Subcategory::enabled()->orderBy('name')->get();


?>
<?php
if(isset($_GET['id']))
{
  $message = array();
}

$img_format = array("jpg", "png", "gif", "bmp");
$max_file_size = 83886080;
$path         = base_path()."assets/images/furniture/";
$pdfPath      = base_path('files/productsheet/');
/////////////////////////
// process ADD PRODUCT //
/////////////////////////
if (isset($_POST['submit']))
{
  $inputs = array(
    'category_id'    => $_POST['category'],
    'subcategory_id' => $_POST['subcategory'],
    'name'           => $_POST['title'],
    'code'           => str_replace(' ', '',$_POST['code']),
    'description'    => $_POST['description'],
    // 'dimension'      => $_POST['dimension'],
    // 'is_promo'       => ( @$_POST['setpromo'] == 'on' ) ? 1 : 0,
    'created_at'     => \Carbon\Carbon::now('Asia/Jakarta')
  );

  $sid = Product::insertGetId($inputs);

  $product = Product::find($sid);

   // sync product also
  if( isset($_POST['alsolike']) || !is_null($_POST['alsolike']) )
  {
    $product->relations()->sync($_POST['alsolike']);
  }

  // ============= subcategory more ==============
  if( isset($_POST['subcategory_more']) && count($_POST['subcategory_more']) ){
    $ids = [];
    foreach ($_POST['subcategory_more'] as $sub) {
      if($sub){
        $ids[] = (int)$sub;
      }
    }
    $product->subcategories()->sync($ids);
    $product->save();
  }
  // REdirect
  header("Location:$_SERVER[PHP_SELF]?action=edit&id=$sid");
}

//////////////////
// EDIT PRODUCT //
//////////////////
if ( isset($_GET['action']) && $_GET['action'] == 'edit' )
{
  $product = Product::whereId($_GET['id'])->with(['category', 'relations'])->first();
  
  $images = $product->images()->get();
  
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
    $product->is_enabled      = (int)$_POST['status'];
    $product->sort_order      = $_POST['priority'];
    // $product->is_promo        = ( @$_POST['setpromo'] == 'on' ) ? 1 : 0;
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
    
    if( isset($_POST['subcategory_more']) && count($_POST['subcategory_more']) ){
      $ids = [];
      foreach ($_POST['subcategory_more'] as $sub) {
        if($sub){
          $ids[] = (int)$sub;
        }
      }
      $product->subcategories()->sync($ids);
      $product->save();
    }


    $filename = array(
      Str::slug($product->category['name']),
      'furniture',
      Str::slug($product->name),
      $product->id
    );

    // PDF management

    $backup = [
      $product->id,
      strtoupper(Str::slug($product->name)),
      'backup',
      $date->toDateString(),
    ];
    
    // return var_dump($_FILES['pdf']['error']);

    if( $_FILES['pdf']['error'] == 0 )
    {
      $pdf = pathinfo($_FILES['pdf']['name']);
      $pdfname = implode('-', $filename)."_v".rand(100, 999).".$pdf[extension]";
      // upload
      if ( move_uploaded_file( $_FILES['pdf']['tmp_name'], $pdfPath.$pdfname ) )
      {
        // backup old pdf
        $backupFile = $pdfPath."backup/". implode('-', $backup).".$pdf[extension]";
        if( file_exists($pdfPath.$product->pdf) && file_exists($backupFile) )
        {
          
          rename($pdfPath.$product->pdf, $backupFile );
        }
        // update database
        $product->pdf = $pdfname;
        $product->save();
      }
    }
    // delete PDF
    elseif( $_POST['pdf-name'] == '')
    {
        $backupFile = $pdfPath."backup/".implode('-', $backup);
        if(file_exists($pdfPath.$product->pdf) && file_exists($backupFile))
          {
              
              rename($pdfPath.$product->pdf, $backupFile);
            
          }
        $product->pdf = '';
        $product->save();
    }


    
    // images
    $config = [
      'multiple' => true,
      'path'     =>  base_path(img_path('furniture/')),
      'filename' => implode('-', $filename),
    ];

    $filenames = upload_image($_FILES['images'], $config);

    if( $filenames && count($filenames) > 0 )
    {
      $data = array(
                'product_id' => (int)$product->id,
                'is_primary' => 0,
                'created_at' => $date,
                'updated_at' => $date
              );

      foreach($filenames as $key => $filename){
        $data['name'] = $filename;
        Image::insert($data);
      }
      if( !in_array(1, $product->images->pluck('is_primary')->toArray()) )
      {
        $id = $product->imageThumb->id;
        $image = Image::find($id);
        $image->is_primary = 1;
        $image->save();
      }
    }

    echo '<script>window.location.href = location.href</script>';
    return;
    
  } // end submit

  //////////////////////////
  // submit specification //
  //////////////////////////
  if (isset($_POST['spcf-submit']))
  {
    //////////
    // edit //
    //////////
    if (isset($_POST['size-edit']))
    {
      // Helper::dd($_POST['price-edit']);exit;
      // edit size
      foreach ($_POST['size-edit'] as $id => $size) {
        $size['is_enabled'] = isset($size['is_enabled']) ? 1 : 0;
        ProductSize::find($id)->update($size);
      }
      
      // edit price
      foreach ($_POST['price-edit'] as $id => $price)
      {
        $price['is_promo'] = isset($price['is_promo']) ? 1 : 0;
        $price['updated_at'] = $date;

        ProductPrice::find($id)->update($price);
      }
    }
    
    /////////
    // add //
    /////////
    if(isset($_POST['size-add']))
    {
      foreach($_POST['size-add'] as $key => $size)
      {
        if( $_POST['size-add'][$key]['name'] != '' )
        {
          $size['product_id'] = $product->id;
          $size['is_enabled'] = isset($size['is_enabled']) ? 1 : 0;
          $size['created_at'] = $date;
          $size['updated_at'] = $date;
          
          $id = $product->sizes()->insertGetId($size);
          // add price
          foreach ($_POST['price-add'] as $key => $price) {
            $price['is_promo'] = isset($price['is_promo']) ? 1 : 0;
            $price['product_id'] = $product->id;
            $price['product_size_id'] = $id;

            ProductPrice::insert($price);
          }
        }
      }
    }
    header("Location:$_SERVER[REQUEST_URI]");
    return;
  }

}

//////////
// AJAX //
//////////
if(check_ajax())
{
  if (isset($_GET['action']) && $_GET['action'] == 'get-subcategories')
  {
    $subcategories = Subcategory::enabled()->where('category_id', $_POST['catid'])->orderBy('name')->get()->toArray();
    print_r(json_encode($subcategories));
    return false;
  }

  // delete image
  if( isset($_GET['action']) && $_GET['action'] == 'delete-image-product' )
  {
    $product = Product::find($_POST['pid']);
    
    $image = Image::find($_POST['id']);
    
    $unlink = unlink(base_path(img_path('furniture/'.$image->name)));

    if($delete = $image->delete())
    {
      if( count($product->images) > 0 && !in_array(1, $product->images->pluck('is_primary')->toArray()) )
      {
        // update is primary if empty is_primary
        $id = $product->imageThumbPrimary->id;
        $image = Image::find($id);
        $image->is_primary = 1;
        $image->save();
      }
    }
    return $delete;
  }

  // DELETE SIZE
  // request url : admin-php/partials/product/specification.php
  if ( isset($_GET['action']) && $_GET['action'] == 'delete-size-specification' )
  {
    $delete = ProductSize::find($_POST['id'])->delete();
    echo $delete;
    return;
  }
}

// top navigation
include 'partials/header.php';

 ?>

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

<!--           <div class="alert alert-warning" style="opacity:.5">
            Beta Version
          </div> -->
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

<!-- Modal confirm to delete -->
<div class="modal fade" id="confirmdeleteimage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancel (Esc)</button>
        <button type="button" class="btn btn-default btn-sm" id="keepdelete">Delete</button>
      </div>
    </div>
  </div>
</div>

 <?php include 'partials/footer.php'; ?>
<script src="<?=BASE_URL?>/admin-php/assets/js/jquery.code-validator.js"></script>
<script>
  $(document).ready(function(){
    // Global variable
    var animation = '<span class="loader"><img src="<?=BASE_URL?>/assets/images/loader.white.gif" /> Loading...</span>';
    var $selectCat = $('#select-category');
    var $selectSubcat = $('.select-subcategory');

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
    });

    // confirm delete product
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
      });
    });



    var $code = $('input[name="code"]');
      
    $('.code').inputCode({
      pathAnimation : '<?=BASE_URL?>/assets/images/loader.white.gif',
      ajax:'<?=BASE_URL?>/admin-php/partials/product/ajax/field-code.php'
    });

    // dinamic subcategory
    $selectCat.change(function(){
      $('.loader').remove()

      var catid = $(this).val();

      $selectSubcat.attr('disabled', 'disabled')
      $(this).attr('disabled', 'disabled')
      $(this).parent().append(animation)
      
      $.post('/admin-php/dashboard.php?action=get-subcategories', {catid:catid}, result)

    });

    function result(data){
      // reset option tag
      $selectSubcat.empty()
      //result to select
        var option = '<option value="">--Choose--</option>'
      $.each(JSON.parse(data), function(index, value){
        option += '<option value="'+value.id+'">'+value.name+'</option>'
      })
      $selectSubcat.html(option)
      $selectCat.removeAttr('disabled')
      $selectSubcat.removeAttr('disabled')
      $('.loader').remove()
    }

    // delete pdf
    $('#delete-pdf').click(function(e){
      e.preventDefault();
      var $inputPdf = $(this).closest('.form-group').find('input[name="pdf-name"]');
      if( confirm('Are you sure?') )
      {
        $inputPdf.val('');
        $(this).prev().remove();
        $(this).remove();
        return false;
      }
      return false;
    })

    // confirm delete image
    $('#confirmdeleteimage').on('show.bs.modal', function(e){
      var button  = $(e.relatedTarget)
      var row     = button.closest('tr')
      var idimage = row.data('imageid')
      var pid = row.data('pid')
      var modal   = $(this)
      var btnDel  = modal.find('#keepdelete')
      modal.find('.modal-body').text('Are you sure want to delete this image ?')

      btnDel.click(function(){
        row.remove()
        var post = $.post('<?=$_SERVER["PHP_SELF"]?>?action=delete-image-product', {id: idimage, pid: pid});
        post.success(function(data){
          modal.modal('hide')
          location.reload();
        })
      })
    });

  });
</script>

  <?php require 'api/form-product.js.php' ?>

  </body>
</html>


