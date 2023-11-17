<!DOCTYPE html>
<html lang="en">
<head>

  <?php get_meta($page) ?>

  <?php $this->load->view('partials/meta-and-assets') ?>
  <style>
    .lead.background-image{
      background-image: 
        linear-gradient(
          rgba(0, 0, 0, 0.7), 
          rgba(0, 0, 0, 0.7)
        ),
        url('<?=base_url().img_url()?>slide-index/bar-chair.jpg');
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
    }
  </style>
</head>
<body>

<?php $this->load->view('partials/nav') ?>

<div class="divider"></div>

<div class="section lead background-image">
  <div class="container">
    <div class="row">
      <div class="col s12 center white-text">
        <h3 class="lead-heading">PROMOTIONS OF THE WEEK</h3>
        <h5 class="lead-sub-heading">
          Grab our discounted and promotional items while stocks last
        </h5>
      </div>
    </div>
  </div>
</div>

<div class="container">


	<section class="section">
		<div class="row">
      <?php foreach ($products as $key => $product): ?>
        <?php
          // retrieve prices
          // $price = $product['prices']->toArray();
        ?>
        <div class="col s12 m4 l3">
          <div class="card lists">
            <?php foreach ($product->images as $key => $image): ?>
              <?php if ($key == 0): ?>
                <div class="card-image">
                  <?php echo image_thumb(product_img_url($image->name), 300); ?>
                </div>
              <?php endif ?>
            <?php endforeach ?>
            <div class="card-content" style="position:relative">
              <span class="card-title activator">
               <?=$product->name?><i class="mdi-action-shop right small teal-text" style="position:absolute;right:15px"></i>
              </span>
            </div>
            <div class="card-reveal">
              <span class="card-title margin-bottom-1">
                <?=$product->name?><i class="mdi-content-clear btn-close grey-text right"></i>
              </span>
              
              <ul>
                <li>
                  <?php if ($product->prices['normal']): ?>
                  <span class="price-normal <?php if($product->prices->promo != 0.00) echo "text-del"; ?> "><?=$product->prices['normal']?></span> 
                  <?php endif ?>
                  <?php if ($product->prices['promo'] != 0.00): ?>
                  <h5 class="price-promo red-text"><?=$currency?> <?=$product->prices['promo']?></h5>
                  <?php endif ?>
                </li>

                <?php if ($product->prices['promo_note']): ?>
                <li style="line-height:14px;margin-top:10px"><em class="price-promo-note grey-text">Note: <?=$product->prices['promo_note']?></em></li>
                <?php endif ?>
              
              </ul>

              <?php $this->load->view('contents/add-to-cart', ['product'=>$product, 'size'=>$product->sizes[0]->id]) ?>
              
            </div>
          </div>
        </div>
      <?php endforeach ?>
			<?php //product_lists($products) ?>
		</div>
	</section>
  <section>
    <div class="row">
      <div class="col s12">
        <div class="card-panel bordered">
          <h6>Keep coming back to check this page for exciting promotions everyweek.</h6>
          <h6>For non-self collection items, please visit <a href="<?=base_url()?>furniture-delivery">our delivery</a> page for delivery charges and other information.</h6>
        </div>
      </div>
    </div>
  </section>

</div>


<?php $this->load->view('partials/footer') ?>

<script src="<?=script_url('owl.carousel.min.js')?>"></script>
<script>
  $(document).ready(function(){

		var owl = $('.owl-carousel')

    owl.owlCarousel({
      items : 1,
      loop : true,
      dots : true
    });

	})
</script>
<!-- 
<script type='text/javascript' data-cfasync='false'>window.purechatApi = { l: [], t: [], on: function () { this.l.push(arguments); } }; (function () { var done = false; var script = document.createElement('script'); script.async = true; script.type = 'text/javascript'; script.src = 'https://app.purechat.com/VisitorWidget/WidgetScript'; document.getElementsByTagName('HEAD').item(0).appendChild(script); script.onreadystatechange = script.onload = function (e) { if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) { var w = new PCWidget({c: '3c2c65a3-caf7-4baa-bdcf-064559b97d9d', f: true }); done = true; } }; })();</script>
 -->
</body>
</html>
