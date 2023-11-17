<?php if( $product->sizes && isset($product->sizes[0]) && $product->sizes[0]->prices['normal'] != '' ): ?>
  <?php if( $product->sizes[0]->prices['normal'] == 0.00 ): ?>
    <span>&nbsp;</span>
  <?php else: ?>
    <span class="grey-text hide-on-small-only"> <i class="fa fa-tags grey-text text-darken-1 left hide-on-print gap gap-5"></i> </span>
    <span class="price-label grey-text text-darken-2" style="margin-right:5px">
      MYR <?=$product->sizes[0]->prices['normal']?>
    </span> 
  <?php endif ?>
<?php endif ?>