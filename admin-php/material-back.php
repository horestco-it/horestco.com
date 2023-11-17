<?php
error_reporting(E_ALL); 
	ini_set("display_errors", 1);

require 'api/check_session.php';
	include '../config.php';
	include BASE_DIR . '/classes/Helper.php';
  include BASE_DIR . '/classes/DB.php';
	include BASE_DIR . '/classes/Images.class.php';

	spl_autoload_register(function($class){
    include  BASE_DIR . '/' . $class . '.php';
  });

	// $suppliers = Models\Supplier::orderBy('name')->get();

	$groups = Models\MaterialType::orderBy('name')
                                ->with('suppliers')
                                ->get();



  $hasError = false;
if (isset($_POST['add-submit'])) {
  $material = new Models\Material;

  $material->name = $_POST['name'];
  $material->code = $_POST['code'];
  $material->description = $_POST['des'];
  $material->supplier_id = $_POST['supplier'];
  $material->save();

  $search = (isset($_GET['search'])) ? '&search' : '';
  header("location:material.php?action=edit&id=".$material->id . $search );
}
  
if (isset($_GET['id'])){
  $material = Models\Material::find($_GET['id']);
}

if ( isset($_POST['edit-submit']) ) {

  $old = array($material->id, $helper->url_slug($material->name));
  $new = array($material->id, $helper->url_slug($_POST['name']));

  $destination = BASE_DIR . '/images/material/' ;

  $oldFilename['ori'] = $destination.implode('-',$old).'.jpg';
  $oldFilename['small'] = $destination.implode('-', $old).'-small.jpg';
  
  // rename image filename if not sama
  if ($material->name != $_POST['name'] && file_exists($oldFilename['ori']))
  {
    rename($oldFilename['ori'], $destination.implode('-', $new). '.jpg');
    rename($oldFilename['small'], $destination.implode('-', $new). '-small.jpg');
  }

  $material->name = $_POST['name'];
  $material->code = $_POST['code'];
  $material->description = $_POST['des'];
  // $material->material_type_id = $_POST['group'];
  $material->supplier_id = $_POST['supplier'];

  $material->save();

  /* ======================================
   * UPLOAD FILE
   * ======================================
   */
  if ( is_uploaded_file($_FILES['image']['tmp_name']) ):

      // global variables
      $imageName = $helper->url_slug($material->name);
      $errors = array();
      $image = new Image($_FILES['image']['tmp_name']);

      // Removing old image file if already exist
      if (file_exists($destination . $imageName . '.jpg')) {
        unlink($destination . $imageName . '.jpg');
        unlink($destination . $imageName . '-small.jpg');
      }

      // validation
      if ($image->getWidth() > 390) $errors[] = "Lebar gambar tidak lebih dari 390px"; 
      if ($image->getFileSize() > 200) $errors[] = "File gambar tidak lebih dari 200kb"; 

      // proces upload file
      if (! count($errors) > 0 ) {
        $success = $image->save($material->id . '-' . $imageName, $destination);
        if ($success) {
          $image->resize(120, 90);
          $image->save($material->id . '-' . $imageName . '-small', $destination);

          header("Refresh:0.001");
        }
      }else{
        $hasError = true;
      }

  endif;

}

if ( isset($_GET['delete']) ) {

    $imageName = $material->id.'-'.$helper->url_slug($material->name);
    $destination = BASE_DIR . '/images/material/' ;

    // Removing old image file if already exist
    if (file_exists($destination . $imageName . '.jpg')) {
      unlink($destination . $imageName . '.jpg');
      unlink($destination . $imageName . '-small.jpg');
    }

    if ( $material->delete() ) header("location:material.php");

}

function hasSearch()
{
  return isset($_GET['search']) ? '&search' : '';
}

?>

<?php include '_partials/header.php'; ?>

<?php if ($hasError && count($errors) > 0 ) : ?>
<div class="alert alert-danger">
  <?php foreach ($errors as $error): ?>
    <p><?=$error?></p>
  <?php endforeach; ?>
</div>
<?php endif ?>

<div id="wrap">

    <div id="dashboard" class="container">

      <div class="row">

        <div class="col-sm-12 main">

          <div class="row">

          <?php

				$action = isset($_GET['action']) ? $_GET['action'] : 'null';

            switch ($action) {

              case 'add':

                include '_partials/material/add.php';

                break;


              case 'edit':

                include '_partials/material/edit.php';

                break;

              case 'null':
                print '<h2 class="text-center">Search Material</h2>';
                include '_partials/material/search.php';

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
    var selectGroup = $('select[name="group"]'),
        selectSearch = $('#selectSearch')
        selectSupplier = $('select[name="supplier"]')
        result = $('#table-result'),
        // Global variable
        animation = '<span class="loader"><img src="<?=BASE_URL?>/assets/images/loader.white.gif" /> Loading...</span>',
        loader = $('.loader')
      
    selectSupplier.select2({placeholder: 'Select supplier'})
    selectGroup.select2({placeholder: 'Select Material Type'})

    selectSearch.change(function(){
      loader.remove()
      result.append(animation)
      result.load('<?=BASE_URL?>/admin-php/_partials/material/ajax.php?xhr&action=search&id='+ $(this).val() +'<?=hasSearch()?>' , function(data, status, xhr){
        console.log(status)
        loader.remove()
      })
      
    })

  })

</script>
<?php include '_partials/footer.php'; ?>

