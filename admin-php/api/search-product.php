<?php
require 'check_session.php';

if($type == 'A' || $type == 'U'):
require '../../classes/Db.class.php';
require '../../classes/Helper.php';
$db = new DB;
$helper = new Helper;

$productId    = $_POST['id'];
$title        = $_POST['title'];
$category     = $_POST['category'];
$showPriority = ( $category == 'All' ) ? 0 : 1;
$status       = $_POST['status'];
$code         = $_POST['code'];

$str = "1 = 1";
$str = (empty($productId))    ? $str : $str." AND productId =".$productId;
$str = (empty($title))        ? $str : $str." AND title LIKE '%".$title."%'";
$str = ($category == "All")   ? $str : $str." AND catId = ".$category;
$str = ($status == "All")     ? $str : $str." AND status = '".$status."'";
$str = (empty($code))         ? $str : $str." AND code = '".$code."' ";

$prod = $db->query(" SELECT * FROM product WHERE ".$str." ORDER BY priority ASC ");

// $helper->dd($prod);
if(empty($prod)):
  echo '<h3 class="text-danger">No Product Result</h3>';
else: 
?>
<p>Total : <strong><?=count($prod)?></strong> product(s)</p>
<div class="table-responsive">
  <table class="table table-bordered table-striped">
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
          $url        = $_SERVER['SERVER_HOST'].'/itemdetail.php?pid='. $product['productId'];

          if ($product['status'] == 'A') {
            $status = 'Active';
            $color  = 'green';
          }else{
            $status = 'Inactive';
            $color  = 'red';
          };
      ?>
      <tr data-id="<?=$product['productId']?>">
        <td><?=$product['productId']?></td>
        <td><a href="<?=$url?>" target="_blank"><?=$product['title']?></a></td>
        <td>
          <?php 
            $db->bind('subcatid', $product['subcatid']);
            $subcategories = $db->query(" SELECT name FROM subcategory WHERE subcatid = :subcatid ");
            for($ci=0; $ci < count($subcategories); $ci++){
              foreach ($subcategories[$ci] as $sub) {
                echo $sub;
              }
            }
           ?>
        </td>
        <td><?=$product['code']?></td>
        <td style="color:<?=$color?>"><?=$status?></td>

        <td>
          <a href="dashboard.php?action=edit&amp;id=<?=$product['productId']?>" class="btn btn-info btn-xs editproduct" data-product="<?=$product['productId']?>">Edit</a>
          <button type="button" class="btn btn-danger btn-xs deleteproduct" data-toggle="modal" data-target="#confirmdelete">Delete</button>
        </td>
        <?php if ( $showPriority || !empty($product['productId']) || !empty($product['title']) ): ?>
        <td>
          <input type="text" data-id="<?=$product['productId']?>" class="form-control input-sm set-priority" value="<?=$product['priority']?>" style="width:50px" />
        </td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div> <!-- end .table-responsive -->

<?php endif; endif; ?>

use Illuminate\Support\Facades\DB;

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
