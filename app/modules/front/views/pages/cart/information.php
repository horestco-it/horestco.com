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
    <div class="col s12">
      <h3>Customer <?=ucwords($page)?></h3>
    </div>
  </div><!-- end row -->
  <div class="row">
    <form action="<?=base_url('payment/checkout')?>" method="POST">
      <div class="col s12 m6 l4">
        <div class="card-panel">
          <h5>Customer Address</h5>
          <?php $this->load->view('information_form_customer') ?>
        </div>
        <p>
          <a href="<?=base_url()?>cart"><i class="mdi-hardware-keyboard-arrow-left left"></i> Return to Cart</a>
        </p>
      </div>
      <div class="col s12 m6 l4">
        <div class="card-panel">

          <div class="input-field">
            <div class="form-group">
              <textarea name="customer[remark]" id="customer-remark" class="materialize-textarea"></textarea>
              <label for="customer-remark">Remark:</label>
            </div>
          </div>
          <button type="submit" class="btn">Continue</button>
        </div>
      </div>
<!--       <div class="col s12 m6 l4 shipping">
        <div class="card-panel">
          <h5>Shipping Address</h5>
          <?php $this->load->view('information_form_shipping') ?>
        </div>
      </div>
      <div class="col s12 m6 l4">
        <div class="card-panel">
          <h5>Payment Information</h5>
          <?php $this->load->view('information_form_payment') ?>
        </div>
        <p>
          <a href="<?=base_url()?>cart"><i class="mdi-hardware-keyboard-arrow-left left"></i> Return to Cart</a>
        </p>
      </div> -->
    </form>
  </div>
</section>

<?php $this->load->view('partials/footer') ?>

<script>
  var checked = $('#same:checked').length;

  var inputs = {
    cfname : $('#customer-fname'),
    clname : $('#customer-lname'),
    sfname : $('#shipping-fname'),
    slname : $('#shipping-lname'),
    same : $('#same'),
  }

  inputs.same.click(function(){
    checked = !checked;
  });  

  console.log(checked)

  if(checked)
  {
    setInputs(inputs.cfname, inputs.sfname);

    inputs.cfname.keyup(function(){
      setInputs(inputs.cfname, inputs.sfname);
    });
  }

  function setInputs(customer, shipping){
    shipping.val(customer.val())
  }

  $(document).ready(function(){
    $('.bill-credit').materialbox()
  })
</script>
</body>
</html>
