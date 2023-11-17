<?php 
$db->bind('id', $_GET['id']);

$query  = " SELECT product.title as product, client.clientid as id, client.name as client, client.path as path FROM product";

$query .= " LEFT JOIN product_client AS pivot ON productId = pivot.product_id ";

$query .= " LEFT JOIN portoclient AS client ON pivot.client_id = client.clientid ";

$query .= " WHERE productId = :id";

$rs = $db->query($query);

$commercials = array();

foreach ($rs as $key => $value) {

  $thisproduct = $value['product'];

  $commercials[$value['product']][$key]['id'] = $value['id'];

  $commercials[$value['product']][$key]['client'] = $value['client'];

  $commercials[$value['product']][$key]['path'] = $value['path'];

}
 ?>

<table class="table table-bordered">
  <tr>
    <td colspan="2">
      <h3>Commercial Settings</h3>
      <?php 
        $rs = $db->query(" SELECT clientid, name FROM portoclient ORDER BY name ");

        $clients = array();

        foreach ($rs as $key => $item) {
          $clients[$key]['id'] = $item['clientid'];
          $clients[$key]['text'] = $item['name'];
        }
       ?>
      <div class="input-group">
         
        <select id="client-list" class="form-control input-sm" multiple>
          <option value=""></option>
        </select>
        <span class="input-group-btn">
          <button id="add-client-commercial" class="btn btn-success btn-sm" type="button">
            <span class="glyphicon glyphicon-plus"></span> Add
          </button>
        </span>
      </div>
    </td>
    <script>
      var data = <?=json_encode($clients)?>;
      $('#client-list').select2({
        data : data,
        placeholder : 'Choose Client'
      })
    </script>
  </tr>

   <?php 
    foreach ($commercials as $item):
      foreach ($item as $key => $commercial):

        $db->bind('id', $commercial['id']);
        $images = $db->row(" SELECT * FROM portoimage WHERE clientid = :id AND isPrimary = 1 ");
        if(! is_null($commercial['id']) ):
    ?>
        <tr data-client="<?=$commercial['id']?>">
          <td>
            <p><?=$commercial['client']?></p>
          </td>
          <td>
            <button class="btn btn-danger btn-xs delete-client-product">Delete</button>
          </td>
        </tr>
    <?php
        endif;
      endforeach;
    endforeach;

    ?>
</table>
<script>
  
  $('#add-client-commercial').click(function(){
    var client_ids = $('#client-list').val()
    $.get('<?=BASE_URL?>/admin-php/_partials/product/ajax/add-client-in-product.php', { 
      action:'add-client-in-product', 
      clientId : client_ids.join(),
      pid : <?=$_GET['id']?>
    },
    function(data){
      location.reload()
    })
  })


  $('.delete-client-product').click(function(){
    var client_id = $(this).closest('tr').data('client')
    console.log(client_id)
    $.get('<?=BASE_URL?>/admin-php/_partials/product/ajax/add-client-in-product.php', {
      action: 'delete-client-in-product',
      clientId : client_id,
      pid : <?=$_GET['id']?>
    },
    function(data){
      location.reload()
    })
  })
</script>

