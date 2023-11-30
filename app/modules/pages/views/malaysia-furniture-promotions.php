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
    @media only screen and (min-width: 993px){
      .card.lists{
        height: 373px;
      }
    }
    @media only screen and (min-width: 601px) and (max-width: 992px){
      .card.lists{
        height: 337px;
      }
    }
    @media only screen and (min-width: 480px) and (max-width: 600px){
      .card.lists{
        height: 373px;
      }
    }
    @media only screen and (min-width: 0) and (max-width: 479px){
      .card.lists{
        height: 312px;
      }
    }
    
  </style>

<?php $this->load->view( config_item('theme').'nav'.$version ) ?>

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
      <?php foreach ($sizes as $key => $size): ?>
      
      <?php
      if($size->product->is_enabled == 1){
      ?>
        <div class="col s6 m4 l3 item">
          <div class="card lists">
            <?php foreach ($size->product->images as $key => $image): ?>
              <?php if ($image->is_primary): ?>
                <div class="card-image">
                  <a href="<?=base_url('furniture/'.str_slug($size->product->name).'-'.$size->product->id)?>" target="_blank">
                    <?php echo image_thumb(product_img_url($image->name), 300); ?>
                  </a>
                </div>
              <?php endif ?>
            <?php endforeach ?>
            
            <?php /* CARD CONTENT */ ?>
            <div class="card-content" style="position:relative">
              <span class="card-title activator">
               <?=$size->product->name?><i class="mdi-action-shop right small teal-text" style="position:absolute;right:15px"></i>
              </span>
              <span class="white-text"><?=$size->product->id?></span>
              <ul>
                <li><span class="price-promo-note"><?=ucwords($size->name)?></span></li>
                <li>
                  <?php if ($size->price->normal): ?>
                  <span class="price-normal"><del><?=$size->price->normal?></del></span> 
                  <?php endif ?>
                  <?php if ($size->price->promo): ?>
                  <h5 class="price-promo red-text"><?=$this->config->item('currency')?> <?=$size->price->promo?></h5>
                  <?php endif ?>
                </li>

                <?php if ($size->price->promo_note): ?>
                <li style="line-height:14px;margin-top:10px"><em class="price-promo-note grey-text">Note: <?=$size->price->promo_note?></em></li>
                <?php endif ?>
              </ul>
            </div>

            <?php /* REVEAL */ ?>
            <div class="card-reveal">
              <span class="card-title margin-bottom-1">
                <?=$size->product->name?><i class="mdi-content-clear btn-close grey-text right"></i>
              </span>
              
              <ul>
                <li>
                  <?php if ($size->price->normal): ?>
                  <span class="price-normal"><del><?=$size->price->normal?></del></span> 
                  <?php endif ?>
                  <?php if ($size->price->promo): ?>
                  <h5 class="price-promo red-text"><?=$currency?> <?=$size->price->promo?></h5>
                  <?php endif ?>
                </li>

                <?php if ($size->price->promo_note): ?>
                <li style="line-height:14px;margin-top:10px"><em class="price-promo-note grey-text">Note: <?=$size->price->promo_note?></em></li>
                <?php endif ?>
              
              </ul>
              
              <?php $this->load->view('contents/add-to-cart', ['product'=>$size->product, 'size'=>$size->id]) ?>
              
            </div>

          </div>
        </div>
        <?php } ?>
      <?php endforeach ?>
			
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
