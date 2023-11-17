<?php
  ini_set("display_errors", 1);
  require 'api/check_session.php';

  require '../classes/DB.php';

  require '../classes/Db.class.php';

  require '../classes/Helper.php';

  require '../config.php';

  $db = new Db();

  $help = new Helper;
  $product = Product::find($_GET['id']);
  $products = Product::enabled()->get();
  $productAlsoIds = $product->relations()->get()->lists('id');
  // Helper::dd();

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

// process ADD PRODUCT
if (isset($_POST['submit'])) {

    $img_format = array("jpg", "png", "gif", "bmp");
    $pdf_format = "pdf";
    $max_file_size = 83886080;
    $path         = BASE_DIR."/assets/images/furniture/";
    $medium_path  = BASE_DIR."/assets/images/furniture/tmp/m/";
    $count = 0;

    $db->bind( 'category'      , $_POST['category'] );
    $db->bind( 'subcategory'   , $_POST['subcategory'] );
    $db->bind( 'title'         , $_POST['title'] );
    $db->bind( 'code'          , str_replace(' ', '',$_POST['code']) );
    // $db->bind( 'alsolike'      , is_null(@$_POST['alsolike']) ? null : implode(',', $_POST['alsolike']) );
    $db->bind( 'description'   , $_POST['description'] );
    $db->bind( 'dimension'     , $_POST['dimension'] );
    $db->bind( 'setpromo'      , ( @$_POST['setpromo'] == 'on' ) ? 1 : 0 );


    // record data product to database
    $rec_prod    = $db->query(" INSERT INTO products(name,description,dimension,code,category_id,subcategory_id,is_promo) VALUES (:title,:description,:dimension,:code,:category,:subcategory,:setpromo) ");
    // $rec_prod    = $db->query(" INSERT INTO products(name,description,dimension,also_like,code,category_id,subcategory_id,is_promo) VALUES (:title,:description,:dimension,:alsolike,:code,:category,:subcategory,:setpromo) ");
    $sid = $db->lastInsertId();

    $db->bind( 'pid'           , $sid );    
    $db->bind( 'np'            , $_POST['normal-price']);
    $db->bind( 'pp'            , $_POST['project-price']);
    $db->bind( 'ep'            , $_POST['export-price']);
    $db->bind( 'rp'            , $_POST['promo-price']);
    $db->bind( 'pd'            , $_POST['promo-description']);
    $db->bind( 'pn'            , $_POST['promo-note']);
    $rec_prices  = $db->query(" INSERT INTO product_prices(normal,project,export,promo,promo_description,promo_note,product_id) VALUES (:np, :pp, :ep, :rp, :pd, :pn, :pid) ");
            
    // Loop $_FILES to exeicute all images
    foreach ($_FILES['images']['name'] as $f => $name) {
      $ext = pathinfo($name, PATHINFO_EXTENSION);

      
      if ($_FILES['images']['error'][$f] == 4){        
        $message[] = "No file choosen !";
        continue;
      }

      if ($_FILES['images']['error'][$f] == 0) {

        if ($_FILES['images']['size'][$f] > $max_file_size) {
          $message[] = "$name is too large!";
          continue; // Skip large images
        }
        elseif( ! in_array($ext, $img_format) ){
          $message[] = "$name is not a valid format";
          continue; // Skip invalid file formats
        }                   
        else{ // No error found! Move uploaded images
          $img_name =  uniqid($sid. "-" .str_replace(" ", "-", $_POST['title']) ).".".$ext;
          $img_name = strtolower($img_name);

          // upload image to directory
          // upload original size
          if(move_uploaded_file($_FILES["images"]["tmp_name"][$f], $path.$img_name)){  

          include_once '../classes/simpleImage.class.php';

          // create instant object from class

          $image = new SimpleImage();

          $image->load($path.$img_name);

          // resize image to medium then upload
          $image->resizeToWidth(225);
          $image->save($medium_path.$img_name);                  

            // record image links to database
            if ($rec_prod > 0) { 

              $db->bind('prodid'  , $sid);
              $db->bind('imgname' , $img_name);
              $db->bind('primary' , ($count == 0) ? 1 : 2 );
              $rec_images  = $db->query(" INSERT INTO images(product_id,name,is_primary) VALUES (:prodid,:imgname,:primary) ");

              $count++; // Number of successfully uploaded file

            }

          }
        }
      }
    } // endforeach

  // REdirect
  if(count($message) == 0) header("Location:dashboard.php?action=edit&id=$sid");
}

// process EDIT PRODUCT
if ( isset($_POST['edit-submit']) )
{

  $product->category_id     = $_POST['category'];
  $product->subcategory_id  = $_POST['subcategory'];
  $product->name            = $_POST['title'];
  $product->code            = str_replace(' ', '',$_POST['code']);
  $product->description     = $_POST['description'];
  $product->dimension       = $_POST['dimension'];
  $product->is_enabled      = $_POST['status'];
  $product->sort_order      = $_POST['priority'];
  $product->is_promo        = ( @$_POST['setpromo'] == 'on' ) ? 1 : 0;
  $product->save();

  // sync product also
  if( !isset($_POST['alsolike']) || is_null($_POST['alsolike']) )
  {
    $product->relations()->detach();
  }
  else{
    $product->relations()->sync($_POST['alsolike']);
  }

  header("Refresh:0");
  return;
  $sid          = $_GET['id'];
  $title        = $_POST['title'];
  $pdf_name     = $sid."-".str_replace(" ", "-", $title).".pdf";
// ============================================================================================
// Record to database
// PRODUCTS
// ============================================================================================ 
    date_default_timezone_set('Asia/Jakarta');   // set timezone to "Asia/Jakarta"
    $date         = date(' Y-m-d H:i:s ');
    $db->bindMore(array(
        'id'            => $_GET['id'],
        'catid'         => $_POST['category'],
        'subcatid'      => $_POST['subcategory'],
        'title'         => $_POST['title'],
        'code'          => str_replace(' ', '',$_POST['code']),
        'also'          => is_null(@$_POST['alsolike']) ? null : implode(',', $_POST['alsolike']),
        'description'   => $_POST['description'],
        'dimension'     => $_POST['dimension'],
        'status'        => $_POST['status'],
        'priority'      => $_POST['priority'],
        'setpromo'      => $isPromo
      ));


    $db->query(" UPDATE products SET category_id=:catid, subcategory_id=:subcatid, name=:title, code=:code, description=:description, dimension=:dimension, is_enabled=:status, sort_order=:priority, is_promo=:setpromo WHERE id = :id ");
    // $db->query(" UPDATE products SET category_id=:catid, subcategory_id=:subcatid, name=:title, code=:code, also_like=:also, description=:description, dimension=:dimension, is_enabled=:status, sort_order=:priority, is_promo=:setpromo WHERE id = :id ");
// ============================================================================================
// Record to database
// PRICES
// ============================================================================================  
    $db->bindMore(array(
        'id' => $_GET['id'],
        'np' => $_POST['normal-price'],
        'pp' => $_POST['project-price'],
        'ep' => $_POST['export-price'],
        'rp' => $_POST['promo-price'],
        'pd' => $_POST['promo-description'],
        'pn' => $_POST['promo-note']
      ));
    if($prices)
    {
      $db->query(" UPDATE product_prices SET normal=:np, project=:pp, export=:ep, promo=:rp, promo_description=:pd, promo_note=:pn WHERE product_id = :id ");
    }else{
      $db->row(" INSERT INTO product_prices(normal,project,export,promo, promo_description, promo_note,product_id) VALUES(:np, :pp, :ep, :rp, :pd, :pn, :id) ");
    }


// ============================================================================================
// Record to database
// IMAGES
// ============================================================================================
    $img_format = array("jpg", "png", "gif", "bmp");
    $pdf_format = "pdf";
    $max_file_size = 83886080;
    $path         = BASE_DIR."/assets/images/furniture/";
    $medium_path  = BASE_DIR."/assets/images/furniture/tmp/m/";
    $count = 0;

    // Loop $_FILES to exeicute all images
    foreach ($_FILES['images']['name'] as $f => $name) {
      $ext = pathinfo($name, PATHINFO_EXTENSION);
      if ($_FILES['images']['error'][$f] == 0) {
        if ($_FILES['images']['size'][$f] > $max_file_size) {
          $message[] = "$name is too large!";
          continue; // Skip large images
        }
        elseif( ! in_array($ext, $img_format) ){
          $message[] = "$name is not a valid format";
          continue; // Skip invalid file formats
        }                   
        else{ // No error found! Move uploaded images
          $img_name =  uniqid($sid. "-" .str_replace(" ", "-", $title) ).".".$ext;
          $img_name = strtolower($img_name);
          // upload image to directory
          // upload original size
          if(copy($_FILES["images"]["tmp_name"][$f], $path.$img_name) ){

            include_once '../classes/simpleImage.class.php';
            // create instant object from class
            $image = new SimpleImage();
            $image->load($path.$img_name);

            // resize image to medium then upload
            $image->resizeToWidth(225);
            $image->save($medium_path.$img_name);

            $db->bind('product_id',  $sid);
            $db->bind('imagename',  $img_name);
            $db->bind('setprimary', 0);

            $rec_images  = $db->query(" INSERT INTO images(product_id,name,is_primary) VALUES (:product_id,:imagename,:setprimary) ");
            
            $count++; // Number of successfully uploaded file
          }
        }
      }
    } // endforeach

    // REload
    if(count($message) == 0) header("Location:".$_SERVER['REQUEST_URI']);
} // end submit

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
  </body>

</html>


