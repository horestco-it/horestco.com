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
</head>
<body>

<?php $this->load->view('partials/nav.php') ?>

<div class="divider"></div>

<section class="container" style="min-height: 275px">
  <div class="row" style="margin-bottom:0">
    <div class="col s12">
      <h3><?=$message?></h3>
    </div>
  </div><!-- end row -->
  <div class="row">
    <p>
      <a href="<?=base_url()?>malaysia-furniture-promotions"><i class="mdi-hardware-keyboard-arrow-left left"></i> Back</a>
    </p>
  </div>
</section>

<?php $this->load->view('partials/footer') ?>

</body>
</html>
