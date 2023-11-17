<?php

require '../../../api/check_session.php';
require '../../../../classes/Helper.php';
require '../../../../classes/DB.php';

require '../../../../config.php';

$db = new DB;

$productId    = $_POST['id'];
$title        = $_POST['title'];
$category     = $_POST['category'];
$showPriority = ( $category == 'All' ) ? 0 : 1;
$status       = $_POST['status'];
$code         = $_POST['code'];

$str = "1 = 1";
$str = (empty($productId))    ? $str : $str." AND id =".$productId;
$str = (empty($title))        ? $str : $str." AND name LIKE '%".$title."%'";
$str = ($category == "All")   ? $str : $str." AND category_id = ".$category;
$str = ($status == "All")     ? $str : $str." AND is_enabled = '".$status."'";
$str = (empty($code))         ? $str : $str." AND code = '".$code."' ";


$prod = $db->query(" SELECT * FROM products WHERE ".$str." ORDER BY sort_order ");
// $helper->dd($prod);

if(empty($prod)):

  echo '<h3 class="text-danger">No Product Result</h3>';

else: 

?>

<p>Total : <strong><?=count($prod)?></strong> <?=str_plural('product', count($prod))?></p>

<div class="table-responsive">

  <table id="table-product" class="table table-bordered table-striped">

    <thead>

      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Subcategory</th>
        <th>Code</th>
        <th>Status</th>
        <th>Action</th>
        <th>Priority</th>
      </tr>

    </thead>

    <tbody>              

      <?php

        foreach($prod as $product):

          $url        = BASE_URL.'/furniture/'.$helper->url_slug($product['name']).'-'.$product['id'];
          $code = $product['code'];

          if ($product['is_enabled'] == 1) {

            $status = 'Active';

            $color  = 'green';

          }else{

            $status = 'Inactive';

            $color  = 'red';

          };

      ?>

      <tr data-id="<?=$product['id']?>">

        <td><?=$product['id']?></td>

        <td><a href="<?=$url?>" target="_blank"><?=$product['name']?></a></td>

        <td>
          <?php 
            $db->bind('subcatid', $product['subcategory_id']);
            $subcategories = $db->query(" SELECT name FROM subcategories WHERE id = :subcatid ");
            for($ci=0; $ci < count($subcategories); $ci++){
              foreach ($subcategories[$ci] as $sub) {
                echo $sub;
              }
            }
           ?>

        </td>

        <td><?=$code?></td>

        <td><?=$status?></td>
        <td>
          <a href="dashboard.php?action=edit&amp;id=<?=$product['id']?>" class="btn btn-info btn-xs editproduct" data-product="<?=$product['id']?>">Edit</a>
          <?php if ( isset($_SESSION['type']) && $_SESSION['type'] == 'A' ): ?>
            <button type="button" class="btn btn-danger btn-xs deleteproduct" data-toggle="modal" data-target="#confirmdelete" data-id="<?=$product['id']?>">Delete</button>
          <?php endif ?>
        </td>

        <?php if ( $showPriority || !empty($product['id']) || !empty($product['title']) ): ?>

        <td>

          <input type="text" data-id="<?=$product['id']?>" class="form-control input-sm set-priority" value="<?=$product['sort_order']?>" style="width:50px" />

        </td>

        <?php endif; ?>

      </tr>

    <?php endforeach; ?>

    </tbody>

  </table>

</div> <!-- end .table-responsive -->



<?php endif; ?>



<script>

  $('.set-priority').change(function(e){

    var thisVal = $(this).val();

    var thisId = $(this).data('id')

    // console.log(thisId)

    $.get('dashboard.php',{action:'edit', id: thisId, type: 'setpriority', prtyVal:thisVal })

    .done(function(){

    })

  })

  $('.set-priority').keyup(function(e){            

    if (e.which == 13) {

      var thisVal = $(this).val();

      var thisId = $(this).data('id')

      // console.log(thisId)

      $.get('dashboard.php',{action:'edit', id: thisId, type: 'setpriority', prtyVal:thisVal })

      .done(function(){

        $(this).blur()

      })

    };

  })

</script>

