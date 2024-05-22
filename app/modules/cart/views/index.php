<?php

use Illuminate\Support\Str;

 $this->load->view( config_item('theme').'header') ?>
  <style>

  @media only screen and (max-width: 992px){
    table.responsive-table thead{
      /*display: none;*/
    }
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

<?php $this->load->view( config_item('theme').'nav') ?>

<?php
  $columns = [
    'IMAGE',
    'ITEM INFO',
    'SIZE',
    'MATERIALS',
    'PRICES',
    'QTY',
    'SUBTOTAL',
    'Remove',
  ];
 ?>

<main class="container">
  <div class="row">
    <div class="col s12">
      <!-- <h3>YOUR SHOPPING CART <i class="large mdi-action-shopping-cart hide-on-small-only"></i></h3> -->
      <h3><i class="mdi-action-shopping-cart hide-on-small-only"></i> YOUR SHOPPING CART</h3>
    </div>
    <?php if ( $this->cart->total_items() ): ?>
    <div class="col s12 cart-table">
      <table class="bordered centered responsive-table">
        <thead class="hide-on-med-and-down">
          <tr>
            <?php foreach ($columns as $column): ?>
            <th><?=$column?></th>
            <?php endforeach ?>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($this->cart->contents() as $key => $product): ?>
          <tr data-id="<?=$product['rowid']?>">
            <td><?=image_thumb(img_url('furniture/'.$product['image']), 200, ['class'=>'responsive-img'])?></td>
            <td>
              <!-- <a href="/furniture/<?=Str::slug($product['name'])?>-<?=$product['code']?>" target="_blank"> -->
              <a href="/furniture/<?=Str::slug($product['name'])?>-<?=$product['id']?>" target="_blank">
                <strong><?=ucwords(strtolower($product['name']))?></strong>
              </a>
              <br>
              <?=$product['code']?>

            </td>
            <td><?=strtoupper($product['size'])?></td>
            <td>
              <ul>
              <?php foreach ($product['materials'] as $type => $material): ?>
                <li>
                  <span class="grey-text"><?=$type?> : </span><br>
                  <span><?=$material['name']?></span>
                </li>
                <li class="divider"></li>
              <?php endforeach ?>
              </ul>
            </td>
            <td>
              <ul>
                <?php foreach ($product['data-prices'] as $item => $price): ?>
                  <li>
                    <span class="grey-text"><?=ucwords($item)?> :</span><br>
                    <span><?=$currency?> <?=ucwords($price)?></span>
                  </li>
                <?php endforeach ?>
              </ul>
            </td>
            <td>
              <input type="number" min="1" class="qty" value="<?=$product['qty']?>" />
            </td>
            <td><?=$product['subtotal']?></td>

            <td>
              <a href="" class="delete-item" title="Delete this item">
                <i class="fa fa-trash fa-lg red-text"></i>
              </a>
            </td>
          </tr>

        <?php endforeach ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="<?=count($columns)?>">
              <h5 class="right">
                Total: <span class="currency"><?=$currency?></span>
                <span class="red-text"><?=$this->cart->total()?></span>
              </h5>
            </td>
          </tr>
        </tfoot>
      </table>

      <p class="left valign">
        <a href="<?=$redirectToShop?>"><i class="mdi-hardware-keyboard-arrow-left left"></i> Add item</a>
      </p>

      <p class="right">
        <button id="update-cart" class="waves-effect waves-light btn grey"><i class="mdi-action-cached right"></i>Update </button>
        <?php if ($this->auth->check()): ?>
          <a href="<?=base_url()?>payment/checkout" id="checkout" class="btn"><i class="mdi-content-send right"></i>Checkout</a>
        <?php else: ?>
          <a href="<?=base_url()?>cart/information" id="checkout" class="btn"><i class="mdi-content-send right"></i>Checkout</a>
        <?php endif ?>
      </p>

    </div>
<div class="col s12 cart-table">
  <table class="bordered responsive-table">
    <tfoot>
      <tr>
        <td>
          We typically hold low stock levels for this item so lead time may be up to 8-10 weeks. <br>
          Please contact us prior to ordering.
          Please contact us prior to your purchase to know if a freight surcharge is required for locations outside Klang Valley.
        </td>
      </tr>
    </tfoot>
 </table>
</div>



  <?php else: ?>
    <div class="col s12 center">
      <h5>Shopping Cart is Empty</h5>
      <p>You have no items in your shopping cart.<br>
          Click the button to continue shopping</p>
      <a href="<?=$redirectToShop?>" class="btn"><i class="mdi-action-shop large left"></i>Shopping</a>
    </div>
  <?php endif ?>


  </div><!-- end row -->
</main>

<?php $this->load->view( config_item('theme').'script') ?>

<script>
  $(document).ready(function(){
    $('#update-cart').click(function(e){
      var qty = [];

      $('input.qty').each(function(i){
        qty.push( {rowid:$(this).closest('tr').data('id') ,qty:parseInt($(this).val())} );
      });

      $.post('/cart/update', {action:'update', data:JSON.stringify(qty)}, function(res){
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

      $.post('/cart/remove', {action:'remove',id:id}, function(res){
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

<?php $this->load->view( config_item('theme').'footer') ?>
