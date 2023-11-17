<!DOCTYPE html>
<html lang="en">
<head>
  <?php get_meta($site->slug) ?>

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

</head>
<body>

<?php $this->load->view('partials/nav.php') ?>

<section class="section lead grey darken-3">
  <div class="container">
    <div class="row">
      <div class="col s12 center white-text">
        <h3 class="lead-heading"><?=strtoupper($site->name)?></h3>
        <h5 class="lead-sub-heading">
          We believe good partnerships are central to the success of any organisation
        </h5>
      </div>
    </div>
  </div>
</section>

<section class="container">
  <div class="row">
    <div class="col s12">
      <p class="left">
        Partnering with qualified, experienced and value-driven distributors and suppliers is essential to succeed in the highly competitive Malaysian furniture market. 
        We are committed to partnering with distributors who are dedicated to a mutual growth and success.
        Our manufacturing services can help realise your goals of staying highly competitive and improving market share while providing value to your customers. We place vital importance to supporting our partners and distributors at every step of the distribution process. 
      </p>
      <p class="left">
        For those interested to distribute our products in markets outside malaysia, please visit <a href="http://horestco.com/furniture-dealership" target="_blank">horestco.com/furniture-dealership</a>.
      </p>
    </div>

    <div class="col s12">
      <div class="row">

        <div class="col s12 m6">
          <h5>Custom Design &amp; OEM services</h5>
          <div class="mediabox">
            <img src="<?=base_url().img_url()?>pages/dealership-steel-chairs-assembling.jpg" width="200"  alt="steel chairs assembling">
          </div>
          <p>
            Whether you target a distinct market or the general residential market that needs a custom product line, we will help you in designing that. 
            Our <strong>R&amp;D</strong> team can also help in designing product lines that are specific to your own market
          </p>
        </div>

        <div class="col s12 m6">
          <h5>Production</h5>
          <div class="mediabox">
            <img src="<?=base_url().img_url()?>pages/dealership-tenon-mortise-machine.jpg" width="200"  alt="tenon mortise machine">
          </div>
          <p>
            Investing in the latest machinery and a disciplined workforce, our products are semi-machine made - combining precision European machinery with <strong>traditional Asian craftsmanship</strong>. 
            <br>
            Our furniture is designed and manufactured in-house at our factory in <strong>Jepara, Central Java, Indonesia, and Glenmarie, Malaysia</strong> in a professional and highly cost-efficient work system. 
            <strong>Jepara</strong> as a location has various advantages for manufacturing not easily found elsewhere, including low material and labour costs, highly skilled labour, training facilities and other necessary infrastructure helpful for furniture production.
          </p>
        </div>

      </div>
    </div>
    
  </div>
</section>

<?php $this->load->view('partials/footer') ?>

<script>
  $(document).ready(function(){
    $('.mediabox').find('img').materialbox();
  })
</script>
</body>
</html>
