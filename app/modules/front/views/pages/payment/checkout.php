<!DOCTYPE html>
<html lang="en">
<head>

  <title><?=ucwords($page)?> - horestco.com</title>
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
  <style>
  section{
    min-height: 243px;
  }
  input.form-control{
    margin-bottom: 10px !important;
    height: 2.5rem;
  }
  .card-panel{
    border: 1px solid #ddd;
    box-shadow: none;
    padding-top: 5px;
  }
  .shipping .form-group.checkbox {
    padding: 10px 0;
    margin-bottom: 16px;
  }
  label.radio{
    left: 0;
  }
  sup.required{
    color: red;
    font-size: 14px;
    top: -0.1rem;
  }
  </style>
</head>
<body>

<?php $this->load->view('partials/nav.php') ?>

<div class="divider"></div>

<section class="container">
  <div class="row" style="margin-bottom:0">
    <div class="col s12 center" style="padding:3rem">
      
      <?php if (!is_null($error)): ?>
      <p class="red-text"><?=$error?></p>
      <?php endif ?>

      <h3>Confirmation</h3>
      <p>Click Continue button to get payment</p>
      <div class="row">
        <form action="<?=$action?>" method="POST">
          <div class="col s12"><button type="submit" class="btn">Continue</button>
          </div>
          <?=$inputs?>
        </form>
      </div>
      <p>
        <a href="<?=base_url()?>cart/information"><i class="mdi-hardware-keyboard-arrow-left"></i> Back</a>
      </p>
    </div>
    <div class="col s12">

      <div class="row grey lighten-3" style="margin-bottom: 1rem;padding:2rem">
        <div class="col s12 m6">
          <h5>Your Cart</h5>
          <table class="bordered grey-text text-darken-1">
            <tbody>
              <?php foreach ($products as $key => $product): ?>
              <tr>
                <td>
                  <?=$product['name']?>
                  <?php if ($product['qty'] > 1): ?>
                  (<?=$product['qty']?>)
                  <?php endif ?>
                </td>
                <td>MYR <?=$product['subtotal']?></td>
              </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="1">
                  Amount : 
                  <h5><span class="currency">MYR</span>  <span class="red-text"><?=$total?></span></h5>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="col s12 m6">
          <h5>Your Personal Data</h5>
          <table class="bordered grey-text text-darken-1">
            <tbody>
            <?php foreach ($customers as $key => $value): ?>
              <tr><td><?=$key?></td><td>:</td><td><?=$value?></td></tr>
            <?php endforeach ?>
            </tbody>
          </table>

        </div>
      </div>
      
    </div>
  </div><!-- end row -->
</section>

<?php $this->load->view('partials/footer') ?>

</body>
</html>
