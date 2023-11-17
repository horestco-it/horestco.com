<!DOCTYPE html>
<html lang="en">
<head>
  <?php get_meta($page) ?>
  <?php $this->load->view('partials/meta-and-assets') ?>
  <style>
    .lead.background-image{
      background-image: 
        linear-gradient(
          rgba(0, 0, 0, 0.7), 
          rgba(0, 0, 0, 0.7)
        ),
        url('<?=base_url().img_url()?>REFUND_POLICY.jpg');
        background-attachment: fixed;
        background-position: center;
        background-position-y: 0;
        background-repeat: no-repeat;
        background-size: cover;
    }
  </style>
</head>
<body>
<?php $this->load->view( config_item('theme').'nav' ) ?>

<section class="section lead background-image grey darken-3">
  <div class="container">
    <div class="row valign-wrapper">
      <div class="col s12 center white-text valign">
      <h3 class="lead-heading">REFUND POLICY</h3>
      </div>
    </div>
  </div>
</section>

<section class="section container">
  <div class="row">

    <div class="col s12">
      <div class="row">
        <div class="col s12 m4">
        <h5>Refund, Return and Exchange</h5>
          <p>
          At Horestco, we ensure the goods delivered are thoroughly checked and inspected before delivery. We do not encourage any refunds or return without a valid reason, however we encourage customers to check the goods upon delivery.
          If the item is returned upon delivery with a valid and acceptable reason, Horestco will re-deliver the goods at its own cost after rectification or exchange one to one. 
            <br>
            If returned items need to be picked up from a customer’s place ,a pickup fee will be applicable apart from Your initial delivery fee.
            No refund or exchange is accepted on custom made or make on order items.

          </p>
        </div>
        <div class="col s12 m8">
          <div class="row">
            <div class="col s12 m6">
    
              <p>
              Due to any reason if there is any cancellation (standard items only, not applicable for make on order), a fee of 3% of the order is chargeable or RM 300.00 per order whichever is higher.
              Upon receipt of returned goods, the items will be inspected. If the returned item is in acceptable condition , the refund will be processed within 7 working days. Refund process may take upto 14 working days after the written acceptance/confirmation of returned goods by Horestco. 

              </p>
            </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<?php $this->load->view('partials/footer') ?>

</body>
</html>
