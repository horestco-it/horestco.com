<?php $this->load->view( config_item('theme').'header' ) ?>

  <style>



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



<?php $this->load->view(config_item('theme').'nav') ?>



<main class="container">

  <div class="row" style="margin-bottom:0">

    <div class="col s12">

      <h3>Customer Information </h3>

    </div>

  </div><!-- end row -->

  <div class="row">

    <div class="col s12 red-text">

      <?=$this->session->flashdata('error')?>

    </div>

  </div>

  <div class="row">

    <form action="<?=base_url('payment/checkout')?>" method="POST">

      <div class="col s12 m6 l4">

        <div class="card-panel">

          <h5>Customer Address</h5>

          <?php $this->load->view('information_form_customer') ?>

          <div class="input-field">

            <button type="submit" class="btn">Continue</button>

          </div>

        </div>

        <p>

          <a href="<?=base_url()?>cart"><i class="mdi-hardware-keyboard-arrow-left left"></i> Return to Cart</a>

        </p>

      </div>

  <?php /*    

      <div class="col s12 m6 l4 shipping">

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

      </div>



    */ ?>

    </form>

  </div>

</main>



<?php $this->load->view( config_item('theme').'script' ) ?>



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



<?php $this->load->view( config_item('theme').'footer' ) ?>

