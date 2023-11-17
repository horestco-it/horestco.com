<?php $this->load->view('template/default/header') ?>
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

<?php $this->load->view('template/default/nav') ?>


<section class="container">
  <div class="row" style="margin-bottom:0">
    <div class="col s12 m6 l8 center" style="padding:3rem">
      
      <?php if (!is_null($error)): ?>
      <p class="red-text"><?=$error?></p>
      <?php endif ?>

      <h3>Confirmation</h3>
      <p>Click Continue button to proceed payment</p>
      <div class="row">
        <form action="<?=$this->ipay88->action?>" method="POST">
          <div class="col s12"><button type="submit" class="btn">Continue</button>
          </div>
          <?=$inputs?>
        </form>
      </div>
      <p>
        <?php if ($this->auth->check()): ?>
          <a href="<?=base_url()?>cart"><i class="fa fa-chevron-left"></i> Back</a>
        <?php else: ?>
          <a href="<?=base_url()?>cart/information"><i class="fa fa-chevron-left"></i> Back</a>
        <?php endif ?>
      </p>
    </div>
    <div class="col s12 m6 l4" style="padding-right:20px">

      <div class="row grey lighten-3" style="margin-bottom: 1rem;padding:2rem">
        <div class="col s12">
          <h5>Your Cart</h5>
          <table class="bordered grey-text text-darken-1">
            <tbody>
              <?php foreach ($this->cart->contents() as $key => $product): ?>
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
                  <h5><span class="currency">MYR</span>  <span class="red-text"><?=$this->cart->total()?></span></h5>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="col s12">
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

<?php $this->load->view('template/default/script') ?>
<?php $this->load->view('template/default/footer') ?>
