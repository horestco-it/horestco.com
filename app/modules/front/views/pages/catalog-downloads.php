<!DOCTYPE html>
<html lang="en">
<head>
  <?php get_meta($this->uri->segment(1)) ?>
  
  <?php $this->load->view('partials/meta-and-assets') ?>
  <style>
    .lead.background-image{
      background-image: 
        linear-gradient(
          rgba(0, 0, 0, 0.7), 
          rgba(0, 0, 0, 0.7)
        ),
        url('<?=base_url().img_url()?>background/sun-lounger-blured.jpg');
        background-attachment: fixed;
        background-position: center;
        background-position-y: 0;
        background-repeat: no-repeat;
        background-size: cover;
    }
  </style>
</head>
<body>

<?php $this->load->view('partials/nav.php') ?>

<div class="section lead background-image">
  <div class="container">
    <div class="row">
      <div class="col s12 center white-text">
        <h3 class="lead-heading">CATALOG DOWNLOADS</h3>
        <h5 class="lead-sub-heading">
          Discover a wide range of the products that you can find at <span class="tonjol">horestco.com</span> and in our showroom.
          Clearly structured, includes all the necessary basic information
        </h5>
        <div class="lead-btn-wrapper">
          <a href="<?=base_url('files/horestco-catalog_2025.pdf')?>" download class="btn btn-large waves-effect waves-light green lighter-3">
            <i class="mdi-action-get-app right"></i>  DOWNLOAD</a>
        </div>
        <h5 class="lead-sub-heading">
          Download and save it on your device as a convenient reference for offline viewing.
        </h5>
      </div>
    </div>
  </div>
</div>

<section class="section">
  <div class="container">
    <div class="row">
      <div class="col s12 center" style="font-size:20px;line-height:34px">
        <p class="lead-sub-heading">
          Allow yourself a few moments to browse our catalog and your life will open to a world of stylish possibilities.
          All this will happen with a simple click and indulge your imagination with a little “wow”.
        </p>
      </div>
      <div class="col s12 center">

      <a class="btn-floating btn-large waves-effect waves-light grey hide-on-med-and-down" href="#synthetic-wicker">
        <i class="mdi-navigation-expand-more"></i>
      </a>
        
      </div>
    </div>
  </div>
</section>


<section id="synthetic-wicker" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
        <img src="<?=base_url().img_url()?>pages/materials-synthetic-wicker.jpg" alt="synthetic wicker furniture" class="responsive-img">
      </div>
      <div class="col s12 m10">
        <h5>Synthetic Wicker:</h5>
        <p>
          Our woven furniture is made from the highest quality wicker fibres. This remarkable material is soft and gentle to touch and has additional benefits which include tear resistance, UV resistance and weather resistance. 
        </p>
        <div class="row">
          <div class="col s12 m8 l5">
            <div class="collection">
              <a href="<?=base_url('files/viro.pdf')?>" download class="collection-item">
                <i class="mdi-action-get-app"></i>  Download the Viro® catalogue
              </a>
              <a href="<?=base_url('files/raucord-natural.pdf')?>" download class="collection-item"><i class="mdi-action-get-app"></i>  Download the Rehau® catalogue</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="fabric" class="section scrollspy">
  <div class="container">
    <div class="row">

      <div class="col s12 m2 hide-on-small-only">
        <a href="<?=base_url().img_url()?>pages/cushion-sunbrella2x.jpg">
          <img alt="fabric cushion furniture" 
          src="<?=base_url().img_url()?>pages/cushion-sunbrella.jpg" 
          srcset="<?=base_url().img_url()?>pages/cushion-sunbrella.jpg 2x, <?=base_url().img_url()?>pages/cushion-sunbrella2x.jpg 3x" 
          class="responsive-img">
        </a>
      </div>
      <div class="col s12 m10">
        <h5>Fabric:</h5>
        <p>
          Our range of luxury cushions adds classy touch to your furniture. In our outdoor furniture, we use Sunbrella® and Sunproof®, the leaders in the market, for performance fabrics. Want to know the best part, here we go, they are colourfast, water repellent and UV resistant, standing up to the harsh outdoor weather conditions. Available in a range of outstanding solid colours, stripes and jacquards, designed only for the best furniture.
        </p>
        <div class="row">
          <div class="col s12 m10 l5">
            <div class="collection">
              <a href="<?=base_url('files/sunbrella-european-catalogue.pdf')?>" download class="collection-item">
                <i class="mdi-action-get-app"></i>  Download the Sunbrella® Europan catalogue
              </a>
              <a href="<?=base_url('files/2013-2014-sunbrella-awning-marine-fabrics.pdf')?>" download class="collection-item">
                <i class="mdi-action-get-app"></i>  Download the Sunbrella® catalogue
              </a>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</section>   


<?php $this->load->view('partials/footer') ?>
<script>
  $(document).ready(function(){
    $('.scrollspy').scrollSpy();
  });
</script>
</body>
</html>
