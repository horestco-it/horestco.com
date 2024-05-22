<!DOCTYPE html>
<html lang="en">
<head>

  <title><?=ucwords($page)?> - Horestco.com.my</title>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en" rel="stylesheet">
  
	<link rel="icon" href="<?=base_url().img_url()?>favicon.ico">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="<?=style_url('materialize.min.css')?>">
  <link rel="stylesheet" href="<?=style_url('style.css')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="<?=script_url('html5shiv.js')?>"></script>
    <script src="<?=script_url('respond.min.js')?>"></script>
  <![endif]-->
  <style>
  section{
    min-height: 243px;
  }
  table td{
    padding: 5px;
  }
  table thead, table tfoot{
    background-color: #ddd;
  }
  input.qty{
    width:50px;
    border-bottom:none
  }
  </style>
</head>
<body>

<?php

                    use Illuminate\Support\Str;

 $this->load->view('partials/nav.php') ?>

<div class="divider"></div>

<section class="container">
  <div class="row">
    <div class="col s12">
      <h3>YOUR SHOPPING CART <i class="large mdi-action-shopping-cart hide-on-small-only"></i></h3>
    </div>
    <?php if (count($products)): ?>
    <div class="col s12 cart-table">
      <table class="bordered centered responsive-table">
        <thead>
          <tr>
            <th>IMAGE</th>
            <th>ITEM INFO</th>
            <th>SIZE</th>
            <th>QTY</th>
            <th>PRICE</th>
            <th>Remove</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $key => $product): ?>
          <tr data-id="<?=$product['rowid']?>">
            <td><?=image_thumb(img_url('furniture/'.$product['image']), 200, ['class'=>'responsive-img'])?></td>
            <td>
              <a href="/furniture/<?=Str::slug($product['name'])?>-<?=$product['code']?>" target="_blank">
                <strong><?=ucwords(strtolower($product['name']))?></strong>
              </a>
              <br>
              <?=$product['code']?>
              
            </td>
            <td><?=strtoupper($product['size'])?></td>
            <td>
              <input type="number" min="1" class="qty" value="<?=$product['qty']?>" />
            </td>
            <td><?=$product['subtotal']?></td>
            
            <td>
              <a href="" title="Delete this item">
                <i class="delete-item small material-icons red-text">delete</i>
              </a>
            </td>
          </tr>
          
        <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="5"><h5 class="right">Total: <span class="currency"><?=$currency?></span></h5></td>
            <td>
              <h5><span class="red-text"><?=$total?></span></h5>
            </td>
          </tr>
        </tfoot>
      </table>

      <p class="left valign">
        <a href="<?=base_url()?>malaysia-furniture-promotions"><i class="mdi-hardware-keyboard-arrow-left left"></i> Add item</a>
      </p>

      <p class="right">
        <button id="update-cart" class="waves-effect waves-light btn grey"><i class="mdi-action-cached right"></i>Update </button>
        <a href="<?=base_url()?>cart/information" id="checkout" class="btn"><i class="mdi-content-send right"></i>Checkout</a>
      </p>
      
    </div>
  <?php else: ?>
    <div class="col s12 center">
			<h5>Shopping Cart is Empty</h5>
      <p>You have no items in your shopping cart.<br>
          Click the button to continue shopping</p>
			<a href="/malaysia-furniture-promotions" class="btn"><i class="mdi-action-shop large left"></i>Shopping</a>
		</div>
  <?php endif ?>


  </div><!-- end row -->
</section>

<?php $this->load->view('partials/footer') ?>

<script>
  $(document).ready(function(){
    $('#update-cart').click(function(e){
      var qty = [];

      $('input.qty').each(function(i){
        qty.push( {rowid:$(this).closest('tr').data('id') ,qty:parseInt($(this).val())} );
      });

      $.post('<?=$_SERVER['REQUEST_URI']?>/update', {action:'update', data:JSON.stringify(qty)}, function(res){
        if(res){
          console.log(res)
          location.reload();
        }
        else{
          alert('Opps ! something went wrong');
        }
      })
      e.preventDefault();
    });

    $('.delete-item').click(function(e){

      if (!confirm('Are you sure delete item?'))
      {
        return;
      }
      
      var id = $(this).closest('tr').data('id');

      $.post('<?=$_SERVER['REQUEST_URI']?>/remove', {action:'remove',id:id}, function(res){
        if(res){
          location.reload();
        }
        else{
          alert('Opps ! something went wrong');
        }
      })
      e.preventDefault();
    })
  })
</script>
</body>
</html>
