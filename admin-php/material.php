<?php

use Illuminate\Support\Str;

ini_set('display_errors', 1);
require 'api/check_session.php';
include '../config.php';
include __DIR__.'/../classes/DB.php';
include __DIR__.'/../classes/Helper.php';

$materialLists = MaterialCategory::materialLists(); // action : ['add']

//////////////////
// add material //
//////////////////
if (isset($_GET['action']) && $_GET['action'] == 'add')
{
  if (isset($_POST['add-submit']))
  {
    $subcategory = MaterialSubcategory::find($_POST['subcategory']);

    $inputs = array(
      'material_category_id'    => $subcategory->material_category_id,
      'material_subcategory_id' => $_POST['subcategory'],
      'code'                    => $_POST['code'],
      'name'                    => $_POST['name'],
      'description'             => $_POST['description'],
      'created_at'              => \Carbon\Carbon::now('Asia/Jakarta'),
      'updated_at'              => \Carbon\Carbon::now('Asia/Jakarta')
    );

    $insertId = Material::insertGetId($inputs);

    if($insertId)
    {
      header("Location:/admin-php/material.php?action=edit&id=$insertId");
    }
  }
}

///////////////////
// edit material //
///////////////////
if (isset($_GET['action']) && $_GET['action'] == 'edit')
{
  $material = Material::find($_GET['id']);

  if (isset($_POST['edit-submit']))
  {
    $subcategory = MaterialSubcategory::find($_POST['subcategory']);

    $material->material_category_id    = $subcategory->material_category_id;
    $material->material_subcategory_id = $_POST['subcategory'];
    $material->code                    = $_POST['code'];
    $material->name                    = $_POST['name'];
    $material->description             = $_POST['description'];
    $material->updated_at              = \Carbon\Carbon::now('Asia/Jakarta');
    
    $update = $material->save();

    if($update)
    {
      // upload image
      $config = [
        'path'     => base_path(img_path('material/')),
        'filename' => Str::slug("$material->id-$material->name"),
      ];
      if( upload_image($_FILES['image'], $config) )
      {
        header("Location:/admin-php/material.php");
        // header("Location:$_SERVER[REQUEST_URI]");
      }
    }
  }
}

//////////////////
// add category //
//////////////////
if ( isset($_GET['action']) && $_GET['action'] == 'add-category' )
{
  $posts = [
    'name' => $_POST['name'],
    'created_at' => \Carbon\Carbon::now('Asia/Jakarta'),
    'updated_at' => \Carbon\Carbon::now('Asia/Jakarta'),
  ];

  $insert = MaterialCategory::insert($posts);

  header("Location:$_SERVER[PHP_SELF]?action=category");
  
  return;
}
//////////////////
// add subcategory //
//////////////////
if ( isset($_GET['action']) && $_GET['action'] == 'add-subcategory' )
{
  $posts = [
    'material_category_id' => $_POST['material_category_id'],
    'name' => $_POST['name'],
    'created_at' => \Carbon\Carbon::now('Asia/Jakarta'),
    'updated_at' => \Carbon\Carbon::now('Asia/Jakarta'),
  ];

  $insert = MaterialSubcategory::insert($posts);

  header("Location:$_SERVER[PHP_SELF]?action=subcategory");
  
  return;
}
//////////////////
// edit category //
//////////////////
if ( isset($_GET['action']) && $_GET['action'] == 'edit-category' )
{
  $category = MaterialCategory::find($_POST['id']);

  $category->name = $_POST['name'];
  $category->updated_at = \Carbon\Carbon::now('Asia/Jakarta');
  $category->save();

  header("Location:$_SERVER[PHP_SELF]?action=category");

  return;
}
//////////////////
// edit subcategory //
//////////////////
if ( isset($_GET['action']) && $_GET['action'] == 'edit-subcategory' )
{
  $subcategory = MaterialSubcategory::find($_POST['id']);
  $subcategory->material_category_id = $_POST['material_category_id'];
  $subcategory->name = $_POST['name'];
  $subcategory->updated_at = \Carbon\Carbon::now('Asia/Jakarta');
  $subcategory->save();

  header("Location:$_SERVER[PHP_SELF]?action=subcategory");

  return;
}

//////////////////
// delete category //
//////////////////
if ( isset($_GET['action']) && $_GET['action'] == 'delete-category' )
{
  $category = MaterialCategory::find($_POST['id']);

  $category->delete();

  header("Location:$_SERVER[PHP_SELF]?action=category");

  return;
}

//////////////////
// delete subcategory //
//////////////////
if ( isset($_GET['action']) && $_GET['action'] == 'delete-subcategory' )
{
  $subcategory = MaterialSubcategory::find($_POST['id']);

  $subcategory->delete();

  header("Location:$_SERVER[PHP_SELF]?action=subcategory");

  return;
}

//////////////////
// AJAX REQUEST //
//////////////////
if( 
  isset($_SERVER['HTTP_X_REQUESTED_WITH']) 
  && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'
  && !empty($_SERVER['HTTP_X_REQUESTED_WITH'])
  ):
  ////////////////////////////////
  // Enable or Disable material //
  ////////////////////////////////
  if( isset($_GET['action']) && $_GET['action'] == 'enabling' )
  {
    $id = $_POST['id'];

    $material = Material::find($id);
    $material->is_enabled = $_POST['is_enabled'];

    echo $material->save();

    exit;
  }
  /////////////////////
  // Delete material //
  /////////////////////
  if (isset($_GET['action']) && $_GET['action'] == 'delete')
  {
    $id = $_POST['id'];

    $material = Material::find($id);
    $image = img_path('material/').$material->id."-".$helper->Str::slug($material->name).".jpg";
    $delete = $material->delete();
    if( $delete && file_exists($image = base_path($image)) )
    {
      unlink($image);
    }
    exit;
  }

endif; // end if ajax request

include 'partials/header.php'; ?>

<div class="jumbotron">
  <div class="container">
    <h1>Materials</h1>
  </div>
</div>

<div class="container">
  <div class="row">
    
    <?php 
    if (isset($_GET['action'])): 
      switch ($_GET['action']) {

        case 'add':
          include 'partials/material/add.php';
          break;

        case 'edit':
          include 'partials/material/edit.php';
          break;

        case 'category':
          if( isset($_GET['stage']) && $_GET['stage'] == 'edit' )
          {
            $category = MaterialCategory::find($_GET['id']);
          }
          include 'partials/material/category.php';
          
          break;

        case 'subcategory':
          if( isset($_GET['stage']) && $_GET['stage'] == 'edit' )
          {
            $subcategory = MaterialSubcategory::find($_GET['id']);
          }
          include 'partials/material/subcategory.php';
          
          break;
      }
    else:
      include 'partials/material/index.php';
    endif ?>

  </div>
</div>

<?php include 'partials/footer.php'; ?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title text-capitalize" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){

  var $modal = $('#myModal');

  var $btn = {
    addCategory : $('.add-category-btn'),
    editCategory : $('.edit-category-btn'),
  }

  $subMaterialLists = $('#subcategory-material');

  $subMaterialLists.select2({
    placeholder : 'Select Subcategory Material'
  });

  // Enable or disable material
  $('.enabling').change(function(){
    var val = $(this).prop('checked') ? 1 : 0;
    var id  = $(this).closest('.item').data('id');
    var $info = $(this).closest('.checkbox').find('.info');

    var post = $.post('<?=$_SERVER["PHP_SELF"]?>?action=enabling', {id:id, is_enabled:val});
    post.success(function(data){
      if(data)
      {
        console.log('success')
      }
      else{
        console.log('failed')
      }
    })
  });

  // delete material
  $('.delete-material').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    var confir = $(this).data('confirm');

    if(!confirm(confir))
    {
      return false;
    }
    var post = $.post('?action=delete', {id:id});
    post.success(function(data){
      console.log(data)
      location.reload()
    });
  });

  $('.delete-category').click(function(e){
    e.preventDefault()
    var id = $(this).closest('tr').data('id');
    var dataConfirm = $(this).data('confirm');

    if( confirm(dataConfirm) )
    {
      var post = $.post('<?=$_SERVER["PHP_SELF"]?>?action=delete-category', {id:id});
      post.success(function(data){
        console.log('deleted')
        location.reload();
      })
    }
  });

  $('.delete-subcategory').click(function(e){
    e.preventDefault()
    var id = $(this).closest('tr').data('id');
    var dataConfirm = $(this).data('confirm');

    if( confirm(dataConfirm) )
    {
      var post = $.post('<?=$_SERVER["PHP_SELF"]?>?action=delete-subcategory', {id:id});
      post.success(function(data){
        console.log('deleted')
        location.reload();
      })
    }
  });

});

</script>
