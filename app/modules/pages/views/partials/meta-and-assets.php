<?php ob_start() ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">

<link rel="icon" href="<?=base_url().img_url()?>favicon.ico">

<?php 
	asset_styles([
			['href'=>'materialize.min.css', 'media'=>'all'],
			['href'=>'font-awesome.min.css', 'media'=>'all'],
			['href'=>'style.css', 'media'=>'all'],
			['href'=>'custom.css', 'media'=>'all'],
			['href'=>'print.css', 'media'=>'print'],
		]);
 ?>
 <style>
 .submenu > li{
    position: relative;
    border-right: 1px solid #ededed;
  }
  .submenu > li:first-child{
    border-left: 1px solid #ededed;
  }
 </style>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="<?=script_url('html5shiv.js')?>"></script>
  <script src="<?=script_url('respond.min.js')?>"></script>
<![endif]-->
<?php echo minify_html(ob_get_clean()); ?>
