<?php
  $options = array(
    'alt' => 'Teak Furniture Malaysia '.strtolower($product->subcategory['name'].' '. $product->name),
    'title' => ucwords($product->subcategory['name'].' - '.$product->name),
    'class'=> 'white-text post-image',
    'data-original'=> isset($product->imageThumb['name']) ? $product->imageThumb['name'] : null,
  );
?>

<?php foreach ($product->images as $i => $image): ?> 
	<?php if( $i == 0 ): ?>
    <img src="<?=image_src($product->imageThumb['name'], 300)?>" <?php implode(' ', $options) ?> />
  <?php endif ?>
  
  <?php 
    // if( $i == 1 && count($product->images) > 1 && !(int)$image->is_primary ){
    //   echo image_thumb(product_img_url(strtolower($image->name)), 300, [
    //     'data-lazy' => true,
    //     'class' => 'transparent-text hover-image lazy lazy-loader',
    //     'data-src' => base_url(product_img_url(strtolower($image->name)))
    //   ]);
    // }
  ?>
<?php endforeach ?>