<?php ob_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php  get_meta($page) ?>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
  <meta name="google-site-verification" content="6L1Kg1ix0KggGtCyTvvSmQqdtIo4DchTBtazVlxmn9A" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="icon" href="<?=base_url().img_url()?>favicon.ico">
  <link rel="stylesheet" href="<?=style_url('font-awesome.min.css')?>">
  <link rel="stylesheet" href="<?=style_url('materialize.min.css')?>">
  <link rel="stylesheet" href="<?=style_url('style.css')?>">
  <link rel="stylesheet" href="<?=style_url('custom.css')?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="<?=script_url('html5shiv.js')?>"></script>
    <script src="<?=script_url('respond.min.js')?>"></script>
  <![endif]-->
<?php echo minify_html(ob_get_clean()); ?>

  <!-- Start of  Zendesk Widget script -->
<!-- <script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=95bb293e-140a-402c-951e-8bb3d0572c0d"> </script> -->
<!-- End of  Zendesk Widget script -->
