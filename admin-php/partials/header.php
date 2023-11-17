<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?=base_url()?>favicon.ico">

    <title>Horestcto | Setting Admin Horestco</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>admin-php/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>admin-php/assets/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="<?=base_url()?>admin-php/assets/css/select2.css" rel="stylesheet" />
    <link href="<?=base_url()?>admin-php/assets/css/styles.css" rel="stylesheet" />
    <?php if ( basename($_SERVER['PHP_SELF']) == 'upload.php' ): ?>
    <link href="<?=base_url()?>admin-php/assets/plugins/easytree/themes/lion/ui.easytree.css" rel="stylesheet">
    <?php endif ?>

    <script src="<?=base_url()?>admin-php/assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>admin-php/assets/plugins/easytree/jquery.easytree.min.js"></script>
    <script src="<?=base_url()?>admin-php/assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>admin-php/assets/js/jquery-ui.min.js"></script>
    <script src="<?=base_url()?>admin-php/assets/js/select2.full.min.js"></script>


    <!-- 
    <script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-rc.2/js/select2.min.js"></script>
     -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
  <?php include 'nav.php'; ?>

